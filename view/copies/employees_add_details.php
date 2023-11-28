<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
$obemp=new model_employee();
$empId_login=$emprow['emp_id'];
$currentYear = date("Y");

$result=$obemp->viewNewEmpDetails($newEmpId);
$newEmpInfo=$result->fetch(PDO::FETCH_BOTH);

if (isset($_GET['postalCode'])) {
    echo $postalCode=$_GET['postalCode'];    
}

?>

<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <!--<script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
<!--        <script>
            $(document).ready(function(){
                $('form').submit(function(){
                    var postal=$('#postalCode').val();
                    var onames=$('#onames').val();
                    var district=$('#district');
                    var address1=$('#address1').val();
                    var address2=$('#address2').val();
                    var address3=$('#address3').val();
                    var dob=$('#dob').val();
                    var nic=$('#nic').val();
                    
                    pat_tel=/^\+94[0-9]{9}$/;
                    pat_nic=/^[0-9]{9}[vVxX]{1}$/;
                    pat_nic_new=/^[0-9]{12}$/;
                    
                    if(postal==""){
                        $('#district').text("First name can't be blank");
                        $('#postal').focus();
                        return false;
                    }
//                   
                    if(lname==""){
                        $('#lnameerr').text("Last name can't be blank");
                        $('#lname').focus();
                        return false;
                    }
                    if(address1==""){
                        $('#addresserr').text("Address can't be blank");
                        $('#address1').focus();
                        return false;
                    }
//                    if(tel !="" && !tel.match(pat1)){
//                         $('#telerr').text("Invalid Telephone Number");
//                         $('#tel').select();
//                         return false;
//                     }
//                    if(dob==""){
//                        $('#doberr').text("DOB can't be blank");
//                        $('#dob').focus();
//                        return false;
//                    }else{
//                        var current=new Date();
//                        var cyear=current.getFullYear();
//                        var cmonth=current.getMonth();
//                        var cdate=current.getDate();
//                        
//                        var bdate=new Date(dob);
//                        var y=bdate.getFullYear();
//                        var m=bdate.getMonth();
//                        var d=bdate.getDate();
//                        
//                        var age=cyear-y;
//                        var month=cmonth-m;
//                        var date=cdate-d;
//                        if(month<0 || month==0 && date<0){
//                            age--;
//                        }
//                        if(age<0){
//                            $('#doberr').text("Please Enter REAL dob");
//                            $('#dob').focus();
//                            return false;
//                        }
//                        if(age<18){
//                            $('#doberr').text("Under Age");
//                            $('#dob').focus();
//                            return false;
//                        }
//                        if(age>55){
//                            $('#doberr').text("Over Age");
//                            $('#dob').focus();
//                            return false;
//                        }                      
//                    }
                    if(nic==""){
                        $('#nicerr').text("NIC can't be blank");
                        $('#nic').focus();
                        return false;
                    }
                    if(nic !="" && !nic.match(pat_nic)){
                        if(nic !="" && !nic.match(pat_nic_new)){
                        $('#nicerr').text("NIC format incorrect");
                        $('#nicerr').focus();
                        return false;
                    }
                }
                    
                    
                });
            });
            function clearMsg(errp){
                document.getElementById(errp).innerHTML="";
            }
        </script>-->
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>Add New Employee</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <?php include '../template/messagebox.php'; ?>
                            <table class="table table-bordered table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th>c. Employee Personal Details</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp_personal_details" id="add_emp_personal_details" method="post" action="../controller/controller_employee.php?action=addEmpDetailsPersonal">
                                                <div class="row">
                                                    <div class="col-md-4"><h4>New Employee Name</h4></div>
                                                    <div class="col-md-8"><h4><?php echo $newEmpInfo['emp_fname']." ".$newEmpInfo['emp_lname']; ?></h4></div>
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>Address</h4></div>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="address1" id="address1" placeholder="Address Line 1" onkeyup="clearMsg('addresserr')">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>&nbsp;</h4></div>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="address2" id="address2" placeholder="Address Line 2">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>&nbsp;</h4></div>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="address3" id="address3" placeholder="Address Line 3">
                                                        <a class="error">*</a><span id="addresserr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>City</h4></div>
                                                    <div class="col-md-3" style="padding-right: 0px">
                                                        <select class="form-control chosen" name="city" id="city">
                                                            <option></option>
                                                            <?php $result=$obemp->viewCity();
                                                            while ($city=$result->fetch(PDO::FETCH_BOTH)) { ?>
                                                            <option value="<?php echo $city['cityId']; ?>"><?php echo $city['cityName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2" style="padding-right: 0px;">Postal Code </div>
                                                    <div class="col-md-3" id="postal"><input class="form-control" type="text" name="form-postalCode" value=""id="form-postalCode" readonly="readonly" placeholder="Postal Code"></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>District</h4></div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" type="text" name="form-district" id="form-district" readonly="readonly" placeholder="District">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>Province</h4></div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" type="text" name="form-province" id="form-province" readonly="readonly" placeholder="Province">
                                                    </div> 
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>Gender</h4></div>
                                                    <div class="col-md-4">
                                                        <input type="radio" id="radio_gender" name="radio_gender" value="Male"/>Male <br>
                                                        <input type="radio" id="radio_gender" name="radio_gender" value="Female"/>Female
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>Date of Birth</h4></div>
                                                    <div class="col-md-4">
                                                        <input class="form-control" type="date" name="dob" id="dob" onclick="clearMsg('doberr')">
                                                        <a class="error">*</a><span id="doberr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4>Marital Status</h4></div>
                                                    <div class="col-md-4">
                                                        <select class="form-control" name="maritalStatus" id="maritalStatus">
                                                            <option value="">Select Status</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widowed">Widowed</option>
                                                            <option value="Divorced">Divorced</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-4"><h4></h4></div>
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
    <script type="text/javascript">
    $(".chosen").chosen();
    
    $(document).ready(function(){
    $('#city').change(function(){
        var cityId = $(this).val();
    
        $.ajax({
            url:"load_data.php",
            method:"POST",
            data:{cityId:cityId},
            success:function(data){
                var cityResult = jQuery.parseJSON(data);
                $('#form-postalCode').val(cityResult["postalCode"]);
                $('#form-district').val(cityResult["districtName"]);
                $('#form-province').val(cityResult["provinceName"]);
            }
        });
    });
});
    </script>
</html>