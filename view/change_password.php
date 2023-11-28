<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../template/dateTime.php';
$emp_id=$emprow['emp_id'];
//header("Refresh:3,$lastpath");
//echo $lastpath;
//if(isset($_REQUEST[''])){
//    
//}else 
//if (isset($_REQUEST['msgs'])) {
//    header("Refresh:3,$lastpath");
//}


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
            var newPass = document.getElementById('new_password').value.trim();
            var characterCheck = document.getElementById("character_check");
            var uppercaseCheck = document.getElementById("upper_check");
            var lowercaseCheck = document.getElementById("lower_check");
            var numberCheck = document.getElementById("number_check");
            var passwordCheck = document.getElementById('password_check');
            var repeatPass = document.getElementById('rnew_password').value.trim();
            var repeatPassCheck = document.getElementById('repeat_password_check');
            var newPassError = document.getElementById('newPassError');
            var repeatPassError = document.getElementById('repeatPassError');
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
                newPassError.style.display="none";
                b=b+1;
            }else if (newPass != "" && a != 4) {
                newPassError.style.display="inline-block";
                passwordCheck.style.display="none";
            }else{
                newPassError.style.display="none";
                passwordCheck.style.display="none";
            }
            if (newPass != "" && repeatPass == newPass) {
                repeatPassCheck.style.display="inline-block";
                repeatPassError.style.display="none";
                c=c+1;
            }else if (repeatPass != "" && repeatPass != newPass ) {
                repeatPassError.style.display="inline-block";
                repeatPassCheck.style.display="none";
            }else{
                repeatPassCheck.style.display="none";
                repeatPassError.style.display="none";
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
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div id="content" class="container col-md-9">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Change Password</h2></div>
                    </div>
                        <?php 
                        include '../template/messagebox.php';
                        ?>
                    <div class="row">
                        <div class="col-md-4 clearfix">&nbsp;</div>
                        <div class="col-md-4">
                            <form name="change_password" method="post" onsubmit="return passwordValidation();" action="../controller/controller_employee.php?action=updatePassword&emp_id=<?php echo $emp_id; ?>" >
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-11"><h4>Current Password</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <input class="form-control" name="curr_password" id="curr_password" placeholder="Enter Current Password" required type="password"/>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>                    
                                <div class="row">
                                    <div class="col-md-11"><h4>New Password</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-11">
                                        <input class="form-control" name="new_password" id="new_password" placeholder="Enter New Password" type="text" required onkeyup="passwordValidation()"/>
                                    </div>
                                    <div class="col-md-1 text-shadow" style="padding: 0px; font-size: x-large;">
                                        <p id="password_check" style="display: none; color: greenyellow;" class="glyphicon glyphicon-ok"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="newPassError" class="col-md-12" style="color: red; display: none"><p>* New password not met criteria</p></div>
                                </div>
                                <div class="clearfix">&nbsp;</div>                    
                                <div class="row">
                                    <div class="col-md-11"><h4>Repeat New Password</h4></div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-11" >
                                        <input class="form-control" name="rnew_password" id="rnew_password" placeholder="Repeat New Password" type="password" required onkeyup="passwordValidation()"/>
                                    </div>
                                    <div class="col-md-1 text-shadow" style="padding: 0px; font-size: x-large;">
                                        <p id="repeat_password_check" style="display: none; color: greenyellow;" class="glyphicon glyphicon-ok"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div id="repeatPassError" class="col-md-12" style="color: red; display: none"><p>* Repeated password dose not match</p></div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Change" type="submit"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block btn_reset" value="Reset" type="button"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 clearfix">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4 bborder" 
                             style="font-size: 15px; padding-bottom: 10px; border-radius: 5px; background-color: rgba(160,0,0); color: white; box-shadow: -8px 8px 10px 1px rgba(0,0,0,.5);">
                            <div><p><b>Note for New Password:</b></p></div>
                            <div>• Must contain minimum 6 Characters 
                               <p id="character_check" class="glyphicon glyphicon-ok" style="display: none; color: #00ff00"></p></div>
                            <div>• Must contain minimum 1 Uppercase
                                <p id="upper_check" class="glyphicon glyphicon-ok" style="display: none; color: #00ff00"></p></div>
                            <div>• Must contain minimum 1 Lowercase
                            <p id="lower_check" class="glyphicon glyphicon-ok" style="display: none; color: #00ff00"></p></div>
                            <div>• Must contain minimum 1 Number
                            <p id="number_check" class="glyphicon glyphicon-ok" style="display: none; color: #00ff00"></p></div>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
    $(document).on('click','.btn_reset',function(){
            window.location.reload();
    });
</script>