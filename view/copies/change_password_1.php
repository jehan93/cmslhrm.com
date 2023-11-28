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
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9 container" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Change Password</h2></div>
                    </div>
                    <?php include '../template/messagebox.php'; ?>
                    <div class="row">
                        <div class="col-md-4 clearfix">&nbsp;</div>
                        <div class="col-md-4">
                            <form name="change_password" method="post" onsubmit="return checkPasswordValidation();" action="../controller/controller_employee.php?action=updatePassword&emp_id=<?php echo $emp_id; ?>" >
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
                                        <input class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" type="password" onkeyup="checkPasswordValidation();"/>
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
                                        <input class="form-control" name="rnew_password" id="rnew_password" placeholder="Repeat New Password" type="password" onkeyup="checkPasswordValidation();"/>
                                    </div>
                                    <div class="col-md-1 text-shadow" style="padding: 0px; font-size: x-large;">
                                        <p id="repeat_password_check" style="display: none; color: greenyellow;" class="glyphicon glyphicon-ok"></p>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Change" type="submit" onclick="checkPasswordValidation();" />
                                    </div>
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Reset" type="reset"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 clearfix">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-7 bborder">
                            <div><h4>Note for New Password:</h4></div>
                            <div>• Must contain atleast 6 Characters 
                               <p id="character_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain atleast 1 Uppercase
                                <p id="upper_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain atleast 1 Lowercase
                            <p id="lower_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>
                            <div>• Must contain atleast 1 Number
                            <p id="number_check" class="glyphicon glyphicon-ok" style="display: none"></p></div>                            
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
<!--        <script>
            function checkPasswordValidation (){ 
                var newPassword = document.getElementById("new_password").value;
                var passwordCheck = document.getElementById("password_check");
                var characterCheck = document.getElementById("character_check");
                var upperCheck = document.getElementById("upper_check");
                var lowerCheck = document.getElementById("lower_check");
                var numberCheck = document.getElementById("number_check");
                var a=0; var b=0; var c=0; var d=0; 
                
                var repeatPassword = document.getElementById("rnew_password").value;
                var rpassCheck = document.getElementById("repeat_password_check");
                
                
                if(newpassword!=""){
                    if (newPassword.length >= 6){
                        characterCheck.style.display = "inline-block";
                        a=1;
                    }else {
                        characterCheck.style.display = "none";
                    }
                    if (newPassword.match(/[A-Z]/)){
                        upperCheck.style.display = "inline-block";
                        b=1;
                    }else {
                        upperCheck.style.display = "none";
                    }
                    if (newPassword.match(/[a-z]/)){
                        lowerCheck.style.display = "inline-block";
                        c=1;
                    }else {
                        lowerCheck.style.display = "none";
                    }
                    if (newPassword.match(/[0-9]/)){
                        numberCheck.style.display = "inline-block";
                        d=1;
                    }else {
                        numberCheck.style.display = "none";
                    }
                    if ((a+b+c+d) == 4){
                        passwordCheck.style.display = "inline-block";
                        var x=1;
                    }else {
                        passwordCheck.style.display = "none";
                    }
                    }else {
                        return false;
                    }
  
                if (repeatPassword == ""){
                    rpassCheck.style.display = "none";
                    return false;
                }else 
                    if (newPassword == repeatPassword){
                        rpassCheck.style.display = "inline-block";
                        var y=1;
                    } else {
                    rpassCheck.style.display = "none";
                }
                
                if ((x+y) != 2){
                    return false;
                }else
                     alert (x+y);
            }
        </script>-->
    </body>
</html>