<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_department.php';
include '../restrictedAccess/all_restricted.php';
$obdept = new model_department();
$result=$obdept->viewDepartment();

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
                        <div class="col-md-12 textalc text-uppercase"><h2>Departments</h2></div>
                    </div>
                        <?php include '../template/messagebox.php'; ?>
                    <div>&nbsp;</div>
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <a href="../view/department_add.php"><button class="btn btn-primary">Add Department</button></a>
                        </div>
                    </div>
                    <div>&nbsp;</div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Department ID</th>
                                        <th>Department Name</th>
                                        <th>Department Head</th>
                                        <th>Department Employees</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($deptrow=$result->fetch(PDO::FETCH_BOTH)){?>
                                   <tr>
                                        <td><?php echo $deptrow['dept_id'];?></td>
                                        <td><?php echo $deptrow['dept_name'];?></td>
                                        <td><?php echo $deptrow['emp_fname']." ".$deptrow['emp_lname'];?></td>
                                        <td><a href="../view/department_emp.php?dept_id=<?php echo $deptrow['dept_id'];?>"><button class="btn btn-primary" id="btn_viewEmp">View Employees</button></a></td>
                                    </tr>
                                    <?php } ?>
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