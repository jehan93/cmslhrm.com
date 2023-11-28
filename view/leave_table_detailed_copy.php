<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include "../model/model_leave.php";

$empId=$emprow['emp_id'];
$empType=$emprow['emp_status'];
$obleave = new model_leave();
$resultLeave = $obleave->viewLeaveType($empType);
$output="";

$leaveTypeArray = array(); // X axis
$leaveTypeIdArray = array(); // X axis
$leaveStatusArray = array("Leave Taken","Pending","Approved","Rejected","Cancelled","Leave Balance"); // Y axis
$leaveAllotedArray = array();
while($array=$resultLeave->fetch()){
    array_push($leaveTypeArray, $array['leave_type']);
    array_push($leaveTypeIdArray, $array['leave_type_id']);
    array_push($leaveAllotedArray, $array['leave_type_limit']);
}
array_push($leaveTypeArray, "Study");
    array_push($leaveTypeIdArray, 10);
    array_push($leaveAllotedArray,"");

    
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
                            <table class="table table-striped table-bordered table-condensed" text-align: center" >                
                                <thead>
                                    <tr>                        
                                        <th>&nbsp;</th>
                                            <?php for($x=0; $x<=(count($leaveTypeArray)-1); $x++){
                                                echo "<th style='vertical-align: top;text-align: center'>".$leaveTypeArray[$x]."<br/>".number_format((float)$leaveAllotedArray[$x],'1', '.', '')."</th>";
                                            }?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($y=0; $y<=(count($leaveStatusArray)-1); $y++){
                                        echo "<tr>";
                                        echo "<th>".$leaveStatusArray[$y]."</th>";
                                        for($x=0; $x<=(count($leaveTypeIdArray)-1); $x++){
                                            $year = date('%2019%');
                                            $empFullLeaveDetails=$obleave->viewEmpLeaveByTypeStatusYear($empId, $leaveTypeIdArray[$x], $leaveStatusArray[$y], $year)->fetch(PDO::FETCH_BOTH);
                                            $empAppliedLeaveDetails = $obleave->viewEmpLeaveAppliedByYear($empId, $leaveTypeIdArray[$x], $year)->fetch(PDO::FETCH_BOTH);
//                                            if ($leaveStatusArray[$y]=="Alloted Leave") {
//                                                for($x=0; $x<=(count($leaveAllotedArray)-1); $x++){
//                                                    echo "<td>".$leaveAllotedArray[$x]."</td>";}
//                                            }
//                                            else
                                            if ($leaveStatusArray[$y]=="Leave Taken") {
                                                $appliedLeave = $empAppliedLeaveDetails['SUM(leave_days)'];
                                                echo "<td>".$appliedLeave."</td>";
                                            }
                                            elseif ($leaveStatusArray[$y]=="Leave Balance") {
                                                $appliedLeave = $empAppliedLeaveDetails['SUM(leave_days)'];
                                                $allotedLeave = $leaveAllotedArray[$x];
                                                if ($leaveTypeArray[$x]=="Study") {
                                                    echo "<td></td>";
                                                } else {
                                                    $leaveBalance = $allotedLeave - $appliedLeave;
                                                    echo "<td>".number_format((float)$leaveBalance, 1, '.', '')."</td>";
                                                }
                                            }else{
                                                echo "<td>".$empFullLeaveDetails['SUM(leave_days)']."</td>";
                                            }}
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