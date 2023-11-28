<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

$obemp=new model_employee();

$empId_login=$emprow['emp_id'];
$currentYear = date("Y");

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
                    var fname=$('#fname').val();
                    var onames=$('#onames').val();
                    var lname=$('#lname').val();
                    var address1=$('#address1').val();
                    var address2=$('#address2').val();
                    var address3=$('#address3').val();
                    var dob=$('#dob').val();
                    var nic=$('#nic').val();
                    
                    pat_tel=/^\+94[0-9]{9}$/;
                    pat_nic=/^[0-9]{9}[vVxX]{1}$/;
                    pat_nic_new=/^[0-9]{12}$/;
                    
                    if(fname.trim()==""){
                        $('#fnameerr').text("First name can't be blank");
                        $('#fname').focus();
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
                    if (confirm("You are about to add a New Employee. Do you want to continue?")==false){
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
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>Add New Employee</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <?php include '../template/messagebox.php'; ?>
                            <table class="table table-bordered table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th>a. Employee Basic Information</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp" id="add_emp" method="post" action="../controller/controller_employee.php?action=addEmployee">
                                                <!--<form name="add_emp" id="add_emp" method="post" action="#">-->
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>First Name</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" onkeyup="clearMsg('fnameerr')">
                                                        <a class="error">*</a><span id="fnameerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Other Names</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="onames" id="onames" placeholder="Other Names">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Last Name / Surname</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="lname" id="lname" placeholder="Last/Surname" onkeyup="clearMsg('lnameerr')">
                                                        <a class="error">*</a><span id="lnameerr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>National Identity Card No.</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="nic" id="nic" onkeyup="clearMsg('nicerr')">
                                                        <a class="error">*</a><span id="nicerr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4></h4></div>
                                                    <div class="col-md-7">
                                                        <input type="submit" name="submit"  if="submit" value="Save" class="btn btn-success"/>
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