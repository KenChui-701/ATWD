<?php
require_once 'RESTfulInterface.php';
error_reporting(0);
class RoutebusHandler implements RESTfulInterface{
    public function restGet($params){
        include('./conn/conn.php');
        if($params[0]===""){
            $sql = "SELECT * from `route_bus`";
            
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="RID"&&$params[6]=="COMPANY"&&$params[8]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[9]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[10]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="Bus"&&$params[6]=="COMPANY"&&$params[8]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_NAMEC` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_NAMES` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_NAMEE` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%' AND `FULL_FARE` > $params[9] AND `FULL_FARE` < $params[10] ";
                         
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[9]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[10]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="RID"&&$params[6]=="COMPANY"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[9]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[10]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="RID"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="RID"&&$params[4]=="COMPANY"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="RID"&&$params[4]=="COMPANY"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_END_NAMEC LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_END_NAMES LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_END_NAMEE LIKE'$params[1]%' AND `ROUTE_ID` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="Bus"&&$params[6]=="COMPANY"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_NAMEC` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_NAMES` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_NAMEE` LIKE'$params[5]%' AND `COMPANY_CODE` LIKE '$params[7]%'  ";
                         
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="Bus"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_NAMEC` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_NAMES` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_NAMEE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="Bus"&&$params[4]=="COMPANY"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND `ROUTE_NAMEC` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND `ROUTE_NAMES` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND `ROUTE_NAMEE` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="Bus"&&$params[4]=="COMPANY"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_END_NAMEC LIKE'$params[1]%' AND `ROUTE_NAMEC` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_END_NAMES LIKE'$params[1]%' AND `ROUTE_NAMES` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_END_NAMEE LIKE'$params[1]%' AND `ROUTE_NAMEE` LIKE '$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="COMPANY"&&$params[6]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `COMPANY_CODE` LIKE '$params[5]%' AND `FULL_FARE` > $params[7] AND `FULL_FARE` < $params[8] ";
                         
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[7]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[8]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="RID"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%'  OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%'  OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_ID` LIKE '$params[5]%' ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=202;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="COMPANY"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="RID"&&$params[4]=="COMPANY"){
            $sql = "SELECT * from `route_bus` 
                    where
                    `LOC_END_NAMEC` LIKE '$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND COMPANY_CODE LIKE'$params[5]%'  OR
                    `LOC_END_NAMEC` LIKE '$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND COMPANY_CODE LIKE'$params[5]%'  OR
                    `LOC_END_NAMEC` LIKE '$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND COMPANY_CODE LIKE'$params[5]%'  ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="RID"&&$params[2]=="COMPANY"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]=="COMPANY"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    ROUTE_NAMEC LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    ROUTE_NAMES LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    ROUTE_NAMEE LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]=="Bus"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' AND `ROUTE_NAMEC` LIKE '$params[5]%'  OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' AND `ROUTE_NAMES` LIKE '$params[5]%'  OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%' AND `ROUTE_NAMEE` LIKE '$params[5]%' ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=202;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="RID"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="Bus"&&$params[4]=="FEE"){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND ROUTE_NAMEC LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND ROUTE_NAMES LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND ROUTE_NAMEE LIKE'$params[3]%' AND `FULL_FARE` > $params[5] AND `FULL_FARE` < $params[6] ";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[5]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[6]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="End"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%' OR
                    LOC_START_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%' OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="RID"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' OR
                    LOC_START_NAMES LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="COMPANY"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    LOC_START_NAMES LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]=="FEE"&&$params[5]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_START_NAMEC LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    LOC_START_NAMES LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    LOC_START_NAMEE LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[3]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[4]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="RID"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_END_NAMEC LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' OR
                    LOC_END_NAMES LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%' OR
                    LOC_END_NAMEE LIKE'$params[1]%' AND ROUTE_ID LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="COMPANY"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_END_NAMEC LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    LOC_END_NAMES LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    LOC_END_NAMEE LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]=="FEE"&&$params[5]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    LOC_END_NAMEC LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    LOC_END_NAMES LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    LOC_END_NAMEE LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[3]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[4]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="RID"&&$params[2]=="COMPANY"&&$params[4]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%' OR
                    ROUTE_ID LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="RID"&&$params[2]=="FEE"&&$params[5]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    ROUTE_ID LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    ROUTE_ID LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    ROUTE_ID LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[3]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[4]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="COMPANY"&&$params[2]=="FEE"&&$params[5]==""){
            $sql = "SELECT * from `route_bus` 
                    where
                    COMPANY_CODE LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    COMPANY_CODE LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4] OR
                    COMPANY_CODE LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]=="COMPANY"&&$params[4]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    ROUTE_NAMEC LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%'OR
                    ROUTE_NAMES LIKE'$params[1]%' AND COMPANY_CODE LIKE'$params[3]%'OR
                    ROUTE_NAMEE LIKE'$params[1]%'AND COMPANY_CODE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]=="FEE"&&$params[5]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    ROUTE_NAMEC LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]OR
                    ROUTE_NAMES LIKE'$params[1]%' AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]OR
                    ROUTE_NAMEE LIKE'$params[1]%'AND `FULL_FARE` > $params[3] AND `FULL_FARE` < $params[4]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[3]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[4]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]=="Start"&&$params[4]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    ROUTE_NAMEC LIKE'$params[1]%' AND LOC_START_NAMEC LIKE'$params[3]%'OR
                    ROUTE_NAMES LIKE'$params[1]%' AND LOC_START_NAMES LIKE'$params[3]%'OR
                    ROUTE_NAMEE LIKE'$params[1]%' AND LOC_START_NAMEE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]=="End"&&$params[4]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    ROUTE_NAMEC LIKE'$params[1]%' AND LOC_END_NAMEC LIKE'$params[3]%'OR
                    ROUTE_NAMES LIKE'$params[1]%' AND LOC_END_NAMES LIKE'$params[3]%'OR
                    ROUTE_NAMEE LIKE'$params[1]%' AND LOC_END_NAMEE LIKE'$params[3]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="RID"&&$params[2]==""){
            $sql = "SELECT * from `route_bus` 
                    where 
                    `ROUTE_ID` = $params[1]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="COMPANY"&&$params[2]==""){
            $sql = "SELECT * from `route_bus` 
                    where COMPANY_CODE LIKE'$params[1]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="FEE"&&$params[3]==""){
            $sql = "SELECT * from `route_bus` 
                    where 
                    `FULL_FARE` > $params[1] AND `FULL_FARE` < $params[2]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                if($params[1]==""){
                    $dbdata['code']=301;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else if ($params[2]==""){
                    $dbdata['code']=302;
                    $dbdata['message']="The fee should include the less and high, please enter the full range.";
                }else{
                    $dbdata['code']=303;
                    $dbdata['message']="the server is break down, please try it in few second later";
                }
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Bus"&&$params[2]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    ROUTE_NAMEC LIKE'$params[1]%' OR
                    ROUTE_NAMES LIKE'$params[1]%' OR
                    ROUTE_NAMEE LIKE'$params[1]%'";

            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="End"&&$params[2]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    LOC_END_NAMEC LIKE'%$params[1]%' OR
                    LOC_END_NAMES LIKE'%$params[1]%' OR
                    LOC_END_NAMEE LIKE'%$params[1]%'";

            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Start"&&$params[2]==""){
            $sql = "SELECT * 
                    from `route_bus` 
                    where 
                    LOC_START_NAMEC LIKE'$params[1]%' OR
                    LOC_START_NAMES LIKE'$params[1]%' OR
                    LOC_START_NAMEE LIKE'$params[1]%'";

            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $dbdata['code']=201;
                        $dbdata['table'][]=array(
                            'ROUTE_ID' => $ROUTE_ID,
                            'COMPANY_CODE' => $COMPANY_CODE,
                            'ROUTE_NAMEC' => $ROUTE_NAMEC,
                            'ROUTE_NAMES' => $ROUTE_NAMES,
                            'ROUTE_NAMEE' => $ROUTE_NAMEE,
                            'ROUTE_TYPE' => $ROUTE_TYPE,
                            'SERVICE_MODE'=>$SERVICE_MODE,
                            'SPECIAL_TYPE'=>$SPECIAL_TYPE,
                            'JOURNEY_TIME'=>$JOURNEY_TIME,
                            'LOC_START_NAMEC'=>$LOC_START_NAMEC,
                            'LOC_START_NAMES'=>$LOC_START_NAMES,
                            'LOC_START_NAMEE'=>$LOC_START_NAMEE,
                            'LOC_END_NAMEC'=>$LOC_END_NAMEC,
                            'LOC_END_NAMES'=>$LOC_END_NAMES,
                            'LOC_END_NAMEE'=>$LOC_END_NAMEE,
                            'HYPERLINK_C'=>$HYPERLINK_C,
                            'HYPERLINK_S'=>$HYPERLINK_S,
                            'HYPERLINK_E'=>$HYPERLINK_E,
                            'FULL_FARE'=>$FULL_FARE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=303;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else{
            $dbdata['table'][]="404 Your input was enter wrong, please enter the correct input";
            echo json_encode($dbdata);
        }
    }
    public function restPut($params, $key){
        include('./conn/conn.php');
        $UpdateSql="UPDATE `route_bus`
                    SET 
                    `COMPANY_CODE` = '$params->COMPANY_CODE',
                    `ROUTE_NAMEC` = '$params->ROUTE_NAMEC',
                    `ROUTE_NAMES` = '$params->ROUTE_NAMES',
                    `ROUTE_NAMEE` = '$params->ROUTE_NAMEE',
                    `ROUTE_TYPE` = $params->ROUTE_TYPE,
                    `SERVICE_MODE`='$params->SERVICE_MODE',
                    `SPECIAL_TYPE`=$params->SPECIAL_TYPE,
                    `JOURNEY_TIME`=$params->JOURNEY_TIME,
                    `LOC_START_NAMEC`= '".$params->LOC_START_NAMEC."',
                    `LOC_START_NAMES`='".$params->LOC_START_NAMES."',
                    `LOC_START_NAMEE`='".$params->LOC_START_NAMEE."',
                    `LOC_END_NAMEC`= '".$params->LOC_END_NAMEC."',
                    `LOC_END_NAMES`= '".$params->LOC_END_NAMES."',
                    `LOC_END_NAMEE`= '".$params->LOC_END_NAMEE."',
                    `HYPERLINK_C`='".$params->HYPERLINK_C."',
                    `HYPERLINK_S`='".$params->HYPERLINK_S."',
                    `HYPERLINK_E`='".$params->HYPERLINK_E."',
                    `FULL_FARE`=$params->FULL_FARE,
                    `LAST_UPDATE_DATE`='".$params->LAST_UPDATE_DATE."'
                    WHERE `ROUTE_ID` =  $params->ROUTE_ID";

        //$conn->query($UpdateSql);
        if($params->FULL_FARE==""){
            $dbdata['code']=501;
            $dbdata['message']="Fare is emprty, please input Fare";
            echo json_encode($dbdata);
        }else if($params->ROUTE_NAMEC==""||$params->ROUTE_NAMES==""||$params->ROUTE_NAMEE==""){
            $dbdata['code']=502;
            $dbdata['message']="Bus Name is emprty, please input Bus Name";
            echo json_encode($dbdata);
        }else if($params->ROUTE_ID==""){
            $dbdata['code']=503;
            $dbdata['message']="ID Name is emprty, please input ID Name";
            echo json_encode($dbdata);
        }else if($params->LOC_START_NAMEC==""||$params->LOC_START_NAMES==""||$params->LOC_START_NAMEE==""){
            $dbdata['code']=502;
            $dbdata['message']="Start Location Name is emprty, please input Start Location Name";
            echo json_encode($dbdata);
        }else if($params->LOC_END_NAMEC==""||$params->LOC_END_NAMES==""||$params->LOC_END_NAMEE==""){
            $dbdata['code']=502;
            $dbdata['message']="End Location Name is emprty, please input End Location Name";
            echo json_encode($dbdata);
        }else if($params->ROUTE_TYPE==""){
            $dbdata['code']=502;
            $dbdata['message']="ROUTE TYPE is emprty, please input ROUTE TYPE";
            echo json_encode($dbdata);
        }else if($params->SERVICE_MODE==""){
            $dbdata['code']=502;
            $dbdata['message']="Service Mode is emprty, please input Service Mode";
            echo json_encode($dbdata);
        }else if($params->SPECIAL_TYPE==""){
            $dbdata['code']=502;
            $dbdata['message']="Special Type is emprty, please input Special Type";
            echo json_encode($dbdata);
        }else if($params->JOURNEY_TIME==""){
            $dbdata['code']=502;
            $dbdata['message']="Journey Time is emprty, please input Journey Time";
            echo json_encode($dbdata);
        }else if($conn->query($UpdateSql) === TRUE){
            $dbdata['code']=200;
            $dbdata['message']="Route Bus Updated";
            echo json_encode($dbdata);
        }else{
            $dbdata['code']=401;
            $dbdata['message']="Route Bus Not Update";
            echo json_encode($dbdata);
        }
        
        mysqli_close($conn);
    }
    public function restPost($params,$key){
        include('./conn/conn.php');
        $InsertSql ="INSERT INTO route_bus 
                        (ROUTE_ID,COMPANY_CODE,
                        ROUTE_NAMEC,ROUTE_NAMES,ROUTE_NAMEE,
                        ROUTE_TYPE,SERVICE_MODE,SPECIAL_TYPE,JOURNEY_TIME,
                        LOC_START_NAMEC,LOC_START_NAMES,LOC_START_NAMEE,
                        LOC_END_NAMEC,LOC_END_NAMES,LOC_END_NAMEE,
                        HYPERLINK_C,HYPERLINK_S,HYPERLINK_E,
                        FULL_FARE,LAST_UPDATE_DATE) 
                    VALUES 
                    (   $params->ROUTE_ID,'$params->COMPANY_CODE',
                        '$params->ROUTE_NAMEC','$params->ROUTE_NAMES','$params->ROUTE_NAMEE',
                        '$params->ROUTE_TYPE','$params->SERVICE_MODE','$params->SPECIAL_TYPE','$params->JOURNEY_TIME',
                        '$params->LOC_START_NAMEC','$params->LOC_START_NAMES','$params->LOC_START_NAMEE',
                        '$params->LOC_END_NAMEC','$params->LOC_END_NAMES','$params->LOC_END_NAMEE',
                        '$params->HYPERLINK_C','$params->HYPERLINK_S','$params->HYPERLINK_E',
                        '$params->FULL_FARE','$params->LAST_UPDATE_DATE')";
        $conn->query($InsertSql);

        if($conn->affected_rows >0){
            $dbdata['code']=200;
            $dbdata['message']="Route Bus Inserted";
            echo json_encode($dbdata);
        }else{
            $dbdata['code']=402;
            $dbdata['message']="Route Bus not Insert";
            echo json_encode($dbdata);
        }
        
        mysqli_close($conn);
        
    }
    public function restDelete($params){
        include('./conn/conn.php');    
        if($params[0]=="Bus"){
            $ID=0;
            $check=mysqli_query($conn," SELECT * 
                                        from `route_bus` 
                                        where 
                                        ROUTE_NAMEC LIKE'$params[1]%' OR
                                        ROUTE_NAMES LIKE'$params[1]%' OR
                                        ROUTE_NAMEE LIKE'$params[1]%'");
            while($rc2=mysqli_fetch_assoc($check)){
                extract($rc2);
                if($ROUTE_NAMEC==$params[1]){
                    $ID = $ROUTE_ID;
                    break;
                }
                break;
            }
            //using foreign key that need delete rstop first
            $DeleteSql = "DELETE from rstop_bus WHERE ROUTE_ID = $ID" ;
            if( mysqli_query($conn,$DeleteSql)){
                $DeleteSql2 = "DELETE from route_bus WHERE ROUTE_ID = $ID";
                $conn -> query($DeleteSql2);
                
                if($conn->affected_rows >0){
    
                    $dbdata['code']=200;
                    $dbdata['message']= 'Route Bus DELETED';
                    echo json_encode($dbdata);
                }else{
    
                    $dbdata['code']=201;
                    $dbdata['message']= 'Route Bus No DELETE';
                    echo json_encode($dbdata);
                }       
            }else{
                $dbdata['code']=403;
                $dbdata['message']= 'Input error';
                echo json_encode($dbdata);
            }

        }else if($params[0]=="RID"){
            
            $DeleteSql = "DELETE from rstop_bus WHERE ROUTE_ID = $params[1]" ;
            if( mysqli_query($conn,$DeleteSql)){
                $DeleteSql2 = "DELETE from route_bus WHERE ROUTE_ID = $params[1]";
                $conn -> query($DeleteSql2);
                
                if($conn->affected_rows >0){
    
                    $dbdata['code']=200;
                    $dbdata['message']= 'Route Bus DELETED';
                    echo json_encode($dbdata);
                }else{
    
                    $dbdata['code']=201;
                    $dbdata['message']= 'Route Bus DELETE';
                    echo json_encode($dbdata);
                }
                   
            }else{
                $dbdata['code']=405;
                $dbdata['message']= 'Input error';
                echo json_encode($dbdata);
            }

        }else{
            $dbdata['code']=400;
            $dbdata['message']="your API can not found result, please try another API";
            echo json_encode($dbdata);
        }
        
        
        mysqli_close($conn);
    }
}
?>