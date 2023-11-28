<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_attendance.php';
//include '../model/model_employee.php';
//include '../template/dateTime.php';

$obatt=new model_attendance();
$date=date('Y-m-d');


//$obemp=new model_employee();
//$result=$obemp->viewAllEmployee();
//
$empLoginId=$emprow['emp_id'];
$empRole=$emprow['emp_role'];
//echo $empLoginId;

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
                            <div class="col-md-12 textalc text-uppercase"><h2>View Employee Attendance</h2></div>
                        </div>
                        <form id="att_view" name="att_view" method="post" onsubmit="return isEmpty();">
                            <div class="row" style="padding-bottom: 10Px">
                                <div class="col-md-12" style="padding-top: 15px">
                                    <b><i>From</i> <input type="date" name="att_date_from" id="att_date_from">
                                        <i>To </i><input type="date" name="att_date_to" id="att_date_to">
                                        <input type="submit" name="search" value="Search"></b>
                                </div>
                            </div>
                        </form>
                        <div>
                            <table class="table table-bordered table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th width="15%">Attendance ID</th>
                                        <th width="25%">Name</th>
                                        <th width="20%">Signed In</th>
                                        <th width="20%">Signed Out</th>
                                        <th width="20%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <div style="padding-bottom: 10"></div>
                                    <?php
                                    if (isset($_POST['search'])){
                                        $emp_id=$_GET['emp_id'];
                                        $att_date_from=$_POST['att_date_from'];
                                        
                                        if ($_POST['att_date_to']==0) {
                                            $att_date_to=$date;
                                        }else {
                                            $att_date_to=$_POST['att_date_to'];
                                        }
                                        $result=$obatt->viewEmpAttendanceRange($emp_id, $att_date_from, $att_date_to);
                                        $msg = "From $att_date_from to $att_date_to";
                                        echo "<div class='textalc' style='font-size: larger; padding: 10'><b>$msg </b></div>";
                                        } else{
                                            if (isset($_GET['emp_id'])){
                                                $emp_id=$_GET['emp_id'];
                                                $result=$obatt->viewEmpAllAttendance($emp_id);
                                            }
                                            }
                                            while ($empatt_all=$result->fetch(PDO::FETCH_BOTH)){
//                                                var_dump($empatt_all);
                                                ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $empatt_all['attendance_id']; ?></td>
                                        <td><?php echo $empatt_all['emp_fname'].' '.$empatt_all['emp_lname']; ?></td>
                                        <td><?php echo $empatt_all['attendance_in_date']." ".$empatt_all['attendance_in_time']; ?></td>
                                        <td><?php echo $empatt_all['attendance_out_date']." ".$empatt_all['attendance_out_time']; ?></td>
                                        <td><?php echo $empatt_all['attendance_status']; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row textalc">
                            <?php 
                            if ($empRole=="Admin") { 
                            ?>
                                <a href="../view/attendance_view_emp.php"><button class="btn btn-danger">Back</button></a>
                            <?php
                            } else if ($emp_id != $empLoginId) {
                            ?>
                                <a href="../view/attendance_view_dept.php"><button class="btn btn-danger">Back</button></a>
                            <?php    
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php include '../template/footer.php';?>
        </div>
    </body>
    <script type="text/javascript">
        function isEmpty(){
            if (document.forms['att_view'].att_date_from.value=="") {
                alert("Please Select FROM Date");
                return false;
            }
            return true;
        }    
    </script>
</html>