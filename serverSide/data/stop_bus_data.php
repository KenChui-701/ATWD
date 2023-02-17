<?php
/*-----------------load stop bus database in $stopBusObject variable----------------------*/
echo "<-------table stop_bus--------><br>";
$stopBusObject = simplexml_load_file("https://static.data.gov.hk/td/routes-fares-xml/STOP_BUS.xml") or die("Error: Cannot create object");

//check table eixsts
$stop_bus_records = "SELECT * FROM stop_bus";
if (mysqli_query($conn, $stop_bus_records)) {
    echo "stop_bus Table exists<br>";
} else {
    //create stop_bus table 
    $sql = "CREATE TABLE `stop_bus` (
        `STOP_ID` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `STOP_TYPE` int(11) NOT NULL,
        `X` int(11) NOT NULL,
        `Y` int(11) NOT NULL,
        `LAST_UPDATE_DATE` datetime NOT NULL
      ) ";
    if (mysqli_query($conn, $sql)) {
        echo "stop_bus Table Create<br>";
        //insert datas in database -> table name -> route_bus
        $stmt = $conn->prepare("INSERT INTO `stop_bus` (`STOP_ID`,`STOP_TYPE`,`X`,`Y`,`LAST_UPDATE_DATE`) VALUES(?,?,?,?,?)");
        $stmt->bind_param("iiiis", $STOP_ID, $STOP_TYPE, $X, $Y, $LAST_UPDATE_DATE);
        foreach ($stopBusObject as $stopBusData) {
            $STOP_ID = $stopBusData->STOP_ID;
            $STOP_TYPE = $stopBusData->STOP_TYPE;
            $X = $stopBusData->X;
            $Y = $stopBusData->Y;
            $LAST_UPDATE_DATE = $stopBusData->LAST_UPDATE_DATE;
            if (!$stmt->execute()) {
                echo $stmt->error . "<br>";
            }
        }
        $stmt->close();
        echo "insert data in stop_bus table successfully<br>";
    } else {
        echo "stop_bus Table create fail<br>";
    }
}
