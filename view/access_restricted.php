<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';

?>

<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <div class="row" id="header">
                <div class="col-md-9">
                    <div id="title1">CORPORATE MANAGERS & SECRETARIES (PVT) LTD</div>
                    <div id="title2">HR Management</div>
                </div>
            </div>
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-12 textalc text-uppercase"><h2>ACCESS RESTRICTED!</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-2 clearfix">&nbsp;</div>
                    <div class="col-md-8 textalc">
                        <b style="font-size: 16.5px">You don not have the required clearance to access this page.</i><br/>
                        <a href="../view/dashboard.php">Click here to return to Home page.</a>
                    
                    </div>
                    <div class="col-md-2 clearfix">&nbsp;</div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
