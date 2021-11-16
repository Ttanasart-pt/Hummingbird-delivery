<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');

    $username = "";
    $email    = "";
    if($_COOKIE["islogin"]) {
        session_start();
        $user_id    = $_SESSION["user_id"];
        echo "<script>user_id = ".$user_id."</script>";

        $q = "SELECT username, email FROM user WHERE user_id = $user_id LIMIT 1";
        $res = $mysqli -> query($q);
        if($res) {
            while($user = $res -> fetch_array()) {
                $username = $user["username"];
                $email    = $user["email"];
            } 
        } else {
            echo "<script>console.log('User query error ".$mysqli->error."')</script>";
        }
    } else {
        echo "<script>user_id = -1</script>";
    }
    // $user_role  = $_SESSION["user_role"];

    // switch($user_role) {
    //     case 0 : $user_mode = "U"; break;
    //     case 1 : $user_mode = "S"; break;
    //     case 2 : $user_mode = "C"; break;
    //     case 3 : $user_mode = "W"; break;
    // }
    // echo "<script>user_mode = '".$user_mode."'</script>";
?>

<div class="header">
    <div class="menu">
        <a href="/Hummingbird_delivery/pricing.html">Pricing</a>
        <a href="/Hummingbird_delivery/tracking.html">Tracking</a>

        <svg class="stroke light" xmlns="http://www.w3.org/2000/svg" width="2" height="56" viewBox="0 0 2 56">
            <line id="Line_2" data-name="Line 2" y2="56" transform="translate(1)" fill="none" stroke="#e6e6e6" stroke-width="2"/>
        </svg>
        <a href="/Hummingbird_delivery/index.html">
            <svg xmlns="http://www.w3.org/2000/svg" width="69.425" height="56.852" viewBox="0 0 69.425 56.852">
                <g id="Group_1" data-name="Group 1" transform="translate(-68.384 -80.965)">
                <path id="Path_1" data-name="Path 1" d="M80.009,213.349,68.384,223.866l12.73,7.815L89.84,217.7l-9.667,1.529Z" transform="translate(0 -98.947)" fill="#f7941d"/>
                <path id="Path_2" data-name="Path 2" d="M130.164,222.263l16.221-2.468-2.633,4.312h-7.49l-17.475,17.475Z" transform="translate(-37.672 -103.765)" fill="#118bff"/>
                <path id="Path_3" data-name="Path 3" d="M225.317,121.376l-16.581,1.674-7.09,11.614c-3.055.422-11.213,1.547-16.183,2.209l14.943-19.085Z" transform="translate(-87.508 -27.523)" fill="#118bff"/>
                <path id="Path_4" data-name="Path 4" d="M100.794,108.566l9.51,15,12.545,2.8,3.5-4.471L116.3,111.746Z" transform="translate(-24.224 -20.63)" fill="#118bff"/>
                <path id="Path_5" data-name="Path 5" d="M149.356,94.3l-10.68-9.589-14.4-3.744,3.625,6.814,7.333,1.663,10.426,9.572Z" transform="translate(-41.779)" fill="#118bff"/>
                <path id="Path_6" data-name="Path 6" d="M158.843,171.418l-2.584,8.949-33.652,5.363-.253-4.209,33.635-5.484Z" transform="translate(-40.338 -67.607)" fill="#f7941d"/>
                </g>
            </svg>
        </a>
        <svg class="stroke light" xmlns="http://www.w3.org/2000/svg" width="2" height="56" viewBox="0 0 2 56">
            <line id="Line_2" data-name="Line 2" y2="56" transform="translate(1)" fill="none" stroke="#e6e6e6" stroke-width="2"/>
        </svg>
        
        <a href="">Support</a>
        <a href="">About us</a>
    </div>
    <div class="user"> 
        <div id="action"></div>
        <!-- <script> $(function() { $('#action').load('/Hummingbird_delivery/header/action_delivery.html'); }) </script> -->

        <div class="notification">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="29.25" viewBox="0 0 24 29.25">
                <path id="Icon_material-notifications" data-name="Icon material-notifications" d="M18,33a3.009,3.009,0,0,0,3-3H15A3,3,0,0,0,18,33Zm9-9V16.5c0-4.6-2.46-8.46-6.75-9.48V6a2.25,2.25,0,0,0-4.5,0V7.02C11.445,8.04,9,11.88,9,16.5V24L6,27v1.5H30V27Z" transform="translate(-6 -3.75)"/>
            </svg>              
        </div>

        <a class="userarea" onclick="accountOverlayToggle()">
            <svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" viewBox="0 0 54 54">
                <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt" d="M15.141,17.034A8.517,8.517,0,1,0,6.624,8.517,8.519,8.519,0,0,0,15.141,17.034Zm7.57,1.893H19.453a10.3,10.3,0,0,1-8.623,0H7.57A7.57,7.57,0,0,0,0,26.5v.946a2.84,2.84,0,0,0,2.839,2.839h24.6a2.84,2.84,0,0,0,2.839-2.839V26.5A7.57,7.57,0,0,0,22.711,18.926Z" transform="translate(11.859 10.859)" fill="#fafafa"/>
            </svg>              
        </a>
    </div>

    <div class="account-overlay" id="account-overlay">
        <div id="login-detail">
            <h2 style="margin: 0px;">Login</h2>
            <!-- <form action="login.php"> -->
            <form action="/Hummingbird_delivery/header/login_process.php" method="post">
                <div style="width: 100%;">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>

                <div style="width: 100%;">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>

                <button type="submit">Login</button>
                <a href="/Hummingbird_delivery/user/account_creation.php">Create new account</a>
            </form>
        </div>
        <div id="account-detail">
            <?php
                
            ?>
            <div class="account-profile">
                <div class="profile-bg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="65.262" height="65.262" viewBox="0 0 65.262 65.262">
                        <path id="Icon_awesome-user-alt" data-name="Icon awesome-user-alt" d="M32.631,36.71A18.355,18.355,0,1,0,14.276,18.355,18.36,18.36,0,0,0,32.631,36.71Zm16.315,4.079H41.923a22.188,22.188,0,0,1-18.584,0H16.315A16.314,16.314,0,0,0,0,57.1v2.039a6.12,6.12,0,0,0,6.118,6.118H59.143a6.12,6.12,0,0,0,6.118-6.118V57.1A16.314,16.314,0,0,0,48.946,40.789Z" fill="#fafafa"/>
                    </svg>
                </div>
                <div></div>
                <div>
                    <h3><?php echo $username; ?></h3>
                    <p><?php echo $email; ?></p>
                </div>
            </div>
            <a class="account-menu" href="/Hummingbird_delivery/user/account_data.html">Account detail</a>
            <a class="account-menu">Locations</a>
            <a class="account-logout" href="/Hummingbird_delivery/header/logout_process.php">Logout</a>
        </div>
    </div>

    <div class="mode-toggle">
        <a id="color" onclick="toggleDarkMode()"><div style="background-color: var(--accent);">Toggle light / dark mode</div></a>
        <div style="width: 16px;"></div>

        <a id="mode-u" class="user-mode blue"   onclick="setMode(this)">U<div class="blue"  >User view</div></a>
        <a id="mode-s" class="user-mode orange" onclick="setMode(this)">S<div class="orange">Counter view</div></a>
        <a id="mode-c" class="user-mode purple" onclick="setMode(this)">C<div class="purple">Carrier view</div></a>
        <a id="mode-w" class="user-mode orange" onclick="setMode(this)">W<div class="orange">Warehouse view</div></a>
    </div>
