<?php
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

$obemp=new model_employee();
$result=$obemp->viewAllEmployee();
$empId_login=$emprow['emp_id'];
?>

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
            if ($loginStatus== "" || $loginStatus==NULL) {
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
                        <button value="<?php echo $btn_value; ?>" type="button" class="btn btn-<?php echo $btn_class; ?> btn-sm btn_status" btn_id="<?php echo $empId; ?>" btn_status="<?php echo $status; ?>"><?php echo $btn_value; ?></button>
                    </div>
                    <div id="div_pwd_reset" style="display: inline">
                        <button type="button" class="btn btn-warning btn-sm btn_pwd_reset" btn_id="<?php echo $empId; ?>">Reset Password</button>
                    </div>
                    <div id="div_pwd_delete" style="display: inline">
                        <button type="button" class="btn btn-danger btn-sm btn_delete_login" btn_id="<?php echo $empId; ?>">Delete Login</button>
                    </div>
                <?php }else{?>
                    <div id="div_assign_login" style="display: inline">
                        <button type="button" class="btn btn-primary btn-sm btn_assign_login" btn_id="<?php echo $empId; ?>">Assign Login</button>
                    </div>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>