<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
include '../template/dateTime.php';

$obemp=new model_employee();
$result=$obemp->viewAllEmployee();
$empId_login=$emprow['emp_id'];


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
                <div class="col-md-9" id="content">
                    <br/>
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>View Employee Attendance</h2></div>
                    </div>
                    <div>
                        <br/><br/>
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th width="15%">Employee ID</th>
                                    <th width="25%">Name</th>
                                    <th width="15%">Department</th>
                                    <th width="15%"></th>
                                </tr>
                            </thead>
                            <tbody> 
                                <tr>
                                    <?php while ($emp_all=$result->fetch(PDO::FETCH_BOTH)){ ?>
                                    <td><?php echo $emp_all['emp_id']; ?></td>
                                    <td><?php echo $emp_all['emp_fname'].' '.$emp_all['emp_lname']; ?></td>
                                    <td><?php echo $emp_all['dept_name']; ?></td>
                                    <td><a href="../controller/controller_attendance.php?action=view_attendance&emp_id=<?php echo $emp_all['emp_id']; ?>">
                                            <button type="button" class="btn btn-primary">View Full Attendance</button></a>
                                    </td>
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