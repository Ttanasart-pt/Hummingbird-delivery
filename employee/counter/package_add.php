<?php
    $mysqli = new mysqli('localhost', 'root', '', 'hummingbird');
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/Hummingbird_delivery/style_master.css">
<link rel="stylesheet" href="../style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

<head>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="/Hummingbird_delivery/header/color.js"></script>

    <script src="/Hummingbird_delivery/3d/three.js"></script>
    <script src="/Hummingbird_delivery/3d/box.js"></script>
    
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receive new package</title>
</head>

<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('/Hummingbird_delivery/header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>New package</h1>
            
            <!-- <a href="javascript:history.back()" class="action align-left">
                <svg xmlns="http://www.w3.org/2000/svg" width="36.843" height="36.843" viewBox="0 0 36.843 36.843">
                    <path id="Icon_ionic-ios-arrow-dropleft-circle" data-name="Icon ionic-ios-arrow-dropleft-circle" d="M21.8,3.375A18.422,18.422,0,1,0,40.218,21.8,18.419,18.419,0,0,0,21.8,3.375Zm3.844,25.6a1.716,1.716,0,0,1,0,2.418,1.689,1.689,0,0,1-1.2.5,1.718,1.718,0,0,1-1.213-.5L14.9,23.037a1.707,1.707,0,0,1,.053-2.356L23.4,12.2a1.71,1.71,0,0,1,2.418,2.418L18.564,21.8Z" transform="translate(-3.375 -3.375)" fill="#fafafa"/>
                </svg>                    
                <p>Back</p>
            </a> -->
        </div>
        <br><br>
        <div>
            <form action="package_add_process.php" id="package-add" method="POST">
                <div class="input-area button">
                    <p>Delivery ID</p>
                    <input type="text" name="packageid" id="packageid">

                    <a onclick="QRReader_open()" style="justify-self: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22.344" height="22.344" viewBox="0 0 22.344 22.344">
                            <path id="Icon_awesome-qrcode" data-name="Icon awesome-qrcode" d="M0,11.826H9.576V2.25H0ZM3.192,5.442H6.384V8.634H3.192ZM12.768,2.25v9.576h9.576V2.25Zm6.384,6.384H15.96V5.442h3.192ZM0,24.594H9.576V15.018H0ZM3.192,18.21H6.384V21.4H3.192Zm17.556-3.192h1.6V21.4H17.556v-1.6h-1.6v4.788H12.768V15.018h4.788v1.6h3.192Zm0,7.98h1.6v1.6h-1.6Zm-3.192,0h1.6v1.6h-1.6Z" transform="translate(22.344 24.594) rotate(180)"/>
                        </svg>                          
                    </a>
                </div>
                <br>
                <div class="input-area">
                    <p>Package type</p>
                    <select name="packagetype" id="packagetype">
                        <option value="null" data-location-full="">---</option>
                        <?php 
                            $q = "select * from package_type;";

                            if( $result = $mysqli -> query($q)) {
                                while( $row = $result -> fetch_array()) {
                                    echo "<option value={$row['package_type_id']}>{$row['name']}</option>";
                                }
                            } else {
                                echo "<div class='error-box'>Query failed : {$mysqli -> error} </div>";
                            }
                        ?>
                    </select>
                </div>
                <br>
                <div class="input-area dim">
                    <p>Package dimension (mm)</p>
                    <input type="number" name="dim_w" id="dim_w" value=100 onchange="updatePackage()">
                    <p style="justify-self: center;">w</p>
                    <input type="number" name="dim_h" id="dim_h" value=100 onchange="updatePackage()">
                    <p style="justify-self: center;">h</p>
                    <input type="number" name="dim_d" id="dim_d" value=100 onchange="updatePackage()">
                    <p style="justify-self: center;">d</p>
                </div>
                <div id="preview" style="display: flex;justify-content: center;"></div>
                <script>const cube = generatePreview("preview", window.innerWidth / 2, window.innerWidth / 4);</script>
                <br>
                <div class="input-area">
                    <p>Package weight (g)</p>
                    <input type="number" name="weight" id="weight">
                </div>
                <br>
            </form>
            <br><br>
            
            <div class="content-center">
                <button type="submit" form="package-add">Package received</button>
            </div>
        </div>
    </div>

    <div id="qr-reader-parent" class="overlay grey">
        <div class="qr-block">
            <h3>Delivery QR code</h3>
            <div id="qr-reader"></div>

            <button style="margin-top: 16px;" onclick="QRReader_close()">Close</button>
        </div>
    </div>
</body>

<script>
    $('#qr-reader-parent').hide();
    function QRReader_open() {
        $('#qr-reader-parent').show();
    }

    function QRReader_close() {
        $('#qr-reader-parent').hide();
    }

    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Code scanned = ${decodedText}`, decodedResult);
        $('#id').val(decodedText);

        QRReader_close();
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    function updatePackage() {
        let w = document.getElementById("dim_w").value;
        let h = document.getElementById("dim_h").value;
        let d = document.getElementById("dim_d").value;

        cube.scale.x = w;
        cube.scale.y = h;
        cube.scale.z = d;
    }

    updatePackage();
</script>
</html>

<?php
    $mysqli -> close();
?>