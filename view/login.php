<?php 
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

$obemp=new model_employee();


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
            <?php include '../template/header2.php';?>
            <div style="font-size: x-large; text-align: right"><a href="attendance_add.php"> Attendance <div class="glyphicon glyphicon-check"></div></a></div>
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-12 textalc text-uppercase"><h2>Login</h2></div>
                </div>
                <?php include '../template/messagebox.php'; ?>
                <div class="row">
                    <div class="col-md-4 clearfix">&nbsp;</div>
                    <div class="col-md-4">
                <form name="form_login" method="post" action="../controller/controller_employee.php?action=checkLogin" onsubmit="return checkLogin();">
                    <div class="clearfix">&nbsp;</div>                    
                    <div class="row">
                        <div class="col-md-12"><h4>Enter Staff ID No.</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="emp_id" id="emp_id" type="text"/>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>                    
                    <div class="row">
                        <div class="col-md-12"><h4>Enter Password</h4></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input class="form-control" name="login_pwd" id="login_pwd" type="password"/>
                        </div>
                    </div>
                    <div class="clearfix">&nbsp;</div>
                    <div class="row">
                        <div class="col-md-6">
                            <input class="btn btn-primary btn-block" value="Login" type="submit"/>
                        </div>
                        <div class="col-md-6">
                            <input class="btn btn-primary btn-block" value="Reset" type="reset"/>
                        </div>
                    </div>
                </form>
                    </div>
                    <div class="col-md-4 clearfix">&nbsp;</div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
    <script type="text/javascript">
            function checkLogin(){
                var e=document.getElementById('emp_id').value;
                var p=document.login.login_pwd.value;
                if(e=="" && p==""){
                    document.getElementById('error').innerHTML="Empty email address and empty password";
                    document.getElementById('emp_id').focus();
                    return false;
                }else if(e!="" && p==""){
                    document.getElementById('error').innerHTML="Empty password";
                    document.getElementById('login_pwd').focus();
                    return false;
                }else if(e=="" && p!=""){
                    document.getElementById('error').innerHTML="Empty email address";
                    document.getElementById('emp_id').focus();
                    return false;
                }
            }
    </script>
</html>
