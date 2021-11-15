<?php require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php'); ?>

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
    <title>Location add</title>
</head>
<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('/Hummingbird_delivery/header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>New location</h1>

            <a href="javascript:history.back()" class="action align-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="36.843" height="36.843" viewBox="0 0 36.843 36.843">
                    <path id="Icon_ionic-ios-arrow-dropleft-circle" data-name="Icon ionic-ios-arrow-dropleft-circle" d="M21.8,3.375A18.422,18.422,0,1,0,40.218,21.8,18.419,18.419,0,0,0,21.8,3.375Zm3.844,25.6a1.716,1.716,0,0,1,0,2.418,1.689,1.689,0,0,1-1.2.5,1.718,1.718,0,0,1-1.213-.5L14.9,23.037a1.707,1.707,0,0,1,.053-2.356L23.4,12.2a1.71,1.71,0,0,1,2.418,2.418L18.564,21.8Z" transform="translate(-3.375 -3.375)" fill="#fafafa"/>
                </svg>                    
                <p>Back</p>
            </a>
        </div>
        <br><br>
        <div>
            <form action="location_add_process.php" id="location-add" method="post">
                <div class="input-area">
                    <p>Name</p>
                    <input type="text" name="name" id="name">
                </div>
                <br>
                <div class="input-area">
                    <p>Location type</p>
                    <select name="type" id="type">
                        <?php 
                            $q = 'select * from location_type;';

                            if( $result = $mysqli -> query($q)) {
                                while( $row = $result -> fetch_array()) {
                                    echo "<option value={$row[0]}>{$row[1]}</option>}";
                                }
                            } else {
                                echo "<div class='error-box'>Query failed : {$mysqli -> error} </div>";
                            }
                        ?>
                    </select>
                </div>
                <br>
                <div class="input-area">
                    <p>Address 1</p>
                    <textarea name="address_1" id="address_1" rows="1" cols="50" oninput="auto_grow(this)"></textarea>
                </div>
                <br>
                <div class="input-area">
                    <p>Address 2</p>
                    <textarea name="address_2" id="address_2" rows="1" cols="50" oninput="auto_grow(this)"></textarea>
                </div>
                <br>
                <div class="input-area">
                    <p>State</p>
                    <input type="text" name="state" id="state">
                </div>
                <br>
                <div class="input-area">
                    <p>City</p>
                    <input type="text" name="city" id="city">
                </div>
                <br>
                <div class="input-area">
                    <p>Zip code</p>
                    <input type="text" name="zip" id="zip">
                </div>
                <br>
                <div class="input-area">
                    <p>Country</p>
                    <input type="text" name="country" id="country">
                </div>
            </form>
            
            <br><br>

            <div class="content-center">
                <button type="submit" form="location-add">Submit</button>
            </div>
        </div>
    </div>

    <script>
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
    </script>
</body>
</html>

<?php $mysqli -> close(); ?>