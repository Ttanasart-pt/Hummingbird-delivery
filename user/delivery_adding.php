<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');
    $userid = 1;
    $desti  = $_POST['destination'];
    $note   = $_POST['note'];
    $cost   = 100;

    $q = "insert into delivery(sender_id, destination, cost, note) values ({$userid}, {$desti}, {$cost}, '{$note}');";
    $result = $mysqli -> query($q);
    
    $mysqli -> close();

    echo '<script>history.go(-2);</script>';
?>