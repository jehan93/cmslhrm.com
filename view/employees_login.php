<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
include '../restrictedAccess/all_restricted.php';

$obemp=new model_employee();
$result=$obemp->viewAllEmployee();
$empId_login=$emprow['emp_id'];

if(!empty($_SESSION['success'])){
    $msg = $_SESSION['success'];
  echo "<script type='text/javascript'>alert('$msg');</script>";
 unset($_SESSION['success']);//so you do not have to display it over and over again
}

?>

<html>
    <head>
        <?php include '../template/htmlHead.php'; ?>
    </head>
    <body id="body">
        <div class="container-fluid" id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Manage Employee Logins</h2></div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-md-12" id="div_emp_login_details"></div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        $('#div_emp_login_details').load('employees_login_view.php');
    });
        
    $(document).on('click','.btn_status',function(){
            var update_status = $(this).attr('btn_status');
            var btn_status = $(this).val();
            var btn_id = $(this).attr('btn_id');
            
            if (confirm("Do you want to "+btn_status+" this User?")==true) {
                $.ajax({
                   url:'../controller/controller_employee.php?action=updateEmpLoginStatus',
                   method:'POST',
                   data:{emp_id:btn_id,login_status:update_status},
                   success:function(data){
                       alert(data);
                       $('#div_emp_login_details').load('employees_login_view.php');
                   }
                });
            }
        });
    
    $(document).on('click','.btn_pwd_reset',function(){
            var btn_id = $(this).attr('btn_id');
            
            if (confirm("Do you want to Reset the Password of this User?")==true) {
                $.ajax({
                   url:'../controller/controller_employee.php?action=resetPassword',
                   method:'POST',
                   data:{emp_id:btn_id},
                   success:function(data){
                       alert(data);
                   }
                });
            }
        });
        
    $(document).on('click','.btn_assign_login',function(){
            var btn_id = $(this).attr('btn_id');
            
            if (confirm("Do you want to Assign a Login for this User?")==true) {
                $.ajax({
                   url:'../controller/controller_employee.php?action=assignEmpLogin',
                   method:'POST',
                   data:{emp_id:btn_id},
                   success:function(data){
                       alert(data);
                       $('#div_emp_login_details').load('employees_login_view.php');
                   }
                });
            }
        }); 
        
        $(document).on('click','.btn_delete_login',function(){
            var btn_id = $(this).attr('btn_id');
            
            if (confirm("Do you want to Delete Login for this User?")==true) {
                if (confirm("Are you sure?")==true) {
                    $.ajax({
                       url:'../controller/controller_employee.php?action=deleteEmpLogin',
                       method:'POST',
                       data:{emp_id:btn_id},
                       success:function(data){
                           alert(data);
                           $('#div_emp_login_details').load('employees_login_view.php');
                       }
                    });
                }
            }
        }); 
</script>