</div>

<script>
    root = document.documentElement;
    const dark = getCookie("dark", "false");
    user_mode  = getCookie("mode", "U");

    const ol = document.getElementById("account-overlay");
    function accountOverlayToggle() {
        if($('#account-overlay').is(":hidden"))
            $('#account-overlay').show();
    }

    $(document).mouseup(function(e) {
        if($(e.target).closest(".account-overlay").length === 0) {
            $('#account-overlay').hide();
        }
    })
    $('#account-overlay').hide();

    function setMode(o) {
        const d = new Date();
        d.setTime(d.getTime() + (24*60*60*1000));
        let e = "expires=" + d.toUTCString();
        document.cookie = "mode=" + o.innerHTML[0] + ";" + e + ";path=/";

        window.location.reload(false);
    }

    function toggleDarkMode() {
        let m = dark == "true"? "false" : "true";

        const d = new Date();
        d.setTime(d.getTime() + (99*24*60*60*1000));
        let e = "expires=" + d.toUTCString();
        document.cookie = "dark=" + m + ";" + e + ";path=/";

        window.location.reload(false);
    }

    function init_user() { 
        if(user_id != -1) {
            $('#account-detail').show();
            $('.user-mode').show();
            $('#login-detail').hide();

            switch(user_mode) {
                case "U": 
                    $('#action').load('/Hummingbird_delivery/header/action_delivery.html'); 
                    root.style.setProperty('--accent', 'var(--blue)');
                    $('#mode-u').addClass("toggled");
                    break;
                case "S": 
                    $('#action').load('/Hummingbird_delivery/header/action_package_add.html'); 
                    root.style.setProperty('--accent', 'var(--orange)');
                    $('#mode-s').addClass("toggled");
                    break;
                case "C": 
                    $('#action').load('/Hummingbird_delivery/header/action_carrier.html'); 
                    root.style.setProperty('--accent', 'var(--purple)');
                    $('#mode-c').addClass("toggled");
                    break;
                case "W": 
                    $('#action').load('/Hummingbird_delivery/header/action_warehouse.html'); 
                    root.style.setProperty('--accent', 'var(--orange)');
                    $('#mode-w').addClass("toggled");
                    break;
            }
        } else {
            $('#account-detail').hide();
            $('.user-mode').hide();
            $('#login-detail').show();
        }
    }
</script>

<?php
    echo "<script>init_user();</script>";
    $mysqli -> close();
?>