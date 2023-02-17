<?php
require_once 'RESTfulInterface.php';
class RoutestopbusHandler implements RESTfulInterface{
    public function restGet($params){
        include('./conn/conn.php');
        if($params[0]===""){
            $sql = "SELECT * from `rstop_bus`";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $Name;
                        $check=mysqli_query($conn," SELECT * from `route_bus`  where `ROUTE_ID`  LIKE  $ROUTE_ID ");              
                        while($rc2=mysqli_fetch_assoc($check)){
                            extract($rc2);
                            $Name = $ROUTE_NAMEE;
                            break;
                        }
                        $dbdata['code']=200;
                        $dbdata['table'][]=array(
                            'Bus'   => $Name,
                            'ROUTE_ID' => $ROUTE_ID,
                            'ROUTE_SEQ' => $ROUTE_SEQ,
                            'STOP_SEQ' => $STOP_SEQ,
                            'STOP_ID' => $STOP_ID,
                            'STOP_PICK_DROP' => $STOP_PICK_DROP,
                            'STOP_NAMEC' => $STOP_NAMEC,
                            'STOP_NAMES'=>$STOP_NAMES,
                            'STOP_NAMEE'=>$STOP_NAMEE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE,                           
                        );	
                    }
                }else{
                    $dbdata['code']=401;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Loc" && $params[2]=="Start" && $params[4] =="End"){
            $sql = "SELECT `ROUTE_ID` from `route_bus` 
                    where 
                    LOC_START_NAMEC LIKE'%$params[3]%' AND LOC_END_NAMEC LIKE'%$params[5]%' OR
                    LOC_START_NAMES LIKE'%$params[3]%' AND LOC_END_NAMES LIKE'%$params[5]%' OR
                    LOC_START_NAMEE LIKE'%$params[3]%' AND LOC_END_NAMEE LIKE'%$params[5]%'";
            if($rs = mysqli_query($conn,$sql)){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $sql1 = "SELECT * from `rstop_bus` 
                                WHERE
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMEC` LIKE '%$params[1]%'OR 
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMES` LIKE '%$params[1]%' OR
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMEE` LIKE '%$params[1]%'";
                        $rs1 = mysqli_query($conn,$sql1);
                        if($rs1){
                            $numrow1=mysqli_num_rows($rs1);
                            if($numrow1>0){
                                while($rc1=mysqli_fetch_assoc($rs1)){
                                    extract($rc1);
                                    $Name;
                                    $check=mysqli_query($conn," SELECT * from `route_bus`  where `ROUTE_ID`  LIKE  $ROUTE_ID ");              
                                    while($rc2=mysqli_fetch_assoc($check)){
                                        extract($rc2);
                                        $Name = $ROUTE_NAMEE;
                                        break;
                                    }
                                    
                                    $dbdata['code']=200;
                                    $dbdata['table'][]=array(
                                        'Bus'   => $Name,
                                        'ROUTE_ID' => $ROUTE_ID,
                                        'ROUTE_SEQ' => $ROUTE_SEQ,
                                        'STOP_SEQ' => $STOP_SEQ,
                                        'STOP_ID' => $STOP_ID,
                                        'STOP_PICK_DROP' => $STOP_PICK_DROP,
                                        'STOP_NAMEC' => $STOP_NAMEC,
                                        'STOP_NAMES'=>$STOP_NAMES,
                                        'STOP_NAMEE'=>$STOP_NAMEE,
                                        'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE                          
                                    );	
                                }
                                echo json_encode($dbdata);
                                
                            }
                        }else{
                            $dbdata['code']=300;
                            $dbdata['message']="the server is break down, please try it in few second later";
                            echo json_encode($dbdata);
                           
                        }
                        	
                    }
                }else{
                    $dbdata['code']=403;
                    $dbdata['message']="your input can not found result, please try another Input";
                    echo json_encode($dbdata);
                   
                }
            }else{
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
                echo json_encode($dbdata);
                
            }
            if(!isset($dbdata)){
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
                echo json_encode($dbdata);
            }
            mysqli_close($conn);
        }else if( $params[0]=="Start" && $params[2] =="End"){
            $sql = "SELECT * from `rstop_bus` 
                    where 
                    `STOP_NAMEC` LIKE '$params[3]%'OR 
                    `STOP_NAMES` LIKE '$params[3]%' OR
                    `STOP_NAMEE` LIKE '$params[3]%'";

            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $SS1=$STOP_SEQ;
                        $RR1=$ROUTE_SEQ;
                        $sql1 = "SELECT * from `rstop_bus` 
                                WHERE
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMEC` LIKE '$params[1]%'OR 
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMES` LIKE '$params[1]%' OR
                                `ROUTE_ID`   LIKE  $ROUTE_ID AND
                                `STOP_NAMEE` LIKE '$params[1]%'";
                        $rs1 = mysqli_query($conn,$sql1);
                        if($rs1){
                            $numrow1=mysqli_num_rows($rs1);
                            if($numrow1>0){
                                while($rc1=mysqli_fetch_assoc($rs1)){
                                    extract($rc1);
                                    $SS2=$STOP_SEQ;
                                    $RR2=$ROUTE_SEQ;
                                    $Name;
                                    $check=mysqli_query($conn," SELECT * from `route_bus`  where `ROUTE_ID`  LIKE  $ROUTE_ID ");              
                                    while($rc2=mysqli_fetch_assoc($check)){
                                        extract($rc2);
                                        $Name = $ROUTE_NAMEE;
                                        break;
                                    }
                                    $SEQ;
                                    if($SS1<$SS2){
                                        $SEQ = $RR1;
                                    }else{
                                        $SEQ = $RR2;
                                    }
                                    $rs3=mysqli_query($conn,"SELECT * from `rstop_bus`  
                                                            where 
                                                            `ROUTE_ID`  LIKE  $ROUTE_ID AND
                                                            `ROUTE_SEQ` = $SEQ
                                                            ORDER BY `ROUTE_ID` ASC,`ROUTE_SEQ`ASC ,`STOP_SEQ`ASC");   
                                    $numrow3=mysqli_num_rows($rs3);
                                    if($numrow3>0){
                                        while($rc3=mysqli_fetch_assoc($rs3)){
                                            extract($rc3);
                                            $dbdata['code']=200;
                                            $dbdata['table'][]=array(
                                                'Bus'   => $Name,
                                                'ROUTE_ID' => $ROUTE_ID,
                                                'ROUTE_SEQ' => $ROUTE_SEQ,
                                                'STOP_SEQ' => $STOP_SEQ,
                                                'STOP_ID' => $STOP_ID,
                                                'STOP_PICK_DROP' => $STOP_PICK_DROP,
                                                'STOP_NAMEC' => $STOP_NAMEC,
                                                'STOP_NAMES'=>$STOP_NAMES,
                                                'STOP_NAMEE'=>$STOP_NAMEE,
                                                'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE                          
                                            );
                                        }
                                        echo json_encode($dbdata);
                                        break;
                                    }
                                    break;
                                }
                                
                            }
                        }else{
                            $dbdata['code']=300;
                            $dbdata['message']="the server is break down, please try it in few second later";
                            echo json_encode($dbdata);
                        }
                        
                    }
                }else{
                    $dbdata['code']=403;
                    $dbdata['message']="your input can not found result, please try another Input";
                    echo json_encode($dbdata);
                }
            }else{
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
                echo json_encode($dbdata);
            }
            if(!isset($dbdata)){
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
                echo json_encode($dbdata);
            }
            mysqli_close($conn);
        }else if($params[0]=="RID"){
            $sql = "SELECT * from `rstop_bus` WHERE `ROUTE_ID` = $params[1]";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $Name;
                        $check=mysqli_query($conn," SELECT * from `route_bus`  where `ROUTE_ID`  LIKE  $ROUTE_ID ");              
                        while($rc2=mysqli_fetch_assoc($check)){
                            extract($rc2);
                            $Name = $ROUTE_NAMEE;
                            break;
                        }
                        $dbdata['code']=200;
                        $dbdata['table'][]=array(
                            'Bus'   => $Name,
                            'ROUTE_ID' => $ROUTE_ID,
                            'ROUTE_SEQ' => $ROUTE_SEQ,
                            'STOP_SEQ' => $STOP_SEQ,
                            'STOP_ID' => $STOP_ID,
                            'STOP_PICK_DROP' => $STOP_PICK_DROP,
                            'STOP_NAMEC' => $STOP_NAMEC,
                            'STOP_NAMES'=>$STOP_NAMES,
                            'STOP_NAMEE'=>$STOP_NAMEE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE                       
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else if($params[0]=="Location"){
            $sql = "SELECT * from `rstop_bus` 
                    WHERE `STOP_NAMEC` LIKE '$params[1]%'OR 
                    `STOP_NAMES` LIKE '$params[1]%' OR
                    `STOP_NAMEE` LIKE '$params[1]%'";
            $rs = mysqli_query($conn,$sql);
            if($rs){
                $numrow=mysqli_num_rows($rs);
                if($numrow>0){
                    while($rc=mysqli_fetch_assoc($rs)){
                        extract($rc);
                        $Name;
                        $check=mysqli_query($conn," SELECT * from `route_bus`  where `ROUTE_ID`  LIKE  $ROUTE_ID ");              
                        while($rc2=mysqli_fetch_assoc($check)){
                            extract($rc2);
                            $Name = $ROUTE_NAMEE;
                            break;
                        }
                        $dbdata['code']=200;
                        $dbdata['table'][]=array(
                            'Bus'   => $Name,
                            'ROUTE_ID' => $ROUTE_ID,
                            'ROUTE_SEQ' => $ROUTE_SEQ,
                            'STOP_SEQ' => $STOP_SEQ,
                            'STOP_ID' => $STOP_ID,
                            'STOP_PICK_DROP' => $STOP_PICK_DROP,
                            'STOP_NAMEC' => $STOP_NAMEC,
                            'STOP_NAMES'=>$STOP_NAMES,
                            'STOP_NAMEE'=>$STOP_NAMEE,
                            'LAST_UPDATE_DATE'=>$LAST_UPDATE_DATE                          
                        );	
                    }
                }else{
                    $dbdata['code']=404;
                    $dbdata['message']="your input can not found result, please try another Input";
                }
            }else{
                $dbdata['code']=300;
                $dbdata['message']="the server is break down, please try it in few second later";
            }
            echo json_encode($dbdata);
            mysqli_close($conn);
        }else{
            $dbdata['code']=400;
            $dbdata['message']="your API can not found result, please try another API";
            echo json_encode($dbdata);
        }
    }
    public function restPut($params,$key){
        include('./conn/conn.php');
        $UpdateSql="UPDATE rstop_bus 
            SET ROUTE_SEQ = '$params->ROUTE_SEQ' AND
            STOP_SEQ = '$params->STOP_SEQ' AND
            STOP_ID = '$params->STOP_ID' AND
            STOP_PICK_DROP = '$params->STOP_PICK_DROP' AND
            STOP_NAMEC = '$params->STOP_NAMEC' AND
            STOP_NAMES = '$params->STOP_NAMES' AND
            STOP_NAMEE = '$params->STOP_NAMEE' AND
            LAST_UPDATE_DATE = '$params->LAST_UPDATE_DATE' 
            WHERE ROUTE_ID = '$params->ROUTE_ID'";

        $dbdata = array();
        if( mysqli_query($conn,$UpdateSql)){
            $dbdata['code']=202;
            $dbdata['message']=" Route Stop Bus Update.";
        }else{
            $dbdata['code']=201;
            $dbdata['message']="Route Stop Bus Update.";
        }

        echo json_encode($dbdata);
        mysqli_close($conn);
    }
    public function restPost($params,$key){
        include('./conn/conn.php');
        $dbdata = array();
        $InsertSql = "INSERT INTO `rstop_bus` (
            `ROUTE_ID`,`ROUTE_SEQ`,`STOP_SEQ`,`STOP_ID`,`STOP_PICK_DROP`,
            `STOP_NAMEC`,`STOP_NAMES`,`STOP_NAMEE`,`LAST_UPDATE_DATE`) 
            VALUES ('$params->ROUTE_ID','$params->ROUTE_SEQ',
            '$params->STOP_SEQ','$params->STOP_ID','$params->STOP_PICK_DROP',
            '$params->STOP_NAMEC','$params->STOP_NAMES','$params->STOP_NAMEE',
            '$params->LAST_UPDATE_DATE',)";

        if( mysqli_query($conn,$InsertSql)){
            $dbdata['code']=203;
            $dbdata['message'][]=" Route Stop Bus Insert.";
        }else{
            $dbdata['code']=301;
            $dbdata['message'][]=" Route Stop Bus not Insert.";
        }
        echo json_encode($dbdata);
        mysqli_close($conn);
    }
    public function restDelete($params){
        include('./conn/conn.php');
        $DeleteSql = "DELETE from rstop_bus WHERE ROUTE_ID = $params[1]" ;
        if(mysqli_query($conn,$DeleteSql)){
            $dbdata['code']=204;
            $dbdata['message']= ' Route Stop Bus DELETED';
        }else{
            $dbdata['code']=401;
            $dbdata['message']= 'Route Stop Bus no DELETE';
        }      
        echo json_encode($dbdata);
        mysqli_close($conn);
    }
}
?>