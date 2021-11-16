<?php
    $mysqli = new mysqli('localhost', 'root', '', 'hummingbird');

    if($mysqli->connect_errno) {
        echo "<script>history.go(-1);</scprit>";
    } else {
        $delivery_id   = $_GET['delivery_id'];
        
        $q   = "CALL DeliveryCancel('$delivery_id');";
        echo $q;
        $res = $mysqli -> query($q);

        if(!$res){
            echo "<br>Delivery cancel failed. Error: ".$mysqli->error ;
            return false;
        } else {
            header("Location: /Hummingbird_delivery/user/delivery_data.php");
        }
    }

    $mysqli -> close();
?>