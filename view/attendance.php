<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_attendance.php';
//include '../model/model_employee.php';
include '../template/dateTime.php';

$obatt=new model_attendance();
//$date=date('Y-m-d');
if (isset($_POST['search'])){
    $date=$_POST['att_date'];
} else{
    $date;
}
echo $date;
//
//var_dump($emprow);

//$obemp=new model_employee();
//$result=$obemp->viewAllEmployee();
//
//$empId_login=$emprow['emp_id'];


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
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Employee Attendance for <br><?php echo date("dS F Y", strtotime($date)); ?></h2></div>
                    </div>
                    <form id="att" name="att" method="post" onsubmit="return isEmpty();">
                        <div class="row" style="padding-bottom: 10Px">
                            <div class="col-md-12" style="text-align: right; padding-top: 15px">
                                Select Date <input type="date" name="att_date" id="att_date">
                                <input type="submit" name="search" value="Search">
                            </div>
                        </div>
                    </form>
                    <div>
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Signed In</th>
                                    <th>Signed Out</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($emprow['emp_role'] == "Admin") {
                                    $result=$obatt->viewDayAttendance($date);
                                }else {
                                    $deptId = $emprow['dept_id'];
                                    $result=$obatt->viewDeptDayAttendance($date, $deptId);
                                }
                                while ($att_all=$result->fetch(PDO::FETCH_BOTH)){
    //                                var_dump($att_all);
                                    ?>
                                <tr>
                                    <td><?php echo $att_all['emp_id']; ?></td>
                                    <td><?php echo $att_all['emp_fname'].' '.$att_all['emp_lname']; ?></td>
                                    <td><?php echo $att_all['attendance_in_date']." ".$att_all['attendance_in_time']; ?></td>
                                    <td><?php echo $att_all['attendance_out_date']." ".$att_all['attendance_out_time']; ?></td>
                                    <td><?php echo $att_all['attendance_status']; ?></td>
                                    <td>
                                        <a href="../controller/controller_attendance.php?action=view_attendance&emp_id=<?php echo $att_all['emp_id']; ?>">
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
    <script type="text/javascript">
        function isEmpty(){
            if (document.forms['att'].att_date.value=="") {
                alert("Please Select a Date");
                return false;
            }
            return true;
        }
    </script>
</html>