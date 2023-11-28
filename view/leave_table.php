<?php

$firstRowHead="Total Leaves Taken";
$lastRowHead="Leave Balance";
$leaveTypeArray=array("",5,6,7,"Study");
$leaveStatusArray=array($firstRowHead,"Approved","Pending","Rejected","Cancelled",$lastRowHead);
var_dump($leaveStatusArray);
switch ($leaveBalTable){
    case "Full":
?>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<style>
    table td:empty::before{content:"0"};
    table td:invalid::before{content: "A"}    
</style>
<table class="table table-bordered table-condensed table-striped" style="font-size:x-small">
    <thead>
        <tr>
            <th><?php echo $leaveTypeArray[0]; ?></th>
            <th><?php echo $leaveTypeArray[1]; ?></th>
            <th><?php echo $leaveTypeArray[2]; ?></th>
            <th><?php echo $leaveTypeArray[3]; ?></th>
            <th><?php echo $leaveTypeArray[4]; ?></th> 
        </tr>
    </thead>
    <tbody>
        <?php
            for ($x=0;$x<=5;$x=$x+1){
                echo "<tr>";
                echo "<td>".$leaveStatusArray[$x]."</td>";
                for ($y=1;$y<=4;$y++){
                    $leaveType=$leaveTypeArray[$y];
                    $leaveStatue=$leaveStatusArray[$x];
                    $year= date('%Y%');
                    $resultType=$obleave->viewEmpLeaveAppliedDays ($empId,$leaveType, $year)->fetch(PDO::FETCH_BOTH)['SUM(leave_days)'];
                    $resultStatus=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveType, $leaveStatue)->fetch(PDO::FETCH_BOTH)['SUM(leave_days)'];
                    if ($leaveStatue==$firstRowHead) {
                        echo "<td align='middle'>".$resultType."</td>";
                    } else if ($leaveStatue==$lastRowHead) {
                        switch ($leaveType){
                            case "5":$leaveTot=14;break;
                            case "6":$leaveTot=7;break;
                            case "7":$leaveTot=14;break;
                            default :$leaveTot="";break;
                        }
                        if ($leaveTot<>"") {
                            $leaveBal=($resultType)-$leaveTot;
                            echo "<td align='middle'>".abs($leaveBal)."</td>";
                        }
                    }else {
                        echo "<td align='middle'>".$resultStatus."<br/>"."</td>";
                    }  
                }
                echo "</tr>";
            }
            ?>
    </tbody>
</table>
<?php ;break;
    case "Summary": ?>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<style>
    table td:empty::before{content:"0"};
</style>
<table class="table table-bordered table-condensed table-striped" style="font-size:small">
    <thead>
        <tr>
            <th><?php echo $leaveTypeArray[0]; ?></th>
            <th><?php echo $leaveTypeArray[1]; ?></th>
            <th><?php echo $leaveTypeArray[2]; ?></th>
            <th><?php echo $leaveTypeArray[3]; ?></th>
            <th><?php echo $leaveTypeArray[4]; ?></th> 
        </tr>
    </thead>
    <tbody>
        <?php
            for ($x=0;$x<=4;$x=$x+4){
                echo "<tr>";
                echo "<td>".$leaveStatusArray[$x]."</td>";
                for ($y=1;$y<=4;$y++){
                    $leaveType=$leaveTypeArray[$y];
                    $leaveStatue=$leaveStatusArray[$x];
                    $resultType=$obleave->viewEmpLeaveByType($empId, $leaveType)->fetch(PDO::FETCH_BOTH)['SUM(leave_days)'];
                    $resultStatus=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveType, $leaveStatue)->fetch(PDO::FETCH_BOTH)['SUM(leave_days)'];
                    if ($leaveStatue==$firstRowHead) {
                        echo "<td align='middle'>".$resultType."</td>";
                    } else if ($leaveStatue==$lastRowHead) {
                        switch ($leaveType){
                            case "Annual":$leaveTot=14;break;
                            case "Casual":$leaveTot=7;break;
                            case "Sick":$leaveTot=14;break;
                            default :$leaveTot="";break;
                        }
                        if ($leaveTot<>"") {
                            $leaveBal=($resultType)-$leaveTot;
                            echo "<td align='middle'>".abs($leaveBal)."</td>";
                        }
                    }else {
                    }  
                }
                echo "</tr>";
            }
            ?>
    </tbody>
</table>
                             
    <?php ;break;}?>