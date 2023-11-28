<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

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
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Manage Employee Logins</h2></div>
                    </div>
                    <br/><br/>
                    <div>
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th width="10%" style="vertical-align: top">Employee ID</th>
                                    <th width="20%" style="vertical-align: top">Name</th>
                                    <th width="15%" style="vertical-align: top">Employment Status</th>
                                    <th width="15%" style="vertical-align: top">Login Status</th>
                                    <th width="40%" style="vertical-align: top"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($emp_all=$result->fetch(PDO::FETCH_BOTH)){
                                    ?>
                                <tr>
                                    <td><?php echo $emp_all['emp_id']; ?></td>
                                    <td><?php echo $emp_all['emp_fname']." ".$emp_all['emp_lname']; ?></td>
                                    <td><?php echo $emp_all['emp_status']; ?></td>
                                    <td><?php 
                                    $empId = $emp_all['emp_id'];
                                    $resultLoginInfo = $obemp->viewEmpLogin($empId);
                                    $empLoginInfo = $resultLoginInfo->fetch(PDO::FETCH_BOTH);
                                    $loginStatus = $empLoginInfo['login_status'];
                                    if ($loginStatus=="") {
                                        $loginStatus = "Not Assigned";
                                        echo $loginStatus;
                                    }else{
                                        echo $loginStatus;  
                                    }
                                    ?></td>
                                    <td>
                                        <?php
                                        if ($empId_login!=$empId && ($loginStatus=="Active" || $loginStatus=="Deactive")) { 
                                            if ($loginStatus=="Active"){
                                                $btn_value = "Deactivate";
                                                $btn_class = "Danger";
                                                $status = "Deactive";
                                            }elseif ($loginStatus=="Deactive") {
                                                $btn_value = "Activate";
                                                $btn_class = "Success";
                                                $status = "Active";
                                            } ?>
                                            <div id="div_login_status" style="display: inline">
                                                <button value="<?php echo $btn_value; ?>" type="button" class="btn btn-<?php echo $btn_class; ?> btn_status" btn_id="<?php echo $empId; ?>" btn_status="<?php echo $status; ?>"><?php echo $btn_value; ?></button>
                                            </div>
                                            <div id="div_pwd_reset" style="display: inline">
                                                <button type="button" class="btn btn-warning btn_pwd_reset" btn_id="<?php echo $empId; ?>">Reset Password</button>
                                            </div>
                                        <?php }else{?>
                                            <div id="div_assign_login" style="display: inline">
                                                <button type="button" class="btn btn-primary btn_assign_login" btn_id="<?php echo $empId; ?>">Assign Login</button>
                                            </div>
                                    </td>
                                </tr>
                                <?php }} ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
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
</script>