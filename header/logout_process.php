<?php
    session_unset();
    session_destroy();

    header("Location: /Hummingbird_delivery/index.html");
?>