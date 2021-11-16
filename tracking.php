<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');

    if(isset($_GET['delivery_id'])) {
        $delivery_id = $_GET['delivery_id'];
        $p_type = "";
        $p_w = 200;
        $p_h = 200;
        $p_d = 200;
        $p_weight = 100;
        $status = -1;

        $q = "SELECT pt.name, p.dim_w, p.dim_h, p.dim_d, p.weight, d.delivery_status FROM package p, package_type pt, delivery d 
            WHERE d.delivery_id = {$delivery_id} AND
            p.type = pt.package_type_id AND
            d.package_id = p.package_id LIMIT 1";
        $res = $mysqli -> query($q);
        if($res) {
            while($package = $res->fetch_array()) {
                $p_type = $package['name'];
                $p_w = $package['dim_w'];
                $p_h = $package['dim_h'];
                $p_d = $package['dim_d'];
                $p_weight = $package['weight'];
                $status = $package['delivery_status'];
            }
        } else {
            echo $mysqli->error;
        }
    } else {
        $delivery_id = "";
    }
?>

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

    <script src="/Hummingbird_delivery/3d/three.js"></script>
    <script src="/Hummingbird_delivery/3d/box.js"></script>

    <script>
        function setTimeline(stage) {
            for(let i = 0; i < 5; i++) {
                if(i == stage) {
                    $('#timeline').children().eq(2 + i).addClass("current");
                } else if(i > stage) {
                    $('#timeline').children().eq(2 + i).addClass("disabled");
                }
            }

            $('#progress-line').css('width', `calc((100% - 16vw * 2) / 4 * ${stage})`);
        }
    </script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking</title>
</head>

<script>
    locations = [];
    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: { lat: locations[0][0], lng: locations[0][1] }
        });
        
        for (i = 0; i < locations.length; i++) {
            const marker = new google.maps.Marker({
                position: { lat: locations[i][0], lng: locations[i][1]},
                map: map
            });
        }
    }
</script>
<script type='text/javascript' src='./key.js'></script>

