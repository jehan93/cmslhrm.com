<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
include '../model/model_department.php';
include '../restrictedAccess/all_restricted.php';

$obemp=new model_employee();

$obdept=new model_department;
$resultDept=$obdept->viewDepartment();

$empId_login=$emprow['emp_id'];
$currentYear = date("Y");

?>

<html>
    <head>
        <?php include '../template/htmlHead.php'; ?>
        <style type="text/css">
            label{color: white;}
/*            #second,#third,#forth{display: none; }
            #div_spouse_name,#div_marriage_date{display: none; }*/
            .required-mark{color:red;font-size: 20px;}
        </style>
    </head>
    <body id="body">
        <div class="container-fluid" id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9 bg-light" id="content">
                    <div class="row justify-content-center pt-4">
                        <div class="col-md-8 bg-dark p-4 rounded">
                            <div class="progress mb-4" style="height: 30px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" id="progressBar">
                                <b class="lead" id="progressText">Step - 1</b>
                                </div>
                            </div>
                            <form id="form_add_new_emp" method="post" action="action">
                                <div id="first">
                                    <h4 class="text-center bg-primary p-1 mb-4 rounded text-light">Basic Information</h4>
                                    <div class="form-group">
                                        <label for="fname" class=""><span class="required-mark">* </span>First Name</label> 
                                        <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required/>
                                        <span id="fnameError" class="error-text p-0" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="onames" >Other Names</label> 
                                        <input type="text" name="onames" id="onames" class="form-control" placeholder="Other Names"/>
                                        <span id="onamesError" class="error-text p-0" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="lname" ><span class="required-mark">* </span>Last Name</label> 
                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required/>
                                        <span id="lnameError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="nic" ><span class="required-mark">* </span>National Identity Card No.</label> 
                                        <input type="text" name="nic" id="nic" class="form-control" placeholder="NIC No." required/>
                                        <span id="nicError" class="error-text" ></span>
                                    </div>
