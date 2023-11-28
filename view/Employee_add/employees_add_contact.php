<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
$obemp=new model_employee();
$empId_login=$emprow['emp_id'];
$currentYear = date("Y");
//echo $newEmpId;
$result=$obemp->viewNewEmpDetails($newEmpId);
$newEmpInfo=$result->fetch(PDO::FETCH_BOTH);
//var_dump($newEmpInfo);
//echo $newEmpId;
?>

<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('form').submit(function(){
                    var mobno=$('#mobno').val();
                    var email=$('#email').val();
                    
                    pat_tel=/[0-9]{10}$/;
                    pat_email=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                    
                    if(mobno ==""){
                         $('#mobnoerr').text("Mobile No. cannot be Blank");
                         $('#mobno').focus();
                         return false;
                     }
                    if(mobno !="" && !mobno.match(pat_tel)){
                         $('#mobnoerr').text("Invalid Mobile Number");
                         $('#mobno').focus();
                         return false;
                     }
                     if(email ==""){
                         $('#emailerr').text("Email cannot be Blank");
                         $('#email').focus();
                         return false;
                     }
                     if(email !="" && !email.match(pat_email)){
                         $('#emailerr').text("Invalid email address");
                         $('#email').focus();
                         return false;
                     }
                });
            });
            function clearMsg(errp){
                document.getElementById(errp).innerHTML="";
            }
        </script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>Add Employee Details</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <?php include '../template/messagebox.php'; ?>
                            <table class="table table-bordered table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th>d. Employee Contact Details</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp_contact_details" id="add_emp_contact_details" method="post" action="../controller/controller_employee.php?action=addEmpContactDetails">
                                                <div class="row">
                                                    <div class="col-md-5"><h4>New Employee Name</h4></div>
                                                    <div class="col-md-7"><h4><?php echo $newEmpInfo['emp_fname']." ".$newEmpInfo['emp_lname']; ?></h4></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Mobile Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="mobno" id="mobno" placeholder="Mobile No.07XXXXXXXX" onkeyup="clearMsg('mobnoerr')">
                                                        <a class="error">*</a><span id="mobnoerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Telephone Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="telno" id="telno" placeholder="Telephone No.011XXXXXXX">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Email Address</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="email" id="email" placeholder="Email Address" onkeyup="clearMsg('emailerr')">
                                                        <a class="error">*</a><span id="emailerr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h3>In Case of Emergency</h3></div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Contact Person</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="emeContName" id="emeContName" placeholder="Name of Emergency Contact Person">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Contact Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="emeContNo" id="emeContNo" placeholder="Number of Emergency Contact Person">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Relationship</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="emeContRelation" id="emeContRelation" placeholder="Relationship">
                                                    </div> 
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4></h4></div>
                                                    <div class="col-md-7">
                                                        <input type="submit" name="sub" value="Next" class="btn btn-success"/>
                                                        <input type="reset" name="reset" value="Clear" class="btn btn-warning"/>
                                                    </div> 
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr style="border-top: black solid">
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>