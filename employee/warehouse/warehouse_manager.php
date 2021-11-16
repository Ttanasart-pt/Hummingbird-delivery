<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');

    if(isset($_GET['delivery_id'])) {
        $id = $_GET['delivery_id'];
        $q = "CALL WarehouseGetPackage($id);";
        $res = $mysqli -> query($q);
        if(!$res) {
            echo $mysqli->error;
        }
    }

    if(isset($_GET['transit_delivery_id'])) {
        $id = $_GET['transit_delivery_id'];
        $q = "CALL CourierGetPackage($id, 4);";
        $res = $mysqli -> query($q);
        if(!$res) {
            echo $mysqli->error;
        }
    }

    function generatePackage($packageid, $deliveryid, $destination, $dim_w, $dim_h, $dim_d) {
        echo '<div class="warehouse-item">';
        // echo '    <svg xmlns="http://www.w3.org/2000/svg" width="28.779" height="20.145" viewBox="0 0 28.779 20.145">';
        // echo '    <path id="Icon_awesome-box-open" data-name="Icon awesome-box-open" ';
        // echo '        d="M19.14,12.321a2.18,2.18,0,0,1-1.862-1.052L14.388,6.476,11.5,11.269a2.187,2.187,0,0,1-1.866,1.057,2.068,2.068,0,0,1-.6-.085l-6.16-1.763v8a1.434,1.434,0,0,0,1.088,1.394l9.721,2.433a2.923,2.923,0,0,0,1.394,0l9.73-2.433A1.442,1.442,0,0,0,25.9,18.481v-8l-6.16,1.758A2.068,2.068,0,0,1,19.14,12.321ZM28.7,7.276,26.384,2.654a.734.734,0,0,0-.751-.4L14.388,3.688l4.123,6.839a.739.739,0,0,0,.832.328l8.9-2.541A.741.741,0,0,0,28.7,7.276ZM2.391,2.654.075,7.276A.733.733,0,0,0,.53,8.31l8.9,2.541a.739.739,0,0,0,.832-.328l4.128-6.835L3.137,2.254a.735.735,0,0,0-.746.4Z" transform="translate(0.003 -2.247)"/>';
        // echo '    </svg>';
        $previewid = "preview".$packageid;
        echo '    <div id="'.$previewid.'" style="display: flex;justify-content: center;"></div>';
        echo '    <script>var cube = generatePreview("'.$previewid.'", 240, 200); cube.scale.x = '.$dim_w.';cube.scale.y = '.$dim_h.';cube.scale.z = '.$dim_d.'; </script>';
        echo '    <h2>PKG'.$packageid.'</h2>';
        echo '    <h3>DL'.$deliveryid.'</h3>';
        echo '    <p>'.$destination.'</p>';
        echo '</div>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/Hummingbird_delivery/style_master.css">
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="./style.css">
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
    <title>Warehouse manager</title>
</head>

<body>
    <div id="header">
        <div class="header">
            <div class="menu" style="justify-content: start; margin-left: 32px; width: calc(100% - 32px);">
                <a href="/Hummingbird_delivery/index.html" style="margin: 0px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="69.425" height="56.852" viewBox="0 0 69.425 56.852">
                        <g id="Group_1" data-name="Group 1" transform="translate(-68.384 -80.965)">
                        <path id="Path_1" data-name="Path 1" d="M80.009,213.349,68.384,223.866l12.73,7.815L89.84,217.7l-9.667,1.529Z" transform="translate(0 -98.947)" fill="var(--text)"/>
                        <path id="Path_2" data-name="Path 2" d="M130.164,222.263l16.221-2.468-2.633,4.312h-7.49l-17.475,17.475Z" transform="translate(-37.672 -103.765)" fill="var(--text)"/>
                        <path id="Path_3" data-name="Path 3" d="M225.317,121.376l-16.581,1.674-7.09,11.614c-3.055.422-11.213,1.547-16.183,2.209l14.943-19.085Z" transform="translate(-87.508 -27.523)" fill="var(--text)"/>
                        <path id="Path_4" data-name="Path 4" d="M100.794,108.566l9.51,15,12.545,2.8,3.5-4.471L116.3,111.746Z" transform="translate(-24.224 -20.63)" fill="var(--text)"/>
                        <path id="Path_5" data-name="Path 5" d="M149.356,94.3l-10.68-9.589-14.4-3.744,3.625,6.814,7.333,1.663,10.426,9.572Z" transform="translate(-41.779)" fill="var(--text)"/>
                        <path id="Path_6" data-name="Path 6" d="M158.843,171.418l-2.584,8.949-33.652,5.363-.253-4.209,33.635-5.484Z" transform="translate(-40.338 -67.607)" fill="var(--text)"/>
                        </g>
                    </svg>
                </a>
                <h3 style="color: var(--text);">Hummingbird<br>Warehouse</h3>

                <?php
                    $filter = "";
                    if(isset($_GET['filter']) && $_GET['filter'] != "") 
                        $filter = $_GET['filter'];
                ?>
                
                <div class="search-box" style="width:100%; margin-left: 16px;">
                    <form action="warehouse_manager.php" method="get" class="search" id="search" style="width:100%">
                        <input type="text" name="search_qury" id="delivery-search" placeholder="Search for destination, package id, status" value="<?php echo $filter; ?>">
                    </form>
                    <button class="search" type="submit" form="search" value="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.513" height="23.513" viewBox="0 0 23.513 23.513">
                            <g id="Group_7" data-name="Group 7" transform="translate(-1438 -268)">
                            <path id="Ellipse_8" data-name="Ellipse 8" d="M9.436,4a5.436,5.436,0,1,0,5.436,5.436A5.442,5.442,0,0,0,9.436,4m0-4A9.436,9.436,0,1,1,0,9.436,9.436,9.436,0,0,1,9.436,0Z" transform="translate(1438 268)"/>
                            <path id="Line_9" data-name="Line 9" d="M6.039,8.039a1.994,1.994,0,0,1-1.414-.586L-1.414,1.414a2,2,0,0,1,0-2.828,2,2,0,0,1,2.828,0L7.453,4.625A2,2,0,0,1,6.039,8.039Z" transform="translate(1453.475 283.475)"/>
                            </g>
                        </svg>                  
                    </button>
                </div>
                
                <a onclick="QRReader_open(0)" class="action" style="margin-right: 4px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23.737" height="23.737" viewBox="0 0 23.737 23.737">
                        <path id="Icon_awesome-qrcode" data-name="Icon awesome-qrcode" d="M0,12.423H10.173V2.25H0ZM3.391,5.641H6.782V9.032H3.391ZM13.564,2.25V12.423H23.737V2.25Zm6.782,6.782H16.955V5.641h3.391ZM0,25.987H10.173V15.814H0Zm3.391-6.782H6.782V22.6H3.391Zm18.651-3.391h1.7V22.6H18.651V20.9h-1.7v5.087H13.564V15.814h5.087v1.7h3.391Zm0,8.478h1.7v1.7h-1.7Zm-3.391,0h1.7v1.7h-1.7Z" transform="translate(23.737 25.987) rotate(180)" fill="#fafafa"/>
                    </svg>                  
                    <p>Receive</p>
                </a>
                
                <a onclick="QRReader_open(1)" class="action" style="margin-left: 4px; background-color: var(--purple);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32.501" height="26.407" viewBox="0 0 32.501 26.407">
                        <path id="Icon_metro-truck" data-name="Icon metro-truck" d="M35.071,20l-4.063-8.125H24.915V7.815a2.037,2.037,0,0,0-2.031-2.031H4.6A2.037,2.037,0,0,0,2.571,7.815v16.25L4.6,26.1H7.178a4.063,4.063,0,1,0,7.035,0H25.46a4.063,4.063,0,1,0,7.035,0h2.576V20ZM24.915,20V13.909h4.211L32.173,20H24.915Z" transform="translate(-2.571 -5.784)" fill="#fafafa"/>
                    </svg>
                    <p>Transit</p>
                </a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="warehouse-grid">
            <?php
                if(isset($_GET['filter']) && $_GET['filter'] != "") {
                    $filter = strtolower($_GET['filter']);

                    $q = "SELECT d.delivery_id, p.package_id, p.dim_w, p.dim_h, p.dim_d, getlocation(d.destination) as destination 
                    FROM delivery d, package p 
                    WHERE d.package_id = p.package_id AND p.status = 3
                        AND (LOWER(destination) LIKE '%$filter%'
                        OR LOWER(d.package_id) LIKE '%$filter%')
                      ORDER BY d.creation_date DESC;";
                } else {
                    $q = "SELECT d.delivery_id, p.package_id, p.dim_w, p.dim_h, p.dim_d, getlocation(d.destination) as destination 
                        FROM delivery d, package p 
                        WHERE d.package_id = p.package_id AND p.status = 3;";
                }
                $res = $mysqli -> query($q);
                if($res) {
                    while($row = $res->fetch_array()) {
                        generatePackage($row['package_id'], $row['delivery_id'], $row['destination'], $row['dim_w'], $row['dim_h'], $row['dim_d']);
                    }
                } else {
                    echo $mysqli->error;
                }
            ?>
        </div>
    </div>
    
    <div id="qr-reader-parent" class="overlay grey">
        <div class="qr-block">
            <h3 id = "QR-title">Delivery QR code</h3>
            <div id="qr-reader"></div>

            <button style="margin-top: 16px;" onclick="QRReader_close()">Close</button>
        </div>
    </div>
</body>

<script>
    var qr_mode = 0;
    $('#qr-reader-parent').hide();
    function QRReader_open(mode) {
        $('#qr-reader-parent').show();
        qr_mode = mode;

        switch(qr_mode) {
            case 0 : $('#QR-title').html("Delivery QR code"); break;
            case 1 : $('#QR-title').html("Transit QR code"); break;
        }
    }

    function QRReader_close() {
        $('#qr-reader-parent').hide();
    }

    function onScanSuccess(decodedText, decodedResult) {
        // console.log(`Code scanned = ${decodedText}`, decodedResult);

        switch(qr_mode) {
            case 0 : 
                window.location.href = `/Hummingbird_delivery/employee/warehouse/warehouse_manager.php?delivery_id=${decodedText}`;
                break;
            case 1 : 
                window.location.href = `/Hummingbird_delivery/employee/warehouse/warehouse_manager.php?transit_delivery_id=${decodedText}`;
                break;
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
</script>
</html>

<?php
    $mysqli -> close();
?>