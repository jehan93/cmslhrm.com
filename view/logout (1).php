<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../template/dateTime.php';
include '../model/model_log.php';

$oblog=new model_log();

$log_id=$emprow[(count($emprow)-1)/2];
$oblog->updateLog($log_id);
        
//Destroying the Current Session.
unset($_SESSION['emprow']);
//Redirecting the page to login
$t=5;
header("refresh:$t,../view/login.php");

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
                    <div class="col-md-12 textalc text-uppercase"><h2>Logout</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-2 clearfix">&nbsp;</div>
                    <div class="col-md-8 textalc">
                        <b style="font-size: 16.5px">You have successfully logged out from CMSL HR Management.</b><br/>
                        <i>You will automatically be redirected to the Login page in 5 seconds.</i><br/>
                        <a href="../view/login.php">If not click here.</a>
                    
                    </div>
                    <div class="col-md-2 clearfix">&nbsp;</div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
