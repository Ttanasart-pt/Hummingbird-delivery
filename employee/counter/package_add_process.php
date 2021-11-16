<?php
    $mysqli = new mysqli('localhost', 'root', '', 'hummingbird');

    if($mysqli->connect_errno) {
        echo "<script>history.go(-1);</scprit>";
    } else {
        $id         = $_POST['packageid'];
        $type       = $_POST['packagetype'];
        $dim_w      = $_POST['dim_w'];
        $dim_h      = $_POST['dim_h'];
        $dim_d      = $_POST['dim_d'];
        $weight     = $_POST['weight'];

        $q   = "CALL PackageReceive('$id', $type, $weight, $dim_w, $dim_h, $dim_d)";
        $res = $mysqli -> query($q);

        if(!$res){
            echo "Select failed. Error: ".$mysqli->error ;
            return false;
        } else {
            header("Location: /Hummingbird_delivery/employee/counter/package_add.php");
        }
    }

    $mysqli -> close();
?>