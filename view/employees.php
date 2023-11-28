<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';
include '../restrictedAccess/all_restricted.php';

$obemp=new model_employee();
$result=$obemp->viewAllEmployee();
$empId_login=$emprow['emp_id'];

if (isset($_SESSION['sec'])) {
    $sec = $_SESSION['sec'];
    header("Refresh:$sec");
//    unset($_SESSION['msgs']);
    unset($_SESSION['sec']);
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
                        <div class="col-md-12 textalc text-uppercase"><h2>Employee</h2></div>
                    </div>
                    <div class="row">
                        <?php include '../template/messagebox.php'; ?>
                    </div>
                    <div class="row" style="text-align: right; padding-right: 20px">
                        <a href="../view/employees_add.php">
                        <button class="btn btn-primary">Add Employee</button>
                        </a>
                    </div>
                    <br/><br/>
                    <div>
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="15%">Department</th>
                                    <th width="15%">Status</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($emp_all=$result->fetch(PDO::FETCH_BOTH)){
                                    ?>
                                <tr>
                                    <td><?php echo $emp_all['emp_id']; ?></td>
                                    <td><?php echo $emp_all['emp_fname']." ".$emp_all['emp_lname']; ?></td>
                                    <td><?php echo $emp_all['dept_name']; ?></td>
                                    <td><?php echo $emp_all['emp_status']; ?></td>
                                    <td><a href="../view/employees_view.php?viewEmpId=<?php echo $emp_all['emp_id']; ?>"<button class="btn btn-info">View Details</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>