<?php

/*-----------------load router stop bus database in $routerStopBusObject variable----------------------*/
echo "<-------table rstop_bus--------><br>";
$routerStopBusObject = simplexml_load_file("https://static.data.gov.hk/td/routes-fares-xml/RSTOP_BUS.xml") or die("Error: Cannot create object");

//check table eixsts
$route_stop_bus_records = "SELECT * FROM rstop_bus";
if (mysqli_query($conn, $route_stop_bus_records)) {
    echo "rstop_bus Table exists<br>";
} else {
    //create route_stop_bus table 
    $sql = "CREATE TABLE `rstop_bus` (
        `ROUTE_ID` int(11) UNSIGNED NOT NULL,
        `ROUTE_SEQ` int(11) NOT NULL,
        `STOP_SEQ` int(11) NOT NULL,
        `STOP_ID` int(11) UNSIGNED NOT NULL,
        `STOP_PICK_DROP` int(11) NOT NULL,
        `STOP_NAMEC` varchar(256) NOT NULL,
        `STOP_NAMES` varchar(256) NOT NULL,
        `STOP_NAMEE` varchar(256) NOT NULL,
        `LAST_UPDATE_DATE` datetime NOT NULL,
        FOREIGN KEY (ROUTE_ID) REFERENCES route_bus(ROUTE_ID),
        FOREIGN KEY (STOP_ID) REFERENCES stop_bus(STOP_ID)
      ) ";
    if (mysqli_query($conn, $sql)) {
        echo "rstop_bus Table Create<br>";
        //insert datas in database -> table name -> route_bus
        $stmt = $conn->prepare("INSERT INTO `rstop_bus` (`ROUTE_ID`,`ROUTE_SEQ`,`STOP_SEQ`,`STOP_ID`,`STOP_PICK_DROP`,
        `STOP_NAMEC`,`STOP_NAMES`,`STOP_NAMEE`,`LAST_UPDATE_DATE`) VALUES(?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("iiiiissss", $ROUTE_ID, $ROUTE_SEQ, $STOP_SEQ, $STOP_ID, $STOP_PICK_DROP, $STOP_NAMEC, $STOP_NAMES, $STOP_NAMEE, $LAST_UPDATE_DATE);
        foreach ($routerStopBusObject as $routerStopBusData) {
            $ROUTE_ID = $routerStopBusData->ROUTE_ID;
            $ROUTE_SEQ = $routerStopBusData->ROUTE_SEQ;
            $STOP_SEQ = $routerStopBusData->STOP_SEQ;
            $STOP_ID = $routerStopBusData->STOP_ID;
            $STOP_PICK_DROP = $routerStopBusData->STOP_PICK_DROP;
            $STOP_NAMEC = $routerStopBusData->STOP_NAMEC;
            $STOP_NAMES = $routerStopBusData->STOP_NAMES;
            $STOP_NAMEE = $routerStopBusData->STOP_NAMEE;
            $LAST_UPDATE_DATE = $routerStopBusData->LAST_UPDATE_DATE;
            if (!$stmt->execute()) {
                echo $stmt->error . "<br>";
            }
        }
        $stmt->close();
        echo "insert data in rstop_bus table successfully<br>";
    } else {
        echo "rstop_bus Table create fail<br>";
    }
}