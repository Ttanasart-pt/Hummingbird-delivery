<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php'); 
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

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package receive</title>
</head>

<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('/Hummingbird_delivery/header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>Package receive</h1>

            <a href="package_add.html" class="action">
                <svg class="no_lpad" xmlns="http://www.w3.org/2000/svg" width="36.843" height="36.843" viewBox="0 0 36.843 36.843">
                    <path id="Icon_ionic-ios-add-circle" data-name="Icon ionic-ios-add-circle" d="M21.8,3.375A18.422,18.422,0,1,0,40.218,21.8,18.419,18.419,0,0,0,21.8,3.375Zm8.015,19.839h-6.6v6.6a1.417,1.417,0,0,1-2.834,0v-6.6h-6.6a1.417,1.417,0,1,1,0-2.834h6.6v-6.6a1.417,1.417,0,1,1,2.834,0v6.6h6.6a1.417,1.417,0,0,1,0,2.834Z" transform="translate(-3.375 -3.375)" fill="#fafafa"/>
                </svg>      
                <p>New</p>
            </a>
        </div>

        <div class="search-box">
            <form action="delivery-search.php" class="search" id="search">
                <input type="text" name="search_qury" id="delivery-search">
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
        <div>
            <table class="table">
                <tr>
                    <th></th>
                    <th>Destination</th>
                    <th>Package type</th>
                    <th>Status</th>
                </tr>
            </table>
            <table class="table data">
                <tr class="data-row">
                    <td><svg xmlns="http://www.w3.org/2000/svg" width="28.779" height="20.145" viewBox="0 0 28.779 20.145">
                        <path id="Icon_awesome-box-open" data-name="Icon awesome-box-open" 
                            d="M19.14,12.321a2.18,2.18,0,0,1-1.862-1.052L14.388,6.476,11.5,11.269a2.187,2.187,0,0,1-1.866,1.057,2.068,2.068,0,0,1-.6-.085l-6.16-1.763v8a1.434,1.434,0,0,0,1.088,1.394l9.721,2.433a2.923,2.923,0,0,0,1.394,0l9.73-2.433A1.442,1.442,0,0,0,25.9,18.481v-8l-6.16,1.758A2.068,2.068,0,0,1,19.14,12.321ZM28.7,7.276,26.384,2.654a.734.734,0,0,0-.751-.4L14.388,3.688l4.123,6.839a.739.739,0,0,0,.832.328l8.9-2.541A.741.741,0,0,0,28.7,7.276ZM2.391,2.654.075,7.276A.733.733,0,0,0,.53,8.31l8.9,2.541a.739.739,0,0,0,.832-.328l4.128-6.835L3.137,2.254a.735.735,0,0,0-.746.4Z" transform="translate(0.003 -2.247)"/>
                      </svg>
                      </td>
                    <td>123</td>
                    <td>123</td>
                    <td>123</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>