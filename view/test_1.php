<?php

$firstRowHead="Total Leaves Taken";
$lastRowHead="Leave Balance";
$leaveTypeArray=array("","Annual","Casual","Sick","Study");
$leaveStatusArray=array($firstRowHead,"Approved","Pending","Cancelled",$lastRowHead);

switch ($leaveBalTable){
    case "Full":
?>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
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
            for ($x=0;$x<=4;$x=$x+1){
                echo "<tr>";
                echo "<td>".$leaveStatusArray[$x]."</td>";
                for ($y=1;$y<=4;$y++){
                    $leaveType=$leaveTypeArray[$y];
                    $leaveStatue=$leaveStatusArray[$x];
                    $resultType=$obleave->viewEmpLeaveByType($empId, $leaveType);
                    $resultStatus=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveType, $leaveStatue);
                    if ($leaveStatue==$firstRowHead) {
                        echo "<td align='middle'>".$resultType->rowCount()."</td>";
                    } else if ($leaveStatue==$lastRowHead) {
                        switch ($leaveType){
                            case "Annual":$leaveTot=14;break;
                            case "Casual":$leaveTot=7;break;
                            case "Sick":$leaveTot=14;break;
                            default :$leaveTot=0;break;
                        }
                        $leaveBal=($resultType->rowCount())-$leaveTot;
                        echo "<td align='middle'>".abs($leaveBal)."</td>";
                    }else {
                        echo "<td align='middle'>".$resultStatus->rowCount()."<br/>"."</td>";
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
                    $resultType=$obleave->viewEmpLeaveByType($empId, $leaveType);
                    $resultStatus=$obleave->viewEmpLeaveByTypeAndStatus($empId, $leaveType, $leaveStatue);
                    if ($leaveStatue==$firstRowHead) {
                        echo "<td align='middle'>".$resultType->rowCount()."</td>";
                    } else if ($leaveStatue==$lastRowHead) {
                        switch ($leaveType){
                            case "Annual":$leaveTot=14;break;
                            case "Casual":$leaveTot=7;break;
                            case "Sick":$leaveTot=14;break;
                            default :$leaveTot=0;break;
                        }
                        $leaveBal=($resultType->rowCount())-$leaveTot;
                        echo "<td align='middle'>".abs($leaveBal)."</td>";
                    }else {
                    }  
                }
                echo "</tr>";
            }
            ?>
    </tbody>
</table>
                             
    <?php ;break;}?>