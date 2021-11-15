<?php
    $mysqli = new mysqli('localhost', 'root', '', 'hummingbird');

    if($mysqli->connect_errno) {
        echo "<script>history.go(-1);</scprit>";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $salt = '';
        $salt_q   = "SELECT salt FROM salt";
        $res = $mysqli -> query($salt_q);
        if($res) while($ret = $res -> fetch_array()) $salt = $ret['salt'];
        $pass = hash("sha256", "$password$salt");

        echo $pass;
        $q   = "SELECT user_id FROM user WHERE username = '$username' AND password = '$pass' LIMIT 1";
        $res = $mysqli -> query($q);

        if(!$res){
            echo "Select failed. Error: ".$mysqli->error ;
            return false;
        } else {
            $start = false;
            while($ret = $res -> fetch_array()) {
                session_start();
                $_SESSION['user_id'] = $ret['user_id'];
                $_SESSION['user_role'] = 0;
                header("Location: /Hummingbird_delivery/index.html");
                $start = true;
            }
            if(!$start) {
                header("Location: /Hummingbird_delivery/index.html");
            } else {
                setcookie("islogin", true);
            }
        }
    }

    $mysqli -> close();
?>