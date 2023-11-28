<?php 
$empId=$emprow['emp_id'];
$empType="Employed";
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
<table class="table table-striped table-bordered table-condensed" style="font-size: x-small; text-align: center" >                
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
                $empFullLeaveDetails=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveTypeIdArray[$x], $leaveStatusArray[$y])->fetch(PDO::FETCH_BOTH);
                $year = date('%Y%');
                $empAppliedLeaveDetails = $obleave->viewEmpLeaveAppliedDays($empId, $leaveTypeIdArray[$x], $year)->fetch(PDO::FETCH_BOTH);
                if ($leaveStatusArray[$y]=="Alloted Leave") {
                    for($x=0; $x<=(count($leaveAllotedArray)-1); $x++){
                        echo "<td>".$leaveAllotedArray[$x]."</td>";}
                }
                elseif ($leaveStatusArray[$y]=="Leave Taken") {
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