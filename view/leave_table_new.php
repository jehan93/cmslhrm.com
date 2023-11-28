<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include "../model/model_leave.php";

$empId=$emprow['emp_id'];
$empType="Employed";
$obleave = new model_leave();
$resultLeave = $obleave->viewLeaveType($empType);
$output="";

$leaveTypeArray = array(); // X axis
$leaveTypeIdArray = array(); // X axis
$leaveStatusArray = array("Alloted Leave","Pending","Approved","Rejected","Cancelled","Leave Balance"); // Y axis
$leaveAllotedArray = array();
while($array=$resultLeave->fetch()){
    array_push($leaveTypeArray, $array['leave_type']);
    array_push($leaveTypeIdArray, $array['leave_type_id']);
    array_push($leaveAllotedArray, $array['leave_type_limit']);
}

?>
<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    </head>
    <body id="body">
       <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div id="content" class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <?php for($x=0; $x<=(count($leaveTypeArray)-1); $x++){
                                            echo "<th>".$leaveTypeArray[$x]."</th>";
                                        }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($y=0; $y<=(count($leaveStatusArray)-1); $y++){
                                        echo "<tr>";
                                        echo "<th>".$leaveStatusArray[$y]."</th>";
                                        for($x=0; $x<=(count($leaveTypeIdArray)-1); $x++){
                                            $empFullLeaveDetails=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveTypeIdArray[$x], $leaveStatusArray[$y])->fetch(PDO::FETCH_BOTH);
                                            if ($leaveStatusArray[$y]=="Alloted Leave") {
                                                for($x=0; $x<=(count($leaveAllotedArray)-1); $x++){
                                                    echo "<td>".$leaveAllotedArray[$x]."</td>";
                                                }
                                            }elseif ($leaveStatusArray[$y]=="Leave Balance") {
                                                $year = date('%Y%');
                                                $empAppliedLeaveDetails = $obleave->viewEmpLeaveAppliedDays($empId, $leaveTypeIdArray[$x], $year)->fetch(PDO::FETCH_BOTH);
                                                $appliedLeave = $empAppliedLeaveDetails['SUM(leave_days)'];
                                                $allotedLeave = $leaveAllotedArray[$x];
                                                $leaveBalance = $allotedLeave - $appliedLeave;
                                                echo "<td>".number_format((float)$leaveBalance, 1, '.', '')."</td>";
                                            }else{
                                                echo "<td>".$empFullLeaveDetails['SUM(leave_days)']."</td>";
                                            }
                                        }
                                        echo "</tr>";
                                    }?>                                
                                </tbody>
                            </table>    
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </body>
</html>