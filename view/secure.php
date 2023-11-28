<?php 
date_default_timezone_set('Asia/Colombo');
include '../config/dbconnection.php';
include '../model/model_attendance.php';
include '../template/dateTime.php';

$obEmpTime=new model_attendance();

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
        <?php
        $user=$_POST['user'];
        $pass=$_POST['pass'];
        if ($user=='admin' && $pass=='admin') {
            include('attendance_add1.php');
        }
        else{
            if(isset($_POST)){
                
            }?>
        <div id="main">
            <?php include '../template/header2.php';?>
            <div style="font-size: x-large; text-align: right; padding-right: 10"><a href="login.php"> Login <div class="glyphicon glyphicon-log-in"></div></a></div>
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-12 textalc text-uppercase "><h2>Staff Attendance</h2></div>
                </div>
                <form name="gotoatt" method="post" action="secure.php" onsubmit="return isEmpty();">
                    <div class="clearfix">&nbsp;</div>                    
                    <div class="row">
                    <div class="col-md-4 text-right"><h4>Username</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="user" id="user" type="text"/>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-4 text-right"><h4>Password</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="pass" id="pass" type="password"/>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                    <div class="col-md-4">
                        <input class="form-control btn-primary" value="Go to Attendance" name="submit" id="submit" type="submit"/>
                    </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                </form>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
    <?php
        }
        ?>
    <script type="text/javascript">
            function isEmpty(){
                if (document.forms['att_add'].emp_id.value=="") {
    alert("Please Enter your Staff ID No.");
    return false;
}
return true;
                }
            
    </script>
</html>
