<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
include '../model/model_department.php';
$obemp=new model_employee();
$result=$obemp->viewNewEmpDetails($newEmpId);
$newEmpInfo=$result->fetch(PDO::FETCH_BOTH);

$obdept=new model_department;
$resultDept=$obdept->viewDepartment();



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
                    
                    pat_tel=/^\+94[0-9]{9}$/;
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
                                        <th>b. Employee Job Details</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp_job_details" id="add_emp_job_details" method="post" action="../controller/controller_employee.php?action=addEmpDetailsJob">
                                                <div class="row">
                                                    <div class="col-md-5"><h4>New Employee Name</h4></div>
                                                    <div class="col-md-7"><h4><?php echo $newEmpInfo['emp_fname']." ".$newEmpInfo['emp_lname']; ?></h4></div>
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Date Joined</h4></div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" type="date" name="dateJoined" id="dateJoined">
                                                        <a class="error">*</a><span id="joindateerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Job Designation</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="jobDesignation" id="jobDesignation" placeholder="Enter Designation" onkeyup="clearMsg('mobnoerr')">
                                                        <a class="error">*</a><span id="designationerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Employee Type</h4></div>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="employeeType" id="employeeType">
                                                            <option value="">Select Employee Type</option>
                                                            <option value="Full Time">Full Time</option>
                                                            <option value="Part Time">Part Time</option>
                                                            <option value="Contracted">Contracted</option>
                                                        </select>
                                                        <a class="error">*</a><span id="employeetypeerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Department</h4></div>
                                                    <div class="col-md-4">
                                                        <select name="department" id="department" class="form form-control">
                                                            <option value="">Select Department</option>
                                                            <?php while ($dept=$resultDept->fetch(PDO::FETCH_BOTH)){ ?>
                                                            <option value="<?php echo $dept['dept_id']; ?>"><?php echo $dept['dept_name']; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                        <a class="error">*</a><span id="depterr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Reporting Manager</h4></div>
                                                    <div class="col-md-4">
                                                        <select name="repotingManager" id="repotingManager" class="form form-control">
                                                            <option value="">Select Manager</option>
                                                        </select>
                                                        <a class="error">*</a><span id="managererr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Office Email Address</h4></div>
                                                    <div class="col-md-4" style="padding-right: 0px">
                                                        <input type="text" class="form-control" id="officialEmail" name="officialEmail"/>
                                                        <a class="error">*</a><span id="managererr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0px"><h4>@cmsl.lk</h4></div><br>
                                                    
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
                    <div class="col-md-2" id="testing">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
$(document).ready(function(){
    $('#department').change(function(){
        var deptId = $(this).val();
        
        $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{deptId:deptId},
            success:function(data){
//                var cityResult = jQuery.parseJSON(data);
                $('#repotingManager').html(data);
//                $('#testing').html(data);
//                $('#form-district').val(cityResult["districtName"]);
//                $('#form-province').val(cityResult["provinceName"]);
            }
        });
    });
});


</script>