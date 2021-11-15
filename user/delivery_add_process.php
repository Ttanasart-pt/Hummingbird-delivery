<?php
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');
    $userid = $_SESSION['user_id'];
    $desti  = $_POST['destination'];
    $note   = $_POST['note'];
    $cost   = 100;

    $q = "insert into delivery(sender_id, destination, cost, note, creation_date) values ({$userid}, {$desti}, {$cost}, '{$note}', NOW());";
    $result = $mysqli -> query($q);
    
    $mysqli -> close();

    header("Location: /Hummingbird_delivery/user/delivery_data.php");
?>