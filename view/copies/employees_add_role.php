<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../model/model_department.php';
include '../model/model_role.php';
include '../template/dateTime.php';
$obemp=new model_employee();
$result=$obemp->viewNewEmpPersonalDetails($newEmpId);
$newEmpInfo=$result->fetch(PDO::FETCH_BOTH);
//$result=$obemp->viewAllEmployee();
//$allEmp=$result->fetch(PDO::FETCH_BOTH);
//var_dump($allEmp);

$obdept=new model_department();
$resultd=$obdept->viewDepartment();

$obrole=new model_role();
$resultr=$obrole->viewRoles();

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
                    var role=$('#role').val();
                    var department=$('#department').val();
                    
                    if(role ==""){
                         $('#roleerr').text("Please Select a Role");
                         $('#role').focus();
                         return false;
                     }
                    if(department ==""){
                         $('#depterr').text("Please select a Department");
                         $('#department').focus();
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
                                        <th>c. Employee Official Details</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp_office_details" id="add_emp_contact_details" method="post" action="">
                                                <div class="row">
                                                    <div class="col-md-5"><h4>New Employee Name</h4></div>
                                                    <div class="col-md-7"><h4><?php echo $newEmpInfo['emp_fname']." ".$newEmpInfo['emp_lname']; ?></h4></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Role</h4></div>
                                                    <div class="col-md-7">
                                                        <select name="role" id="role" class="form form-control">
                                                            <option></option>
                                                            <?php while ($role=$resultr->fetch(PDO::FETCH_BOTH)){ ?>
                                                            <option><?php echo $role['role_name']; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                        <a class="error">*</a><span id="roleerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Department</h4></div>
                                                    <div class="col-md-7">
                                                        <select name="department" id="department" class="form form-control">
                                                            <option></option>
                                                            <?php while ($dept=$resultd->fetch(PDO::FETCH_BOTH)){ ?>
                                                            <option><?php echo $dept['dept_name']; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                        <a class="error">*</a><span id="depterr" class="error" ></span>
                                                    </div> 
                                                </div>
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