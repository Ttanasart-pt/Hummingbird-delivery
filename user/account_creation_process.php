<?php
    $mysqli = new mysqli('localhost', 'root', '', 'hummingbird');

    if($mysqli->connect_errno) {
        echo "<script>history.go(-1);</scprit>";
    } else {
        $username   = $_POST['username'];
        $password   = $_POST['password1'];
        $email      = $_POST['email'];
        $fname      = $_POST['fname'];
        $lname      = $_POST['lname'];
        $phone      = $_POST['phone'];
        
        $q   = "CALL register_user('$username', '$password', '$email', '$fname', '$lname', '$phone');";
        echo $q;
        $res = $mysqli -> query($q);

        if(!$res){
            echo "<br>Register failed. Error: ".$mysqli->error ;
            return false;
        } else {
            header("Location: /Hummingbird_delivery/index.html");
        }
    }

    $mysqli -> close();
?>