module Main exposing (..)
import Browser
import Html exposing (..)
import Html.Attributes exposing (style,id,type_)
import Html.Events exposing (onInput,onClick)
import Http
import Json.Decode as Decode exposing (Decoder, int, list, string)
import Json.Decode.Pipeline exposing (required)


--Model
type alias Table = 
    {
        rOUTE_ID : String,
        cOMPANY_CODE : String,
        rOUTE_NAMEC : String,
        rOUTE_NAMES : String,
        rOUTE_NAMEE : String,
        rOUTE_TYPE : String,
        sERVICE_MODE : String,
        sPECIAL_TYPE : String,
        jOURNEY_TIME : String,
        lOC_START_NAMEC : String,
        lOC_START_NAMES : String,
        lOC_START_NAMEE : String,
        lOC_END_NAMEC : String,
        lOC_END_NAMES : String,
        lOC_END_NAMEE : String,
        hYPERLINK_C : String,
        hYPERLINK_S : String,
        hYPERLINK_E : String,
        fULL_FARE : String,
        lAST_UPDATE_DATE : String
    }

type alias Json =
    {
        code : Int,
        table : List Table
    }

type alias Bus = {
    route : String
    , fare : String
    , start : String
    , end : String
    , json : List Json
    , errorMessage : Maybe String
    }
--View
myView: Bus -> Html Msg
myView busRecord =
    div [][
        h1 [style "padding-left" "2cm"][text "Bus Search"]
        ,div ([]++formStyle)[
                text "Route: " 
                , input ([id "route", type_ "text", onInput RouteEntered]++ inputStyle)[]
                , br[][]
                , text "Fare: "
                , input ([id "fare", type_ "text", onInput FareEntered]++ inputStyle)[]
                , br[][]
                , text "Start: "
                , input ([id "start", type_ "text", onInput StartEntered]++ inputStyle)[]
                , br[][]
                , text "End: "
                , input ([id "end", type_ "text", onInput EndEntered]++ inputStyle)[]
            ]
            , div [][
                button ([type_ "submit", onClick SendHttpRequest]++ buttonStyle)[text "Search"]
            ]
        
        ,div [][text busRecord.route ]
        ,div [][jsonOrError busRecord]
    ]

jsonOrError : Bus -> Html Msg
jsonOrError model =
    case model.errorMessage of
        Just message ->
            viewError message

        Nothing ->
            viewtable model.json


viewError : String -> Html Msg
viewError errorMessage =
    let
        errorHeading =
            "Couldn't fetch data at this time."
    in
    div []
        [ h3 [] [ text errorHeading ]
        , text ("Error: " ++ errorMessage)
        ]


viewtable : List Json -> Html Msg
viewtable route =
    div []
        [ h3 [] [ text "User Records" ]
        , div []
            ([ ] ++ List.map viewCol route)
        ]

        
viewTableHeader : Html Msg
viewTableHeader =
    tr []
        [ th []
            [ text "id" ]
        ,th []
            [ text "route name" ]
        ,th []
            [ text "start" ]
        ,th []
            [ text "end" ]
        ]


viewCol : Json -> Html Msg
viewCol json =
    table ([]++tableStyle)
        ([viewTableHeader]++ List.map viewCol2 json.table)


viewCol2 : Table -> Html Msg
viewCol2 json =
    tr [][    
        td []
            [ text (json.rOUTE_ID) ]
        ,td []
            [ text (json.rOUTE_NAMEE) ]
        ,td []
            [ text (json.lOC_START_NAMEE) ]
        ,td []
            [ text (json.lOC_END_NAMEE) ]
    ]


--Message Type
type Msg = 
    RouteEntered String | FareEntered String | StartEntered String | EndEntered String
    | SendHttpRequest 
    | DataReceived (Result Http.Error Json)
    

--Update
myUpdate: Msg -> Bus -> (Bus, Cmd Msg)
myUpdate msg busDetails =
    case msg of

        RouteEntered routeInput -> ({busDetails | route = routeInput}, Cmd.none)
        FareEntered fareInput -> ({busDetails | fare = fareInput}, Cmd.none)
        StartEntered startInput -> ({busDetails | start = startInput}, Cmd.none)
        EndEntered endInput -> ({busDetails | end = endInput}, Cmd.none) 

        SendHttpRequest -> (busDetails, getBusDetails busDetails)
        
        DataReceived (Ok json) ->
            ( { busDetails
                | json = [json]
                , errorMessage = Nothing
              }
            , Cmd.none
            )

        DataReceived (Err httpError) ->
            ( { busDetails
                | errorMessage = Just (buildErrorMessage httpError)
              }
            , Cmd.none
            )


