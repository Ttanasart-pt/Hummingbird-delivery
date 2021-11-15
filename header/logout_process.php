<?php
    session_unset();
    session_destroy();
    setcookie("islogin", false);

    header("Location: /Hummingbird_delivery/index.html");
?>