<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_department.php';

if (isset($_REQUEST['dept_id'])) {
    $deptId = $_REQUEST['dept_id'];
    if ($_REQUEST['dept_id']!="") {
        $deptId = $_REQUEST['dept_id'];
    }    
$obdept = new model_department();
$result=$obdept->viewDepartmentInfo($deptId);
$deptInfo = $result->fetch(PDO::FETCH_BOTH);
$deptName = $deptInfo['dept_name'];
$deptHeadId = $deptInfo['dept_head_emp_id'];

$result=$obdept->viewDepartmentManagers($deptId);
$deptManagersInfo = $result->fetch(PDO::FETCH_BOTH);
$deptManagerEmpId = $deptManagersInfo['dept_manager_emp_id'];

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
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9 container" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Departments Employees - <?php echo $deptName ?></h2></div>
                    </div>
                        <?php include '../template/messagebox.php'; ?>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:5%; vertical-align: text-top">Employee ID</th>
                                        <th style="width:20%; vertical-align: text-top">Employee Name</th>
                                        <th style="width:15%; vertical-align: text-top ">Joined Date</th>
                                        <th style="width:15%; vertical-align: text-top ">Role</th>
                                        <th style="width:45%; vertical-align: text-top "></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result=$obdept->viewDepartmentEmployees($deptId);
                                    while ($deptEmp=$result->fetch(PDO::FETCH_BOTH)){?>
                                   <tr>
                                        <td><?php echo $deptEmp['emp_id'];?></td>
                                        <td><?php echo $deptEmp['emp_fname']." ".$deptEmp['emp_lname'];?></td>
                                        <td><?php echo $deptEmp['from_date'];?></td>
                                        <td><?php if ($deptHeadId==$deptEmp['dept_emp_id']) {
                                            $empRole = 'Department Head';
                                            echo $empRole;
                                        }elseif ($deptManagerEmpId==$deptEmp['dept_emp_id']){
                                            $empRole = 'Manager';
                                            echo $empRole;
                                        }else{ 
                                            $empRole = 'Employee';
                                            echo $empRole;
                                        }?></td>
                                        <td>
                                            <?php if ($empRole == "Manager") { ?>
                                            <a href="../view/managed_employees.php">
                                                <?php 
                                                $_SESSION['managerId'] = $deptManagersInfo['dept_manager_id'];
                                                $_SESSION['dept_name'] = $deptName;
                                                $_SESSION['managerName'] = $deptEmp['emp_fname']." ".$deptEmp['emp_lname'];
                                                ?>
                                                <button class="btn btn-info">Managed Employees</button></a>
                                            <?php } ?>
<!--                                            <button class="btn btn-primary">Make Dept. Head</button>
                                            <button class="btn btn-primary">Make Manager</button>
                                            <button class="btn btn-primary">Transfer</button>-->
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row textalc">
                            <!--<button type="submit" onclick="history.back();">Back</button>-->
                            <a href="../view/department.php"><button class="btn btn-danger">Back</button></a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>