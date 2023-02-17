<?php
/*-----------------load router bus database in $routerBusObject variable----------------------*/
echo "<-------table route_bus--------><br>";
$routerBusObject = simplexml_load_file("https://static.data.gov.hk/td/routes-fares-xml/ROUTE_BUS.xml") or die("Error: Cannot create object");
//check table eixsts
$route_bus_records = "SELECT * FROM route_bus";
if (mysqli_query($conn, $route_bus_records)) {
    echo "route_bus Table exists<br>";
} else {
    //create route_bus table 
    $sql = "CREATE TABLE `route_bus` (
    `ROUTE_ID` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `COMPANY_CODE` varchar(256) NOT NULL,
    `ROUTE_NAMEC` varchar(256) NOT NULL,
    `ROUTE_NAMES` varchar(256) NOT NULL,
    `ROUTE_NAMEE` varchar(256) NOT NULL,
    `ROUTE_TYPE` int(1) NOT NULL,
    `SERVICE_MODE` varchar(1) NOT NULL,
    `SPECIAL_TYPE` int(1) NOT NULL,
    `JOURNEY_TIME` int(11) NOT NULL,
    `LOC_START_NAMEC` varchar(256) NOT NULL,
    `LOC_START_NAMES` varchar(256) NOT NULL,
    `LOC_START_NAMEE` varchar(256) NOT NULL,
    `LOC_END_NAMEC` varchar(256) NOT NULL,
    `LOC_END_NAMES` varchar(256) NOT NULL,
    `LOC_END_NAMEE` varchar(256) NOT NULL,
    `HYPERLINK_C` varchar(256) NOT NULL,
    `HYPERLINK_S` varchar(256) NOT NULL,
    `HYPERLINK_E` varchar(256) NOT NULL,
    `FULL_FARE` double(11,1) NOT NULL,
    `LAST_UPDATE_DATE` datetime NOT NULL)";
    if (mysqli_query($conn, $sql)) {
        echo "route_bus Table Create<br>";
        //insert datas in database -> table name -> route_bus
        $stmt = $conn->prepare("INSERT INTO route_bus (ROUTE_ID, COMPANY_CODE, ROUTE_NAMEC,ROUTE_NAMES,ROUTE_NAMEE,ROUTE_TYPE,
        SERVICE_MODE,SPECIAL_TYPE,JOURNEY_TIME,LOC_START_NAMEC,LOC_START_NAMES,LOC_START_NAMEE,LOC_END_NAMEC,LOC_END_NAMES,LOC_END_NAMEE,
        HYPERLINK_C,HYPERLINK_S,HYPERLINK_E,FULL_FARE,LAST_UPDATE_DATE) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("issssisiisssssssssds", $ROUTE_ID, $COMPANY_CODE, $ROUTE_NAMEC, $ROUTE_NAMES, $ROUTE_NAMEE, $ROUTE_TYPE, $SERVICE_MODE, $SPECIAL_TYPE, $JOURNEY_TIME, $LOC_START_NAMEC, $LOC_START_NAMES, $LOC_START_NAMEE, $LOC_END_NAMEC, $LOC_END_NAMES, $LOC_END_NAMEE, $HYPERLINK_C, $HYPERLINK_S, $HYPERLINK_E, $FULL_FARE, $LAST_UPDATE_DATE);
        foreach ($routerBusObject as $routerBusData) {
            $ROUTE_ID = $routerBusData->ROUTE_ID;
            $COMPANY_CODE = $routerBusData->COMPANY_CODE;
            $ROUTE_NAMEC = $routerBusData->ROUTE_NAMEC;
            $ROUTE_NAMES = $routerBusData->ROUTE_NAMES;
            $ROUTE_NAMEE = $routerBusData->ROUTE_NAMEE;
            $ROUTE_TYPE = $routerBusData->ROUTE_TYPE;
            $SERVICE_MODE = $routerBusData->SERVICE_MODE;
            $SPECIAL_TYPE = $routerBusData->SPECIAL_TYPE;
            $JOURNEY_TIME = $routerBusData->JOURNEY_TIME;
            $LOC_START_NAMEC = $routerBusData->LOC_START_NAMEC;
            $LOC_START_NAMES = $routerBusData->LOC_START_NAMES;
            $LOC_START_NAMEE = $routerBusData->LOC_START_NAMEE;
            $LOC_END_NAMEC = $routerBusData->LOC_END_NAMEC;
            $LOC_END_NAMES = $routerBusData->LOC_END_NAMES;
            $LOC_END_NAMEE = $routerBusData->LOC_END_NAMEE;
            $HYPERLINK_C = $routerBusData->HYPERLINK_C;
            $HYPERLINK_S = $routerBusData->HYPERLINK_S;
            $HYPERLINK_E = $routerBusData->HYPERLINK_E;
            $FULL_FARE = $routerBusData->FULL_FARE;
            $LAST_UPDATE_DATE = $routerBusData->LAST_UPDATE_DATE;
            if (!$stmt->execute()) {
                echo $stmt->error . "<br>";
            }
        }
        $stmt->close();
        echo "insert data in route_bus table successfully<br>";
    } else {
        echo "route_bus Table create fail<br>";
    }
}
