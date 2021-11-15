<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/Hummingbird_delivery/style_master.css">
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<head>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/Hummingbird_delivery/header/color.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new account</title>
</head>
<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('/Hummingbird_delivery/header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>Create new account</h1>

            <a href="javascript:history.back()" class="action align-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="36.843" height="36.843" viewBox="0 0 36.843 36.843">
                    <path id="Icon_ionic-ios-arrow-dropleft-circle" data-name="Icon ionic-ios-arrow-dropleft-circle" d="M21.8,3.375A18.422,18.422,0,1,0,40.218,21.8,18.419,18.419,0,0,0,21.8,3.375Zm3.844,25.6a1.716,1.716,0,0,1,0,2.418,1.689,1.689,0,0,1-1.2.5,1.718,1.718,0,0,1-1.213-.5L14.9,23.037a1.707,1.707,0,0,1,.053-2.356L23.4,12.2a1.71,1.71,0,0,1,2.418,2.418L18.564,21.8Z" transform="translate(-3.375 -3.375)" fill="#fafafa"/>
                </svg>                    
                <p>Back</p>
            </a>
        </div>
        <br><br>
        <div>
            <form action="account_creation_process.php" onsubmit="return validate()" id="register" method="post">
                <div class="input-area">
                    <p>Username</p>
                    <input type="text" name="username" id="username">
                </div>
                <br>
                <div class="input-area">
                    <p>Email</p>
                    <input type="text" name="email" id="email">
                </div>
                <br>
                <div class="input-area">
                    <p>Password</p>
                    <input type="password" name="password1" id="password1">
                </div>
                <br>
                <div class="input-area">
                    <p>Retype Password</p>
                    <input type="password" name="password2" id="password2">
                </div>
                <br>

                <div class="input-area">
                    <p>First name</p>
                    <input type="text" name="fname" id="fname">
                </div>
                <br>
                <div class="input-area">
                    <p>Last name</p>
                    <input type="text" name="lname" id="lname">
                </div>
                <br>
                <div class="input-area">
                    <p>Phone number</p>
                    <input type="tel" name="phone" id="phone">
                </div>
                <br>
            </form>
            
            <br><br>

            <div class="content-center">
                <button type="submit" form="register">Create</button>
            </div>
        </div>
    </div>
</body>

<script>
    function validate() {
        const pass        = $("#password1").val();
        const pass_repeat = $("#password2").val();
        
        if(pass != pass_repeat) {
            $("#password2").addClass("pass-not-match");
            return false;
        }

        return true;
    }
</script>
</html>