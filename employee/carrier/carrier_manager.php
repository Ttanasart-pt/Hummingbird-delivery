<?php 
    require_once($_SERVER['DOCUMENT_ROOT'].'/Hummingbird_delivery/connect.php');

    if(isset($_GET['delivery_id'])) {
        $id = $_GET['delivery_id'];
        $q = "CALL CourierGetPackage($id, 2);";
        $res = $mysqli -> query($q);
        if(!$res) {
            echo $mysqli->error;
        }
    }

    if(isset($_GET['deliver_delivery_id'])) {
        $id = $_GET['deliver_delivery_id'];
        $q = "CALL DeliveryComplete($id);";
        $res = $mysqli -> query($q);
        if(!$res) {
            echo $mysqli->error;
        }
    }
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
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrier manager</title>
</head>

<body>
    <div id="header"></div>
    <script> $(function() { $('#header').load('/Hummingbird_delivery/header/header.php'); }) </script>

    <div class="content">
        <div class="content-center">
            <h1>Carrier</h1>

            <div class="shift-box">
                <a onclick="switchShift()" class="action align-left" style="padding: 0px 12px 0px 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32.501" height="26.407" viewBox="0 0 32.501 26.407">
                        <path id="Icon_metro-truck" data-name="Icon metro-truck" d="M35.071,20l-4.063-8.125H24.915V7.815a2.037,2.037,0,0,0-2.031-2.031H4.6A2.037,2.037,0,0,0,2.571,7.815v16.25L4.6,26.1H7.178a4.063,4.063,0,1,0,7.035,0H25.46a4.063,4.063,0,1,0,7.035,0h2.576V20ZM24.915,20V13.909h4.211L32.173,20H24.915Z" transform="translate(-2.571 -5.784)" fill="#fafafa"/>
                    </svg>                  
                    <p>Shift</p>
                </a>
                <sub>Current shift</sub>
                <p id='shift'>To warehouse</p>
            </div>
        </div>

        <br><br>
        <a onclick="QRReader_open()" class="action" style="justify-content: center;">
            <svg xmlns="http://www.w3.org/2000/svg" width="23.737" height="23.737" viewBox="0 0 23.737 23.737">
                <path id="Icon_awesome-qrcode" data-name="Icon awesome-qrcode" d="M0,12.423H10.173V2.25H0ZM3.391,5.641H6.782V9.032H3.391ZM13.564,2.25V12.423H23.737V2.25Zm6.782,6.782H16.955V5.641h3.391ZM0,25.987H10.173V15.814H0Zm3.391-6.782H6.782V22.6H3.391Zm18.651-3.391h1.7V22.6H18.651V20.9h-1.7v5.087H13.564V15.814h5.087v1.7h3.391Zm0,8.478h1.7v1.7h-1.7Zm-3.391,0h1.7v1.7h-1.7Z" transform="translate(23.737 25.987) rotate(180)" fill="#fafafa"/>
            </svg>                  
            <p id="qr-scan-txt">Receive package</p>
        </a>

        <br>
        <div id="qr-reader-parent" style="display: flex; justify-content:center;">
            <div class="qr-block">
                <h3>Delivery QR code</h3>
                <div id="qr-reader"></div>
            </div>
        </div>

        <div id="signature-block-parent" style="display: flex; justify-content:center;">
            <div class="sig-block">
                <canvas id="sig-canvas" width="620" height="160">This browser not support canvas</canvas>
                <button id="sig-submitBtn" onclick="onSign()">Submit Signature</button>
                <button id="sig-clearBtn">Clear Signature</button>
            </div>
        </div>
    </div>
</body>

<script>
    var showQR = false;
    $('#qr-reader-parent').hide();
    $('#signature-block-parent').hide();

    function QRReader_open() {
        showQR = !showQR;
        if(showQR)
            $('#qr-reader-parent').show();
        else
        $('#qr-reader-parent').hide();
    }

    var curr_delivery;
    function onScanSuccess(decodedText, decodedResult) {
        // console.log(`Code scanned = ${decodedText}`, decodedResult);
        switch(curr_shift) {
            case 0 : 
                window.location.href = `/Hummingbird_delivery/employee/carrier/carrier_manager.php?delivery_id=${decodedText}`;
                $('#qr-reader-parent').hide();
                break;
            case 1 :
                curr_delivery = decodedText;
                $('#qr-reader-parent').hide();
                $('#signature-block-parent').show();
                break;
            }
    }

    function onSign() {
        window.location.href = `/Hummingbird_delivery/employee/carrier/carrier_manager.php?deliver_delivery_id=${curr_delivery}`;
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);

    var curr_shift = 0;
    function switchShift() {
        curr_shift = (curr_shift + 1) % 2;
        
        switch(curr_shift) {
            case 0 : 
                    $('#shift').html("To warehouse"); 
                    $('#qr-scan-txt').html("Receive package"); 
                    break;
            case 1 : 
                    $('#shift').html("To destination"); 
                    $('#qr-scan-txt').html("Deliver package"); 
                    break;
        }
    }

    (function () {
        window.requestAnimFrame = (function (callback) {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60);
                };
        })();

        var canvas = document.getElementById("sig-canvas");
        var ctx = canvas.getContext("2d");
        // ctx.strokeStyle = "#222222";
        ctx.strokeStyle = getComputedStyle(document.documentElement).getPropertyValue('--text');
        ctx.lineWidth = 4;

        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;

        canvas.addEventListener("mousedown", function (e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);

        canvas.addEventListener("mouseup", function (e) {
            drawing = false;
        }, false);

        canvas.addEventListener("mousemove", function (e) {
            mousePos = getMousePos(canvas, e);
        }, false);

        // Add touch event support for mobile
        canvas.addEventListener("touchstart", function (e) {

        }, false);

        canvas.addEventListener("touchmove", function (e) {
            var touch = e.touches[0];
            var me = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);

        canvas.addEventListener("touchstart", function (e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var me = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(me);
        }, false);

        canvas.addEventListener("touchend", function (e) {
            var me = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(me);
        }, false);

        function getMousePos(canvasDom, mouseEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: mouseEvent.clientX - rect.left,
                y: mouseEvent.clientY - rect.top
            }
        }

        function getTouchPos(canvasDom, touchEvent) {
            var rect = canvasDom.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            }
        }

        function renderCanvas() {
            if (drawing) {
                ctx.moveTo(lastPos.x, lastPos.y);
                ctx.lineTo(mousePos.x, mousePos.y);
                ctx.stroke();
                lastPos = mousePos;
            }
        }

        // Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function (e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);

        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();

        function clearCanvas() {
            canvas.width = canvas.width;
        }

        var clearBtn = document.getElementById("sig-clearBtn");
        clearBtn.addEventListener("click", function (e) {
            clearCanvas();
        }, false);
    })();
</script>
</html>

<?php
    $mysqli -> close();
?>