--Supporting Functions
getBusDetails: Bus -> Cmd Msg
getBusDetails busDetails =
    Http.get {
        url = getUrl busDetails
        , expect = Http.expectJson DataReceived postDecoder -- DataReceived is a message type
    }

getUrl: Bus -> String
getUrl bus = 
    if bus.route /= "" && bus.fare /="" && bus.start /="" && bus.end /="" then
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/End/", bus.end, "/Bus/", bus.route, "/FEE/0/", bus.fare]
    else if bus.route /= "" && bus.fare /="" && bus.start /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/Bus/", bus.route, "/FEE/0/", bus.fare]
    else if bus.route /= "" && bus.start /="" && bus.end /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/End/", bus.end, "/Bus/", bus.route]
    else if bus.start /="" && bus.end /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/End/", bus.end]   
    else if bus.start /="" && bus.fare /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/FEE/0/", bus.fare]   
    else if bus.end /="" && bus.fare /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/End/", bus.end, "/FEE/0/", bus.fare]  
    else if bus.start /="" && bus.route /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start, "/Bus/", bus.route] 
    else if bus.end /="" && bus.route /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/End/", bus.end, "/Bus/", bus.route] 
    else if bus.fare /="" && bus.route /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Bus/", bus.route, "/FEE/0/", bus.fare] 
    else if bus.start /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Start/", bus.start] 
    else if bus.end /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/End/", bus.end] 
    else if bus.route /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/Bus/", bus.route] 
    else if bus.route /="" then 
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus//FEE/0/", bus.fare] 
    else
        String.concat ["http://localhost/ATWD/serverSide/Controller.php/Routebus/"]



postDecoder : Decoder Json
postDecoder = 
    Decode.succeed Json
        |> Json.Decode.Pipeline.required "code" int 
        |> Json.Decode.Pipeline.required "table" (list tableDecoder)


tableDecoder : Decoder Table
tableDecoder = 
     Decode.succeed Table
        |> required "ROUTE_ID" string
        |> required "COMPANY_CODE" string
        |> required "ROUTE_NAMEC"  string
        |> required "ROUTE_NAMES"  string
        |> required "ROUTE_NAMEE"  string
        |> required "ROUTE_TYPE"  string
        |> required "SERVICE_MODE"  string
        |> required "SPECIAL_TYPE"  string
        |> required "JOURNEY_TIME"  string
        |> required "LOC_START_NAMEC"  string
        |> required "LOC_START_NAMES"  string
        |> required "LOC_START_NAMEE"  string
        |> required "LOC_END_NAMEC"  string
        |> required "LOC_END_NAMES"  string
        |> required "LOC_END_NAMEE"  string
        |> required "HYPERLINK_C"  string
        |> required "HYPERLINK_S"  string
        |> required "HYPERLINK_E"  string
        |> required "FULL_FARE"  string
        |> required "LAST_UPDATE_DATE" string


buildErrorMessage : Http.Error -> String
buildErrorMessage httpError =
    case httpError of
        Http.BadUrl message ->
            message

        Http.Timeout ->
            "Server is taking too long to respond. Please try again later."

        Http.NetworkError ->
            "Unable to reach server."

        Http.BadStatus statusCode ->
            "Request failed with status code: " ++ String.fromInt statusCode

        Http.BadBody message ->
            message


--Main
main: Program () Bus Msg
main =
    Browser.element {
        init = myInit
        , view = myView
        , update = myUpdate 
        , subscriptions = \_ -> Sub.none
    }


--Initialization function
myInit: () -> (Bus, Cmd Msg)
myInit _ = 
    (myBus, Cmd.none)


myBus: Bus
myBus = {
    route = ""
    , fare = ""
    , start = ""
    , end = ""
    , json = []
    , errorMessage = Nothing
    }


formStyle : List (Attribute msg)
formStyle =
    [ style "border-radius" "5px"
    , style "background-color" "#f2f2f2"
    , style "padding" "20px"
    , style "width" "300px"
    , style "margin-left" "17cm"
    ]
    
tableStyle : List (Attribute msg)
tableStyle =
    [ style "border-radius" "5px"
    , style "background-color" "#f2f2f2"
    , style "padding" "20px"
    , style "width" "40%"
    , style "margin-left" "30%"
    ]

inputStyle : List (Attribute msg)
inputStyle =
    [ style "display" "block"
    , style "width" "260px"
    , style "padding" "12px 20px"
    , style "margin" "8px 0"
    , style "border" "none"
    , style "border-radius" "4px"
    ]


buttonStyle : List (Attribute msg)
buttonStyle =
    [ style "width" "300px"
    , style "background-color" "#397cd5"
    , style "color" "white"
    , style "padding" "14px 20px"
    , style "margin-top" "10px"
    , style "border" "none"
    , style "border-radius" "4px"
    , style "font-size" "16px"
    , style "margin-left" "17.5cm"
    ]
