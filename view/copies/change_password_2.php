<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../template/dateTime.php';
$emp_id=$emprow['emp_id'];
?>

<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
            
        function passwordValidation(){
            var newPass = document.getElementById('new_password').value.trim()
            var characterCheck = document.getElementById("character_check")
            var uppercaseCheck = document.getElementById("upper_check")
            var lowercaseCheck = document.getElementById("lower_check")
            var numberCheck = document.getElementById("number_check")
            var passwordCheck = document.getElementById('password_check')
            var repeatPass = document.getElementById('rnew_password').value.trim()
            var repeatPassCheck = document.getElementById('repeat_password_check')
            var a=0; var b=0; var c=0;
            
            if(newPass.match(/[a-z]/)){
                lowercaseCheck.style.display="inline-block";
                a=a+1;
            }else{
                lowercaseCheck.style.display="none";
            }
            
            if(newPass.length>=6){
                characterCheck.style.display="inline-block";
                a=a+1;
            }else{
                characterCheck.style.display="none";
            }
            
            if(newPass.match(/[A-Z]/)){
                uppercaseCheck.style.display="inline-block";
                a=a+1;
            }else{
                uppercaseCheck.style.display="none";
            }
            
            if(newPass.match(/[\d]/)){
                numberCheck.style.display="inline-block";
                a=a+1;
            }else{
                numberCheck.style.display="none";
            }
            if (a==4){
                passwordCheck.style.display="inline-block";
                b=b+1;
            }else{
                passwordCheck.style.display="none";
            }
            if (newPass != "" && repeatPass == newPass) {
                repeatPassCheck.style.display="inline-block";
                c=c+1;
            }else{
                repeatPassCheck.style.display="none";
            }
            if (b+c==2) {
                return true;
            }else{
                return false;
            }
        }
        </script>
      
    </head>
    <body id="body">
        <form id="change_password" method="GET" onsubmit="return passwordValidation()" action="/" >
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-11"><h4>Current Password</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <input class="form-control" name="curr_password" id="curr_password" placeholder="Enter Current Password" type="password"/>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>                    
                                <div class="row">
                                    <div class="col-md-11"><h4>New Password</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <input class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" type="password" onkeyup="return passwordValidation()"/>
                                    </div>
                                    <div class="col-md-1 text-shadow" style="padding: 0px; font-size: x-large;">
                                        <p id="password_check" style="display: none; color: greenyellow;" class="glyphicon glyphicon-ok"></p>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>                    
                                <div class="row">
                                    <div class="col-md-11"><h4>Repeat New Password</h4></div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-11" >
                                        <input class="form-control" name="rnew_password" id="rnew_password" placeholder="Repeat New Password" type="password" onkeyup="return passwordValidation()"/>
                                    </div>
                                    <div class="col-md-1 text-shadow" style="padding: 0px; font-size: x-large;">
                                        <p id="repeat_password_check" style="display: none; color: greenyellow;" class="glyphicon glyphicon-ok"></p>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Change" type="submit"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Reset" type="reset"/>
                                    </div>
                                </div>
                            </form>
                    <div class="row">
                        <div class="col-md-12 bborder">
                            <div><h4>Note for New Password:</h4></div>
                            <div>• Must contain minimum 6 Characters 
                               <p id="character_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain minimum 1 Uppercase
                                <p id="upper_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain minimum 1 Lowercase
                            <p id="lower_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain minimum 1 Number
                            <p id="number_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>                            
                        </div>
                    </div>
    </body>
</html>