<!--                                    <div class="form-group text-center">
                                        <a href="#" class="btn btn-warning" id="btn_next1">Next</a>
                                    </div>-->
                                    <div class="form-group text-center btn-group"  style="width: 100%">
                                        <input type="button" name="btn_next" id="btn_next" class="btn btn-success" value="Next"/>
                                    </div>
                                </div>
                                <div id="second">
                                    <h4 class="text-center bg-primary p-1 mb-4 rounded text-light">Personal Information</h4>
                                    <div class="form-group">
                                        <label ><span class="required-mark">* </span>Gender</label><br> 
                                        <div class="btn-group" data-toggle="buttons" style="width: 100%">
                                            <label class="btn btn-light">
                                                <input type="radio" name="btn_gender" id="btn_gender" value="Male" class="radio_btn_gender"/> Male
                                            </label>
                                            <label class="btn btn-light">
                                                <input type="radio" name="btn_gender" id="btn_gender" value="Female" class="radio_btn_gender"/> Female
                                            </label>
                                        </div>
                                        <span id="genderError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob" ><span class="required-mark">* </span>Date of Birth</label> 
                                        <input type="date" name="dob" id="dob" class="form-control" required/>
                                        <span id="dobError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="marital_status" ><span class="required-mark">* </span>Marital Status</label> 
                                        <select class="form-control" name="marital_status" id="marital_status">
                                            <option class="marital_status_option" value="">Select Status</option>
                                            <option class="marital_status_option" value="Single">Single</option>
                                            <option class="marital_status_option" value="Married">Married</option>
                                            <option class="marital_status_option" value="Widowed">Widowed</option>
                                            <option class="marital_status_option" value="Divorced">Divorced</option>
                                        </select>
                                        <span id="marital_statusError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group" id="div_spouse_name">
                                        <label for="spouse_name" ><span class="required-mark">* </span>Name of Spouse</label> 
                                        <input type="text" name="spouse_name" id="spouse_name" class="form-control" placeholder="Spouse Name"/>
                                        <span id="spouse_nameError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group" id="div_marriage_date">
                                        <label for="date_marriage" ><span class="required-mark">* </span>Marriage Date</label> 
                                        <input type="date" name="date_marriage" id="date_marriage" class="form-control"/>
                                        <span id="date_marriageError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group text-center btn-group"  style="width: 100%">
                                        <input type="button" name="btn_back" id="btn_back" class="btn btn-danger" value="Back"/>
                                        <input type="button" name="btn_next2" id="btn_next2" class="btn btn-success" value="Next"/>
                                    </div>
                                </div>
                                <div id="third">
                                    <h4 class="text-center bg-primary p-1 mb-4 rounded text-light">Contact Information</h4>
                                    <div class="form-group">
                                        <label for="address" ><span class="required-mark">* </span>Address</label> 
                                        <input type="text" name="address" id="address" class="form-control mb-1" placeholder="Address Line 1" />
                                        <input type="text" name="address2" id="address2" class="form-control mb-1" placeholder="Address Line 2" />
                                        <input type="text" name="address3" id="address3" class="form-control mb-1" placeholder="Address Line 3" />
                                        <span id="addressError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group input-group">
                                        <label for="city"  style="width: 49.5%"><span class="required-mark">* </span>City
                                            <select class="form-control" name="city" id="city">
                                                <option class="cityOption" value="">Select City</option>
                                                <?php $resultCity=$obemp->viewCity();
                                                while ($city=$resultCity->fetch(PDO::FETCH_BOTH)) { ?>
                                                <option class="cityOption" value="<?php echo $city['cityId']; ?>"><?php echo $city['cityName']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </label>
                                        <span class="input-group-addon text-light">&nbsp;</span>
                                        <label for="postal_code"  style="width: 49.5%"><span class="required-mark">&nbsp;</span>Postal Code
                                            <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code" disabled/>
                                        </label>
                                        <span id="cityError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group input-group">
                                        <label for="district"  style="width: 49.5%">District
                                            <input type="text" name="district" id="district" class="form-control" placeholder="District" disabled/>
                                        </label>
                                        <span class="input-group-addon text-light">&nbsp;</span>
                                        <label for="province"  style="width: 49.5%">Province
                                            <input type="text" name="province" id="province" class="form-control" placeholder="Province" disabled/>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile_no" ><span class="required-mark">* </span>Mobile Number</label> 
                                        <input type="tel" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No. 07XXXXXXXX" maxlength="10" minlength="10" required/>
                                        <span id="mobile_noError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="telephone_no" >Telephone Number</label> 
                                        <input type="tel" name="telephone_no" id="telephone_no" class="form-control" placeholder="Telephone No. 01XXXXXXXX" maxlength="10" minlength="10"/>
                                        <span id="telephone_noError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" ><span class="required-mark">* </span>Email Address</label> 
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required/>
                                        <span id="emailError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="eme_cont_name" >Emergency Contact - Name</label> 
                                        <input type="text" name="eme_cont_name" id="eme_cont_name" class="form-control" placeholder="Name of Emergency Contact"/>
                                        <span id="eme_cont_nameError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="eme_cont_no" >Emergency Contact - Contact Number</label> 
                                        <input type="tel" name="eme_cont_no" id="eme_cont_no" class="form-control" placeholder="Number of Emergency Contact 07XXXXXXXX" minlength="10" maxlength="10"/>
                                        <span id="eme_cont_noError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="eme_cont_relation" >Emergency Contact - Relationship</label> 
                                        <input type="text" name="eme_cont_relation" id="eme_cont_relation" class="form-control" placeholder="Relationship to Emergency Contact"/>
                                        <span id="eme_cont_relationError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group text-center btn-group"  style="width: 100%">
                                        <input type="button" name="btn_back2" id="btn_back2" class="btn btn-danger" value="Back"/>
                                        <input type="button" name="btn_next3" id="btn_next3" class="btn btn-success" value="Next"/>
                                    </div>
                                </div>
                                <div id="forth">
                                    <h4 class="text-center bg-primary p-1 mb-4 rounded text-light">Job Information</h4>
                                    <div class="form-group">
                                        <label for="date_joined" ><span class="required-mark">* </span>Date Joined</label>
                                        <input type="date" name="date_joined" id="date_joined" class="form-control"/>
                                        <span id="date_joinedError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="emp_type"  ><span class="required-mark">* </span>Employee Type</label>
                                            <select class="form-control" name="emp_type" id="emp_type">
                                                <option class="emp_type_option" value="">Select Employee Type</option>
                                                <option class="emp_type_option" value="Full Time">Full Time</option>
                                                <option class="emp_type_option" value="Part Time">Part Time</option>
                                                <option class="emp_type_option" value="Contracted">Contracted</option>
                                            </select>
                                        <span id="emp_typeError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="designation" ><span class="required-mark">* </span>Job Designation</label>
                                        <input type="text" name="designation" id="designation" class="form-control" placeholder="Job Designation"/>
                                        <span id="designationError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="department"  ><span class="required-mark">* </span>Department</label>
                                            <select class="form-control" name="department" id="department">
                                                <option class="department_option" value="">Select Department</option>
                                                <?php while ($dept=$resultDept->fetch(PDO::FETCH_BOTH)){ ?>
                                                <option class="department_option" value="<?php echo $dept['dept_id']; ?>"><?php echo $dept['dept_name']; ?> </option>
                                                <?php } ?>
                                            </select>
                                        <span id="departmentError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="manager"><span class="required-mark">* </span>Reporting Manager</label>
                                            <select class="form-control" name="manager" id="manager">
                                                <option value="" >Select Reporting Manager</option>
                                                <option value=0 >No Reporting Manager</option>
                                            </select>
                                            <span id="managerError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="office_email" >Office Email Address</label>
                                        <div class="form-inline">
                                            <input type="text" name="office_email" id="office_email" class="form-control" style="width: 85%" maxlength="25" placeholder="Office Email"/>
                                            <span class="input-group-addon text-light" style="font-size: 20px">@cmsl.lk</span>
                                            <span id="office_emailError" class="error-text" ></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="salary_basic" ><span class="required-mark">* </span>Basic Salary</label>
                                        <input type="number" name="salary_basic" id="salary_basic" class="form-control" placeholder="Basic Salary"/>
                                        <span id="salary_basicError" class="error-text" ></span>
                                    </div>
                                    <div class="form-group text-center btn-group"  style="width: 100%">
                                        <input type="button" name="btn_back3" id="btn_back3" class="btn btn-danger" value="Back"/>
                                        <input type="button" name="btn_submit" id="btn_submit" class="btn btn-success" value="Submit"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                
            //Regular Expressions.
                lettersOnly = new RegExp(/^[A-Za-z]+$/);
                numbersOnly = new RegExp(/^[0-9]+$/);
                patNic = new RegExp(/(^\d{9}[VvXx]{1}$)|(^\d{12}$)/);
                patMobile = new RegExp(/(^07\d{8}$)/);
                patTelephone = new RegExp(/(^0\d{9}$)/);
                patEmail = new RegExp(/^[A-Za-z0-9]+([\._-]?[A-Za-z0-9]+)+@[a-zA-Z]+([-]?[a-zA-Z])+([\.]?[a-zA-Z]{2,4}){2}$/);
                patOfficeEmail = new RegExp(/^([A-Za-z]+([\._][a-zA-Z]+)?){4,}$/);
                
            //Assign variable name for easy access.
                    const form_emp_add = $('#form_add_new_emp');
                    const result = $('#result'); 
                //First From
                    const fname = $('#fname');
                    const fnameError = $('#fnameError');
                    const onames = $('#onames');
                    const onamesError = $('#onamesError');
                    const lname = $('#lname');
                    const lnameError = $('#lnameError');
                    const nic = $('#nic');
                    const nicError = $('#nicError');
                //Second Form
                    const genderError = $('#genderError');
                    const dob = $('#dob');
                    const dobError = $('#dobError');
                    const marital_statusError = $('#marital_statusError');
                    const spouse_name = $('#spouse_name');
                    const spouse_nameError = $('#spouse_nameError');
                    const date_marriage = $('#date_marriage');
                    const date_marriageError = $('#date_marriageError');
                    const marital_status = $('#marital_status');
                    const marital_status_option = $('.marital_status_option');
                    var marital_status_val = '';
                //Third Form
                    const address = $('#address');
                    const addressError = $('#addressError');
                    const city = $('#city');
                    const city_option = $('.cityOption');
                    var city_id = '';
                    const cityError = $('#cityError');
                    const postal_code = $('#postal_code');
                    const district = $('#district');
                    const province = $('#province');
                    const mobile = $('#mobile_no');
                    const mobileError = $('#mobile_noError');
                    const telephone = $('#telephone_no');
                    const telephoneError = $('#telephone_noError');
                    const email = $('#email');
                    const emailError = $('#emailError');
                    const eme_cont_name = $('#eme_cont_name');
                    const eme_cont_nameError = $('#eme_cont_nameError');
                    const eme_cont_no = $('#eme_cont_no');
                    const eme_cont_noError = $('#eme_cont_noError');
                    const eme_cont_relationError = $('#eme_cont_relationError');
                    const eme_cont_relation = $('#eme_cont_relation');
                //Forth form
                    const date_joined = $('#date_joined');
                    const date_joinedError = $('#date_joinedError');
                    const emp_type = $('#emp_type');
                    const emp_type_option = $('.emp_type_option');
                    const emp_typeError = $('#emp_typeError');
                    const designation = $('#designation');
                    const designationError = $('#designationError');
                    const department = $('#department');
                    const department_option = $('.department_option');
                    const departmentError = $('#departmentError');
                    const manager = $('#manager');
                    const managerError = $('#managerError');
                    const office_email = $('#office_email');
                    const office_emailError = $('#office_emailError');
                    var office_email_address = '';
                    var office_email_status = '';
                    const salary_basic = $('#salary_basic');
                    const salary_basicError = $('#salary_basicError');
                
            // Check if the enterd NIC already exists.//    
                nic.on('keyup',function(){
                    $.ajax({
                        url:'../controller/controller_employee.php?action=checkNewEmployeeNic',
                        method:'post',
                        data:{nic:nic.val()},
                        success:function(data){
                            nic_result = data;
                        }
                    });
                });
                
            //Validating First Section.//
                $('#btn_next').click(function(e){
                    
                //Make sure form doesnot submit.//
                    e.preventDefault();
                              
                //Clear error messages when button clicked.//
                    fnameError.html('');
                    onamesError.html('');
                    lnameError.html('');
                    nicError.html('');
                    
                //Vaidating First Name.//
                    if (fname.val() == '') {
                        fnameError.html('* First Name Required.');
                        fname.focus();
                        return false;
                    }else if (!isNaN(fname.val())) {
                        fnameError.html('* First Name Must be in Letters.');
                        fname.focus();
                        return false;
                    }else if (lettersOnly.test(fname.val())==false) {
                        fnameError.html('* First Name Cannot Contain Numbers.');
                        fname.focus();
                        return false;
                    }
                //Vaidating Other Names.//
                    else if (onames.val() != '' && !isNaN(onames.val())) {
                        onamesError.html('* Other Names Must be in Letters.');
                        onames.focus();
                        return false;
                    }else if (onames.val() != '' && lettersOnly.test(onames.val())==false) {
                        onamesError.html('* Other Names Cannot Contain Numbers.');
                        onames.focus();
                        return false;
                    }
                // Validating Last Name.//
                    else if (lname.val() == '') {
                        lnameError.html('* Last Name Required.');
                        lname.focus();
                        return false;
                    }else if (!isNaN(lname.val())) {
                        lnameError.html('* Last Name Must be in Letters.');
                        lname.focus();
                        return false;
                    }else if (lettersOnly.test(lname.val())==false) {
                        lnameError.html('* Last Name Cannot Contain Numbers.');
                        lname.focus();
                        return false;
                    }
                //Validation NIC No.//
                    else if (nic.val() == '') {
                        nicError.html('* National Identity Card No. Required.');
                        nic.focus();
                        return false;
                    }else if (patNic.test(nic.val())==false){
                        nicError.html('* Incorrect NIC Format.');
                        nic.focus();
                        return false;
                    }else if (patNic.test(nic.val())==true && nic_result=='NIC Error') {
                        nicError.html('Employee with the same NIC no. already exists.');
                        nic.focus();
                        return false;
                    }
                //If all pass go to next section.//
                    else{
                        $('#second').show();
                        $('#first').hide();
                        $('#progressBar').css('width','50%');
                        $('#progressText').html('Step - 2');
                    }
                });
                
            //Show or hide Spouse name & marriage date if Marital status is Married.
                marital_status.change(function(){
                    marital_status_val = marital_status_option.filter(':selected').val();
                    if(marital_status_val=='Married'){
                        $('#div_spouse_name').show();
                        $('#div_marriage_date').show(); 
                    }else{
                        $('#div_spouse_name').hide();
                        $('#div_marriage_date').hide();
                    }
                }); 
                
            //Validating Second Section.//    
                $('#btn_next2').click(function(e){
                    
                //Make sure form doesnot submit.//
                    e.preventDefault();
                    
                //Clear error messages when button clicked.//
                    genderError.html('');
                    dobError.html('');
                    marital_statusError.html('');
                    spouse_nameError.html('');
                    date_marriageError.html('');
                     
                //Validate gender.//
                    if (!$('.radio_btn_gender').is(':checked')) {
                        genderError.html('* Select Gender.');
                        $('#btn_gender').focus();
                        return false;
                    }
                //Validate date of birth.//
                    else if (dob.val()=='') {
                        dobError.html('* Select Date of Birth.');
                        dob.focus();
                        return false;
                    }
                //Validate marital status.//    
                    else if (marital_status_val=='') {
                        marital_statusError.html('* Select Marital Status.');
                        marital_status.focus();
                        return false;
                    }
                // Validate Spouse name if marital status is married.//
                    else if (marital_status_val=='Married' && spouse_name.val()=='') {
                        spouse_nameError.html('* Spouse Name Cannot be Blank.');
                        spouse_name.focus();
                        return false;
                    }else if (marital_status_val=='Married' && !isNaN(spouse_name.val())) {
                        spouse_nameError.html('* Spouse Name Must be in Letters.');
                        spouse_name.focus();
                        return false;
                    }else if (marital_status_val=='Married' && lettersOnly.test(spouse_name.val())==false) {
                        spouse_nameError.html('* Spouse Name Cannot Contain Numbers.');
                        spouse_name.focus();
                        return false;
                    }
                // If Married date must not be blank.//
                    else if (marital_status_val=='Married' && date_marriage.val()=='') {
                        date_marriageError.html('* Select Marriage Date.');
                        date_marriage.focus();
                        return false;
                    }
                //If all pass go to third section.//
                    else{                     
                        $('#second').hide();
                        $('#third').show();
                        $('#progressBar').css('width','75%');
                        $('#progressText').html('Step - 3');
                    }
                });
                
            //Fill Postal Code, District & Province based on city.//
                city.change(function(){
                    city_id = city_option.filter(':selected').val();
                    city_name = city_option.filter(':selected').text();
                    
                    $.ajax({
                     url:'../controller/controller_employee.php?action=checkCityInfo',
                     method:'post',
                     data:{city_id:city_id},
                     success:function(data){
                         var cityResult = jQuery.parseJSON(data);
                         postal_code.val(cityResult['postalCode']);
                         district.val(cityResult['districtName']);
                         province.val(cityResult['provinceName']);    
                     }
                    });
                }); 
                
            //Validating Third Section.//      
                $('#btn_next3').click(function(e){
                    
                //Make sure form doesnot submit.//
                    e.preventDefault();
                    
                //Clear error messages when button clicked.//
                    addressError.html('');
                    cityError.html('');
                    mobileError.html('');
                    telephoneError.html('');
                    emailError.html('');
                    eme_cont_nameError.html('');
                    eme_cont_noError.html('');
                    eme_cont_relationError.html('');
                    
                //Validate address.//
                    if (address.val()=='') {
                        addressError.html('* Please enter address.');
                        address.focus();
                        return false;
                    }
                //Validate city.//    
                    else if (city_id=='') {
                        cityError.html('* Please select city.');
                        city.focus();
                        return false;
                    }
                //Validate mobile no.//    
                    else if (mobile.val()=='') {
                        mobileError.html('* Please enter mobile number.');
                        mobile.focus();
                        return false;
                    }else if (patMobile.test(mobile.val())==false) {
                        mobileError.html('* Please enter a valid mobile number (07XXXXXXXX).');
                        mobile.focus();
                        return false;
                    }
                //Validate telephone no.//    
                    else if (telephone.val()!='' && patTelephone.test(telephone.val())==false) {
                        telephoneError.html('* Please enter a valid telephone number (01XXXXXXXX).');
                        telephone.focus();
                        return false;
                    }
                //Validate email address.//    
                    else if (email.val()=='') {
                        emailError.html('* Please enter email address.');
                        email.focus();
                        return false;
                    }else if (patEmail.test(email.val())==false) {
                        emailError.html('* Please enter a valid email address.');
                        email.focus();
                        return false;
                    }
                //Validate emergency contact details.//    
                    else if (eme_cont_name.val()!='' && !isNaN(eme_cont_name.val())) {
                        eme_cont_nameError.html('* Emergency Contact Name Must be in Letters.');
                        eme_cont_name.focus();
                        return false;
                    }else if (eme_cont_name.val()!='' &&  lettersOnly.test(eme_cont_name.val())==false) {
                        eme_cont_nameError.html('* Emergency Contact Name Cannot Contain Numbers.');
                        eme_cont_name.focus();
                        return false;
                    }else if (eme_cont_no.val()!='' && patTelephone.test(eme_cont_no.val())==false) {
                        eme_cont_noError.html('* Please enter a valid mobile or telephone number.');
                        eme_cont_no.focus();
                        return false;    
                    }else if (eme_cont_relation.val()!='' &&  lettersOnly.test(eme_cont_relation.val())==false) {
                        eme_cont_relationError.html('* Emergency Contact Relationship Cannot Contain Numbers.');
                        eme_cont_relation.focus();
                        return false;
                    }else if (eme_cont_relation.val()!='' && !isNaN(eme_cont_relation.val())) {
                        eme_cont_relationError.html('* Emergency Contact Name Must be in Letters.');
                        eme_cont_relation.focus();
                        return false;
                    }
                //If all pass go to forth section.//    
                    else{
                        $('#forth').show();
                        $('#third').hide();
                        $('#progressBar').css('width','100%');
                        $('#progressText').html('Step - 4');
                    }
                });
                
            //Reporting Managers dropdown.
                department.change(function(){
                    var department_id = department_option.filter(':selected').val();
                    
                    $.ajax({
                     url:'../controller/controller_department.php?action=viewDepartmentManagers',
                     method:'post',
                     data:{dept_id:department_id},
                     success:function(data){
                         manager.html(data);
                     }
                    });
                }); 
                
            //Office email.
                office_email.keyup(function(){
                    if (office_email.val()=='') {
                        office_emailError.html('');
                        office_email_status = '';
                    }else{
                        office_email_address = office_email.val()+'@cmsl.lk';
                        if (patOfficeEmail.test(office_email.val())==false) {
                            office_emailError.html(' * Enter a valid email.');
                            office_emailError.css('color','red');
                            office_email_status = 'Invalid';
                        }else{
                            $.ajax({
                                url:'../controller/controller_employee.php?action=checkEmpOfficeEmail',
                                method:'post',
                                data:{office_email_address:office_email_address},
                                success:function(data){
                                    if (data=='* Email address available.') {
                                        office_emailError.html(data);
                                        office_emailError.css('color','limegreen');
                                        office_email_status = 'Valid';
                                    }else{
                                        office_emailError.html(data);
                                        office_emailError.css('color','red');
                                        office_email_status = 'Invalid';
                                    }
                                }
                            });
                        }           
                    }
                     
                });
                
            //Validating forth section.//    
                $('#btn_submit').click(function(e){
                    
                //Make sure form doesnot submit.//
                    e.preventDefault();
                    
                //Clear error messages when button clicked.//
                    date_joinedError.html('');
                    emp_typeError.html('');
                    designationError.html('');
                    departmentError.html('');
                    managerError.html('');
                    salary_basicError.html('');
                    
                //Validate date joined.//
                    if (date_joined.val()=='') {
                        date_joinedError.html('* Please select joined date.');
                        date_joined.focus();
                        return false;
                    }
                //Validate employee type.//    
                    else if(emp_type_option.filter(':selected').val()==''){
                        emp_typeError.html('* Please select employee type.');
                        emp_type.focus();
                        return false;
                    }
                //Validate employee designation.//    
                    else if(designation.val()==''){
                        designationError.html('* Please enter employee designation.');
                        designation.focus();
                        return false;
                    }
                //Validate employee department.//    
                    else if(department_option.filter(':selected').val()==''){
                        departmentError.html('* Please select department.');
                        department.focus();
                        return false;
                    }
                //Validate employee manager.//    
                    else if($('.manager_option').filter(':selected').val()==''){
                        managerError.html("* Please select a manager or select 'No Reporting Manager'.");
                        manager.focus();
                        return false;
                    } 
                //Validate employee office email.//    
                    else if(office_email_status=='Invalid'){
                        office_email.focus();
                        return false;
                    }
                //Validate employee basic salary.//    
                    else if(salary_basic.val()=='' || salary_basic.val()==0){
                        salary_basicError.html('* Please enter employee basic salary.');
                        salary_basic.focus();
                        return false;
                    }else if(salary_basic.val()<0){
                        salary_basicError.html('* Employee basic salary cannot be less than 0 (zero).');
                        salary_basic.focus();
                        return false;
                    }
                //If all pass submit form.//
                    else{
//                        $.confirm({
//                            title:"New Employee Confirmation",
//                            text:"You are about to add a new employee.",
//                            confirm: function(button) {
//                                alert("You just confirmed.");
//                            },
//                            cancel: function(button) {
//                                alert("You aborted the operation.");
//                            },
//                            confirmButton: "Okay",
//                            cancelButton: "Cancel"
//                        });
                        
                        
                        if (confirm("You are about to add a new employee")==true) {
                            if (confirm("Are you sure to proceed?")==true) {
                                var form_add_new_employee = $('#form_add_new_emp');
                                $.ajax({
                                    url:'../controller/controller_employee.php?action=addNewEmployee',
                                    method:'POST',
                                    data:form_add_new_employee.serialize(),
                                    success:function(data){
                                         window.location.reload();
                                        alert(data);
                                    }
                                });
                            }
                                return false;
                        }
                            return false;
//                        alert('Okay');
                    }
                });
                
                $('#btn_back').click(function(){
                    $('#first').show();
                    $('#second').hide();
                    $('#progressBar').css('width','25%');
                    $('#progressText').html('Step - 1');
                });
                
                $('#btn_back2').click(function(){
                    $('#second').show();
                    $('#third').hide();
                    $('#progressBar').css('width','50%');
                    $('#progressText').html('Step - 2');
                });
                
                $('#btn_back3').click(function(){
                    $('#third').show();
                    $('#forth').hide();
                    $('#progressBar').css('width','75%');
                    $('#progressText').html('Step - 3');
                });
                
            });
        
        </script>
    </body>
</html>