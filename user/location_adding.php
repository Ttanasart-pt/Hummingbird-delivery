<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');
    $userid = 1;
    $name   = $_POST['name'];
    $type   = $_POST['type'];
    $add1   = $_POST['address_1'];
    $add2   = $_POST['address_2'];
    $state  = $_POST['state'];
    $city   = $_POST['city'];
    $zip    = $_POST['zip'];
    $country = $_POST['country'];

    $q = "insert into location(user_id, location_name, location_type, address_1, address_2, state, city, zip, country) values ({$userid}, '{$name}', {$type}, '{$add1}', '{$add2}', '{$state}', '{$city}', '{$zip}', '{$country}');";
    $result = $mysqli -> query($q);
    
    $mysqli -> close();

    echo '<script>history.go(-2);</script>';
?>