<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>Tracking</h1>
        </div>

        <div class="search-box">
            <form action="./tracking.php" method="get" class="search" id="search">
                <input type="text" name="delivery_id" id="delivery_id" placeholder="Delivery ID" value="<?php echo $delivery_id; ?>">
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

        <br><br>
        <?php 
            echo '<div class="content-center">';
            if($delivery_id == "") {
                echo '<p>Enter delivery id to track</p>';
            } else if($status == -1) {
                echo '<p>Delivery not found</p>';
            }
            echo '</div>';
        ?>

        <div id="result" class="flex-center" <?php if($delivery_id == "" || $status == -1) echo 'style="display: none;"'; ?>>
            <div class="content-center">
                <h1>Result</h1>
            </div>

            <div class="content-center">
                <div id="map" style="width: 60vw; height: 450px;"></div>
            </div>
            
            <br><br>
            <div class="result-timeline" id="timeline">
                <div class="timeline-line"></div>
                <div class="timeline-line progress" id="progress-line"></div>

                <div class="timeline-content">
                    <div class="timeline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34.324" height="34.324" viewBox="0 0 34.324 34.324">
                            <path id="Icon_material-device-hub" data-name="Icon material-device-hub" d="M31.2,29.289l-7.627-7.627V15.6a5.721,5.721,0,1,0-3.814,0v6.064l-7.627,7.627H4.5v9.534h9.534V33.008L21.662,25l7.627,8.009v5.816h9.534V29.289Z" transform="translate(-4.5 -4.5)"/>
                        </svg>
                    </div>
                    <p>Package Received</p>
                </div>

                <div class="timeline-content">
                    <div class="timeline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38.093" height="30.95" viewBox="0 0 38.093 30.95">
                            <path id="Icon_metro-truck" data-name="Icon metro-truck" d="M40.663,22.45,35.9,12.926H28.759V8.165a2.388,2.388,0,0,0-2.381-2.381H4.951A2.388,2.388,0,0,0,2.571,8.165V27.211l2.381,2.381H7.971a4.762,4.762,0,1,0,8.246,0H29.4a4.762,4.762,0,1,0,8.246,0h3.019V22.45Zm-11.9,0V15.307h4.935l3.571,7.142H28.759Z" transform="translate(-2.571 -5.784)"/>
                        </svg>
                    </div>
                    <p>Sending to Main Hub</p>
                </div>

                <div class="timeline-content">
                    <div class="timeline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="37.846" height="30.276" viewBox="0 0 37.846 30.276">
                            <path id="Icon_awesome-warehouse" data-name="Icon awesome-warehouse" d="M29.8,20.816H8.066a.474.474,0,0,0-.473.473l-.006,2.838a.474.474,0,0,0,.473.473H29.8a.474.474,0,0,0,.473-.473V21.289A.474.474,0,0,0,29.8,20.816Zm0,5.677H8.048a.474.474,0,0,0-.473.473L7.569,29.8a.474.474,0,0,0,.473.473H29.8a.474.474,0,0,0,.473-.473V26.966A.474.474,0,0,0,29.8,26.493Zm0-11.354H8.078a.474.474,0,0,0-.473.473L7.6,18.45a.474.474,0,0,0,.473.473H29.8a.474.474,0,0,0,.473-.473V15.612A.474.474,0,0,0,29.8,15.139Zm6.3-8.22L20.011.219a2.847,2.847,0,0,0-2.182,0L1.744,6.919A2.845,2.845,0,0,0,0,9.539V29.8a.474.474,0,0,0,.473.473H5.2a.474.474,0,0,0,.473-.473V15.139A1.913,1.913,0,0,1,7.6,13.247H30.242a1.913,1.913,0,0,1,1.928,1.892V29.8a.474.474,0,0,0,.473.473h4.731a.474.474,0,0,0,.473-.473V9.539A2.845,2.845,0,0,0,36.1,6.919Z" transform="translate(0 -0.002)"/>
                        </svg>
                    </div>
                    <p>Sorting At Main Hub</p>
                </div>

                <div class="timeline-content">
                    <div class="timeline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38.093" height="30.95" viewBox="0 0 38.093 30.95">
                            <path id="Icon_metro-truck" data-name="Icon metro-truck" d="M40.663,22.45,35.9,12.926H28.759V8.165a2.388,2.388,0,0,0-2.381-2.381H4.951A2.388,2.388,0,0,0,2.571,8.165V27.211l2.381,2.381H7.971a4.762,4.762,0,1,0,8.246,0H29.4a4.762,4.762,0,1,0,8.246,0h3.019V22.45Zm-11.9,0V15.307h4.935l3.571,7.142H28.759Z" transform="translate(-2.571 -5.784)"/>
                        </svg>
                    </div>
                    <p>Delivering</p>
                </div>

                <div class="timeline-content">
                    <div class="timeline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="38.224" height="37.402" viewBox="0 0 38.224 37.402">
                            <path id="Union_1" data-name="Union 1" d="M13.486,37.4a4.25,4.25,0,0,1-2.654-.929L.8,28.444A2.123,2.123,0,0,1,.712,25.2a2.2,2.2,0,0,1,2.827,0L9.67,30.1a4.222,4.222,0,0,0,2.654.929h7.85a1.062,1.062,0,1,0,0-2.123h-5.2a2.21,2.21,0,0,1-2.21-1.765,2.126,2.126,0,0,1,2.1-2.482H25.484A7.812,7.812,0,0,1,30.4,26.407l3.086,2.5h3.676a1.065,1.065,0,0,1,1.062,1.061v6.371A1.065,1.065,0,0,1,37.162,37.4Zm.506-18.511a5,5,0,0,1-5-5V5a5,5,0,0,1,5-5h8.891a5,5,0,0,1,5,5v8.891a5,5,0,0,1-5,5Z" transform="translate(0)"/>
                        </svg>
                    </div>
                    <p>Destination Reached</p>
                </div>
            </div>
            <?php 
                $display_stat = 0;
                switch($status) {
                    case 1 : $display_stat = 0; break;
                    case 2 : $display_stat = 1; break;
                    case 3 : $display_stat = 2; break;
                    case 4 : $display_stat = 3; break;
                    case 5 : $display_stat = 4; break;
                    default : $display_stat = -1;
                }
                echo '<script>setTimeline('.$display_stat.');</script>';
            ?>
            <br>
            <div class="content-center">
                <div class="separator"></div>
            </div>
            
            <div class="content-center">
                <table class="result-table">
                    <?php
                        $q = "SELECT de.time, et.name, de.event_location_lat as lat, de.event_location_lng as lng FROM delivery_events de JOIN event_type et ON de.event_type = et.event_type_id WHERE delivery_id = {$delivery_id} ORDER BY time ASC;";
                        $res = $mysqli -> query($q);
                        if($res) {
                            while($d_event = $res -> fetch_array()) {
                                echo '<tr>';
                                echo '    <td>'.$d_event["name"].'</td>';
                                echo '    <td>'.$d_event["time"].'</td>';
                                echo '</tr>';
                                
                                echo "<script>locations.push([".$d_event["lat"].",".$d_event["lng"]."])</script>";
                            }
                        } else {
                            echo $mysqli -> error;
                        }
                    ?>
                </table>
            </div>

            <br>

            <div class="content-center">
                <h1>Package</h1>
            </div>
            
            <div class="content-center">
                <div class="package-detail">
                    <div id="preview" class="package-icon"></div>
                    <script>const cube = generatePreview("preview", 160, 160);</script>
                    <?php echo '<script>cube.scale.x = '.$p_w.';
                                        cube.scale.y = '.$p_h.';
                                        cube.scale.z = '.$p_d.';</script>'; ?>

                    <div class="package-data-index">Package type</div>
                    <div class="package-data-value"><?php echo $p_type; ?></div>

                    <div class="package-data-index">Box dimension</div>
                    <div class="package-data-value"><?php echo $p_w." * ".$p_h." * ".$p_d; ?>mm</div>

                    <div class="package-data-index">Box weight</div>
                    <div class="package-data-value"><?php echo $p_weight; ?> g</div>
                </div>
            </div>
        </div>
        <br>
    </div>
</body>

</html>

<?php $mysqli -> close(); ?>