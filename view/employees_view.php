<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

$obemp=new model_employee();

$viewEmpId=$_REQUEST['viewEmpId'];
$result1=$obemp->viewNewEmpDetails($viewEmpId);
$viewEmpRow=$result1->fetch(PDO::FETCH_BOTH);
$result2=$obemp->viewNewEmpContactDetails($viewEmpId);
$viewEmpRow2=$result2->fetch(PDO::FETCH_BOTH);
$result3=$obemp->viewNewEmpJobDetails($viewEmpId);
$viewEmpRow3=$result3->fetch(PDO::FETCH_BOTH);
$result4=$obemp->viewNewEmpAddress($viewEmpId);
$viewEmpRow4=$result4->fetch(PDO::FETCH_BOTH);
//var_dump($viewEmpRow3);
?>

<html>
    <head>
        <?php include '../template/htmlHead.php'; ?>
    </head>
    <body  id="body">
        <div class="container-fluid" id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>View Employee Details</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-12">
                            <table class="table table-bordered table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th></th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp" id="add_emp" method="post" action="../controller/controller_employee.php?action=addEmployee">
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Personal Details</h4></div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">First Name</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="fname" id="fname" value="<?php echo $viewEmpRow['emp_fname']; ?>">
                                                        <a class="error">*</a><span id="fnameerr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2" style="padding: 0px; margin: 0px" r>Sur / Last Name</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="lname" id="lname" value="<?php echo $viewEmpRow['emp_lname']; ?>">
                                                        <a class="error">*</a><span id="lnameerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Other Names</div>
                                                    <div class="col-md-6">
                                                        <input readonly="readonly" class="form-control" type="text" name="onames" id="onames" value="<?php echo $viewEmpRow['emp_oname']; ?>">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-3">Address</div>
                                                    <div class="col-md-6">
                                                        <textarea readonly="readonly" class="form-control" id="address" rows="3"><?php echo $viewEmpRow4['emp_address1']."\n".$viewEmpRow4['emp_address2']."\n".$viewEmpRow4['emp_address3']; ?></textarea>
                                                        
                                                        <a class="error">*</a><span id="addresserr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">City</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" id="form-city" value="<?php echo $viewEmpRow4['cityName']; ?>">
                                                    </div>
                                                    <div class="col-md-2" >Postal Code</div>
                                                    <div class="col-md-3" id="postal"><input class="form-control" type="text" name="form-postalCode" id="form-postalCode" readonly="readonly" value="<?php echo $viewEmpRow4['postalCode']; ?>"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">District</div>
                                                    <div class="col-md-3">
                                                        <input class="form-control" type="text" name="form-district" id="form-district" readonly="readonly" value="<?php echo $viewEmpRow4['districtName']; ?>">
                                                    </div>
                                                    <div class="col-md-2">Province</div>
                                                    <div class="col-md-3">
                                                        <input class="form-control" type="text" name="form-province" id="form-province" readonly="readonly" value="<?php echo $viewEmpRow4['provinceName']; ?>">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-3" style="margin: 0px">National Identity Card No.</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="nic" id="nic" value="<?php echo $viewEmpRow['emp_nic']; ?>">
                                                        <a class="error">*</a><span id="nicerr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2">Date of Birth</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="dob" id="dob" value="<?php echo $viewEmpRow['emp_dob']; ?>">
                                                        <a class="error">*</a><span id="doberr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Marital Status</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="maritalStatus" id="maritalStatus" value="<?php echo $viewEmpRow['emp_marital_status']; ?>">
                                                    </div>
                                                    <div class="col-md-2">Gender</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" id="gender" name="gender" value="<?php echo $viewEmpRow['emp_gender']; ?>"/>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-3">Mobile No.</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="tel" name="mobno" id="mobno" value="<?php echo $viewEmpRow2['emp_mobno']; ?>">
                                                        <a class="error">*</a><span id="mobnoerr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2">Telephone No.</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="tel" name="telno" id="telno" value="<?php echo $viewEmpRow2['emp_home_telno']; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Email Address</div>
                                                    <div class="col-md-6">
                                                        <input readonly="readonly" class="form-control" type="text" name="email" id="email" value="<?php echo $viewEmpRow2['emp_email']; ?>">
                                                        <a class="error">*</a><span id="emailerr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>In Case of Emergency</h4></div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Contact Person</div>
                                                    <div class="col-md-6">
                                                        <input readonly="readonly" class="form-control" type="text" name="emeContName" id="emeContName" value="<?php echo $viewEmpRow2['emp_emergency_cont_name']; ?>">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Contact Number</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="tel" name="emeContNo" id="emeContNo" value="<?php echo $viewEmpRow2['emp_emergency_cont_no']; ?>">
                                                    </div>
                                                     <div class="col-md-2">Relationship</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="emeContRelation" id="emeContRelation" value="<?php echo $viewEmpRow2['emp_emergency_cont_relation']; ?>">
                                                    </div> 
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Job Details</h4></div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Date Joined</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="dateJoined" id="dateJoined" value="<?php echo $viewEmpRow3['date_joined']; ?>">
                                                        <a class="error ">*</a><span id="joindateerr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2">Job Designation</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="jobDesignation" id="jobDesignation" value="<?php echo $viewEmpRow3['designation_name']; ?>">
                                                        <a class="error">*</a><span id="designationerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Employee Type</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="employeeType" id="employeeType" value="<?php echo $viewEmpRow3['emp_type']; ?>">
                                                        <a class="error">*</a><span id="employeetypeerr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2">Department</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="department" id="department" value="<?php echo $viewEmpRow3['dept_name']; ?>">
                                                        <a class="error">*</a><span id="depterr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">Reporting Manager</div>
                                                    <div class="col-md-3">
                                                        <input readonly="readonly" class="form-control" type="text" name="repotingManager" id="repotingManager" value="<?php echo $viewEmpRow3['emp_fname'].' '.$viewEmpRow3['emp_lname']; ?>">
                                                        <a class="error">*</a><span id="managererr" class="error" ></span>
                                                    </div>
                                                    <div class="col-md-2">Office Email</div>
                                                    <div class="col-md-3" style="padding-right: 0px">
                                                        <input readonly="readonly" type="text" class="form-control" id="officialEmail" name="officialEmail" value="<?php echo $viewEmpRow3['office_email']; ?>"/>
                                                        <a class="error">*</a><span id="managererr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-7">
                                                        <a href="../view/employees.php"><input type="button" name="back"  id="back" value="Go Back" class="btn btn-danger"/></a>
                                                        <input type="button" name="update" value="Update Data" class="btn btn-warning"/>
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
                        <div class="col-md-1">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
$(document).ready(function(){
    $('#'fname).mouseover(function(){
       $.ajax({
        url: "../controller/controller_employee.php?action=viewEmpDetails",
        function (data) {
    alert(data);
} 
    });
    
    });
});
    
    
    
</script>