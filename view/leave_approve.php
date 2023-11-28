<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_leave.php';
include '../restrictedAccess/employees_restricted.php';

unset($_SESSION['leaveId']);
$obleave=new model_leave();
//var_dump($emprow);
$empId=$emprow['login_emp_id'];
$deptId=$emprow['dept_id'];
$deptHeadId=$emprow['dept_head_emp_id'];
$deptManagerId=$emprow['dept_manager_id'];
//$result=$obleave->viewLeaveToApproveByManager($deptId, $deptManagerId);
//$empLeave=$result->fetch(PDO::FETCH_BOTH);
//var_dump($empLeave);
//echo $deptHeadId;
$role = $emprow['emp_role'];
if ($role=="Manager") {
    $result=$obleave->viewLeaveToApproveByManager($deptId, $deptManagerId);
}elseif ($role=="Department Head") {
    $result=$obleave->viewLeaveToApproveByDeptHead($deptHeadId);
}
?>

<html>
    <head>
        <title>Approve Leaves</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
            <div id="content" class="col-md-9">
                <div class="row ">
                    <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 50px"><h2>Leave Approval</h2></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-striped" >
                        <thead>
                            <tr>
<!--                                <th width="5%"></th>
                                <th width="15%">Employee Name</th>
                                <th width="13%">Date From</th>
                                <th width="13%">Date To</th>
                                <th width="7%">No.of Days</th>
                                <th width="8%">Type of Leave</th>
                                <th width="10%">Status</th>
                                <th width="29%"></th>-->
                                <th></th>
                                <th>Employee Name</th>
                                <th>Date From</th>
                                <th>Date To</th>
                                <th>No.of Days</th>
                                <th>Type of Leave</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rowno=1;
                            while ($empLeave=$result->fetch(PDO::FETCH_BOTH)){
                                
                                ?>
                            <tr>
                                <td style="vertical-align: middle" class="textalc"><b><?php echo $rowno++; ?></b></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['emp_fname'].' '.$empLeave['emp_lname']; ?></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['leave_from']; ?></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['leave_to']; ?></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['leave_days']; ?></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['leave_type']; ?></td>
                                <td style="vertical-align: middle"><?php echo $empLeave['leave_status']; ?></td>
                                <td>
                                    <a href="../view/leave_view.php?leaveId=<?php echo $empLeave['leave_id']?>&deptId=<?php echo $deptId ?>">
                                        <button class="btn btn-info">View</button></a>
                                </td>
                            </tr>
                            <?php  }?>
                        </tbody>
                    </table>
                    </div>
                    
                    
                    
                </div>
                
            </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>