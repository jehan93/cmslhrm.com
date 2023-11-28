<?php
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
include '../model/model_department.php';
$obemp=new model_employee();
////$result=$obemp->viewNewEmpDetails($newEmpId);
//$newEmpInfo=$result->fetch(PDO::FETCH_BOTH);

$obdept=new model_department;
$resultDept=$obdept->viewDepartment();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>CMSL HRM</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
              rel="stylesheet" 
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" 
              crossorigin="anonymous">
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>   
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous"></script>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

    </head>
    <body class="bg-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 bg-light p-4 rounded mt-5">
                    <div class="progress mb-2" style="height: 40px">
                        <div class="progress-bar bg-danger rounded" role="progressbar" style="width: 25%" id="progressbar">
                            <b class="lead" id="progressbarText">Step-1</b> 
                        </div>
                    </div>
                    <form action="" method="post" id="form-data">
                        <div id="first">
                            <h4 class="text-center bg-primary p-1 rounded text-light">Basic Information</h4>
                            <div class="form-group">
                                <label for="firstName">First Name<b class="error"> *</b></label>
                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <label for="otherName">Other Name</label>
                                <input type="text" id="otherName" name="otherName" class="form-control" placeholder="Other Name">
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last / Surname<b class="error"> *</b></label>
                                <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last / Surname" required>
                            </div>
                            <div class="form-group">
                                <label for="nic">National Identity Card No.<b class="error"> *</b></label>
                                <input type="text" id="nic" name="nic" class="form-control" placeholder="National Identity Card No." required>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-warning" id="next-1">Next</a>
                            </div>
                        </div>
                        <div id="second">
                            <h4 class="text-center bg-primary p-1 rounded text-light">Job Details</h4>
                            <div class="form-group">
                                <label for="dateJoined">Date Joined<b class="error"> *</b></label>
                                <input type="date" id="dateJoined" name="dateJoined" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jobDesignation">Job Designation<b class="error"> *</b></label>
                                <input type="text" id="jobDesignation" name="jobDesignation" class="form-control" placeholder="Job Designation" required>
                            </div>
                            <div class="form-group">
                                <label for="employeeType">Employee Type<b class="error"> *</b></label>
                                <select class="form-control" name="employeeType" id="employeeType" required>
                                    <option value="">Select Employee Type</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Contracted">Contracted</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department<b class="error"> *</b></label>
                                <select class="form-control" name="department" id="department" required>
                                    <option value="">Select Department</option>
                                    <?php while ($dept=$resultDept->fetch(PDO::FETCH_BOTH)){ ?>
                                    <option value="<?php echo $dept['dept_id']; ?>"><?php echo $dept['dept_name']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reportingManager">Reporting Manager</label>
                                <select class="form-control" name="reportingManager" id="reportingManager">
                                    <option value="">Select Reporting Manager</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <label for="officeEmail">Office Email Address<b class="error"> *</b></label>
                                <div class="form-inline">
                                    <input type="text" id="officeEmail" name="officeEmail" class="form-control" style="width: 80% ">
                                <h5> @cmsl.lk</h5>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-warning" id="prev-1">Previous</a>
                                <a href="#" class="btn btn-warning" id="next-2">Next</a>
                            </div>
                        </div>
                        <div id="third">
                            <h4 class="text-center bg-primary p-1 rounded text-light">Personal Details</h4>
                            <div class="form-group">
                                <label for="address">Address<b class="error"> *</b></label>
                                <input type="text" id="address1" name="address1" class="form-control mb-1" placeholder="Address Line 1">
                                <input type="text" id="address2" name="address2" class="form-control mb-1" placeholder="Address Line 2">
                                <input type="text" id="address3" name="address3" class="form-control" placeholder="Address Line 3">
                            </div>
                            <div class="row form-inline">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City<b class="error"> *</b></label>
                                        <select class="form-control chosen" name="city" id="city">
                                            <option></option>
                                            <?php $result=$obemp->viewCity();
                                            while ($city=$result->fetch(PDO::FETCH_BOTH)) { ?>
                                            <option value="<?php echo $city['cityId']; ?>"><?php echo $city['cityName']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postalCode">Postal Code</label>
                                        <input class="form-control" type="text" name="postalCode" value="" id="postalCode" readonly="readonly" placeholder="Postal Code">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="district">District</label>
                                <input type="text" id="district" name="district" class="form-control" placeholder="District" readonly>
                            </div>
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" id="province" name="province" class="form-control" placeholder="Province" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label><br/>
                                <div class="col-md-6" style="display: inline-block"><input type="radio" id="radio_gender" name="radio_gender" value="Male"/>Male
                                <input type="radio" id="radio_gender" name="radio_gender" value="Female"/>Female</div>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth<b class="error"> *</b></label>
                                <input type="date" id="dob" name="dob" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="maritalStatus">Marital Status</label>
                                 <select class="form-control" name="maritalStatus" id="maritalStatus">
                                     <option value="">Select Status</option>
                                     <option value="Single">Single</option>
                                     <option value="Married">Married</option>
                                     <option value="Widowed">Widowed</option>
                                     <option value="Divorced">Divorced</option>
                                 </select>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-warning" id="prev-2">Previous</a>
                                <a href="#" class="btn btn-warning" id="next-3">Next</a>
                            </div>
                        </div>
                        <div id="forth">
                            <h4 class="text-center bg-primary p-1 rounded text-light">Contact Details</h4>
                            <div class="form-group">
                                <label for="mobileNo">Mobile Number<b class="error"> *</b></label>
                                    <input class="form-control" type="tel" name="mobileNo" id="mobileNo" placeholder="Mobile No.07XXXXXXXX">
                            </div>
                            <div class="form-group">
                                <label for="telephoneNo">Telephone Number</label>
                                <input class="form-control" type="tel" name="telephoneNo" id="telephoneNo" placeholder="Telephone No.011XXXXXXX">
                            </div>
                            <div class="form-group">
                                <label for="emailAddress">Email Address<b class="error"> *</b></label>
                                <input class="form-control" type="email" name="emailAddress" id="emailAddress" placeholder="Email Address"> 
                            </div>
                            <br/>
                            <h3>In Case of Emergency</h3>
                            <div class="form-group">
                                <label for="emeContName">Contact Person</label>
                                <input class="form-control" type="text" name="emeContName" id="emeContName" placeholder="Name of Emergency Contact Person">
                            </div>
                            <div class="form-group">
                                <label for="emeContNo">Contact Number</label>
                                <input class="form-control" type="tel" name="emeContNo" id="emeContNo" placeholder="Number of Emergency Contact Person"> 
                            </div>
                            <div class="form-group">
                                <label for="emeContRelation">Relationship</label>
                                <input class="form-control" type="text" name="emeContRelation" id="emeContRelation" placeholder="Relationship">
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-warning" id="prev-3">Previous</a>
                                <a href="#" class="btn btn-success" id="save">Save</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
$(".chosen").chosen();
     
$(document).ready(function(){
//    $("#second").hide();
//    $("#third").hide();
//    $("#forth").hide();
    
    $("#next-1").click(function(){
        if ($("#firstName").val()=="") {
            alert("First name cannot be empty.");
            $("#firstName").focus();
            return false;
        }
        if ($("#lastName").val()=="") {
            alert("Last name cannot be empty.");
            $("#lastName").focus();
            return false;
        }
        var nic = $("#nic");
        if (nic.val()=="") {
            alert("National ID No. cannot be empty.");
            nic.focus();
            return false;
        }
        pat_nic=/^[0-9]{9}[vVxX]{1}$/;
        pat_nic_new=/^[0-9]{12}$/;
        
        if(nic.val() !="" && !nic.val().match(pat_nic)){
                if(nic.val() !="" && !nic.val().match(pat_nic_new)){
                alert("NIC format incorrect");
                nic.focus();
                return false;
            }
        }
        
        $("#second").show();
        $("#first").hide();
        $("#progressbar").css("width","50%");
        $("#progressbarText").html("Step - 2");
    });

    $("#next-2").click(function(){
        if ($("#dateJoined").val()=="") {
            alert("Please enter joined date");
            $("#dateJoined").focus();
            return false;
        }
        if ($("#jobDesignation").val()=="") {
            alert("Please enter job designation");
            $("#jobDesignation").focus();
            return false;
        }
        if ($("#employeeType").val()=="") {
            alert("Please select employee type");
            $("#employeeType").focus();
            return false;
        }
        if ($("#department").val()=="") {
            alert("Please select department");
            $("#department").focus();
            return false;
        }
        if ($("#officeEmail").val()=="") {
            alert("Please enter office email");
            $("#officeEmail").focus();
            return false;
        }
        $("#third").show();
        $("#second").hide();
        $("#progressbar").css("width","75%");
        $("#progressbarText").html("Step - 3");
    });

    $("#next-3").click(function(){
        if ($("#address1").val()=="" && $("#address2").val()=="" && $("#address3").val()=="") {
            alert("Please enter address");
            $("#address1").focus();
            return false;
        }
        if ($("#city").val()=="") {
            alert("Please select city");
            $("#city").focus();
            return false;
        }
        if ($("#dob").val()=="") {
            alert("Please enter date of birth");
            $("#dob").focus();
            return false;
        }
        $("#forth").show();
        $("#third").hide();
        $("#progressbar").css("width","100%");
        $("#progressbarText").html("Step - 4");
    });
    
    $("#save").click(function(){
        pat_mobile=/^[0-9]{10}$/;
        
        var mobileNo = $("#mobileNo");
        if (mobileNo.val()=="") {
            alert("Please enter mobile number");
            mobileNo.focus();
            return false;
        }
        if (mobileNo.val()!="" && !mobileNo.val().match(pat_mobile)) {
            alert("Incorrect mobile number format");
            mobileNo.focus();
            return false;
        }
        if ($("#emailAddress").val()=="") {
            alert("Please enter email address");
            $("#emailAddress").focus();
            return false;
        }
        if (confirm("You are about to add a new employee.")==false) {
            return false;
        }
        if (confirm("Adding new employee.")==false) {
            return false;
        }
        
    });

    $("#prev-1").click(function(){
        $("#first").show();
        $("#second").hide();
        $("#progressbar").css("width","25%");
        $("#progressbarText").html("Step - 1");
    });

    $("#prev-2").click(function(){
        $("#second").show();
        $("#third").hide();
        $("#progressbar").css("width","50%");
        $("#progressbarText").html("Step - 2");
    });

    $("#prev-3").click(function(){
        $("#third").show();
        $("#forth").hide();
        $("#progressbar").css("width","75%");
        $("#progressbarText").html("Step - 3");
    });
    
    $('#department').change(function(){
        var deptId = $(this).val();
        $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{deptId:deptId},
            success:function(data){
                $('#reportingManager').html(data);
            }
        });
    });
    
    $('#city').change(function(){
        var cityId = $(this).val();
    
        $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{cityId:cityId},
            success:function(data){
                var cityResult = jQuery.parseJSON(data);
                $('#postalCode').val(cityResult["postalCode"]);
                $('#district').val(cityResult["districtName"]);
                $('#province').val(cityResult["provinceName"]);
            }
        });
    });
    
});


</script>
