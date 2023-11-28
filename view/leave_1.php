<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_leave.php';

$obleave=new model_leave();
//var_dump($emprow);
$empId=$emprow['login_emp_id'];
$result=$obleave->viewEmpLeave($empId);

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
            <div id="content" class="col-md-9">
                <div class="row ">
                    <div class="col-md-12 textalc text-uppercase"><h2>Leave History</h2></div>
                </div>
                <div class="row" style="min-height: 130px; padding-top: 20px;">
                    <div class="col-md-2 ">
                        <a href="../view/leave_add.php"><button class=" btn btn-primary form-control">Apply for Leave</button></a></div>
                    <div class="col-md-6 ">&nbsp;</div>
                    <div class="col-md-4 ">
                        <?php $leaveBalTable="Summary";include './leave_table_1.php';?>
<!--                        <table class="table table-bordered table-condensed table-striped" style="font-size: x-small">
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
                    </table>-->
                    </div>
                </div>
                <div >
                    <table class="table table-bordered table-condensed table-striped" >
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="15%">Date From</th>
                                <th width="15%">Date To</th>
                                <th width="15%">No.of Days</th>
                                <th width="15%">Type of Leave</th>
                                <th width="15%">Status</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $rowno=1;
                            while ($empLeave=$result->fetch(PDO::FETCH_BOTH)){
                                
                                if ($empLeave['leave_status']=='Cancelled'){
                                    $lable="Reapply Leave";
                                    $btnclass="success";
                                    $value="Pending";
                                    $status=1;
                                }else if ($empLeave['leave_status']=='Pending') { 
                                    $lable="Cancel Leave";
                                    $btnclass="danger";
                                    $value="Cancelled";
                                    $status=2;
                                } else {
                                    $lable="";
                                    $btnclass="";
                                    $value="";
                                    $status=0;
                                }
                                ?>
                            <tr>
                                <td class="textalc"><b><?php echo $rowno++; ?></b></td>
                                <td><?php echo $empLeave['leave_from']; ?></td>
                                <td><?php echo $empLeave['leave_to']; ?></td>
                                <td><?php echo $empLeave['leave_days']; ?></td>
                                <td><?php echo $empLeave['leave_type']; ?></td>
                                <td><?php echo $empLeave['leave_status']; ?></td>
                                <td><?php if ($status!=0){ ?>
                                    <a href="../controller/controller_leave.php?action=cancelLeave&leave_id=<?php echo $empLeave['leave_id']; ?>&status=<?php echo $value; ?>">
                                <button type="button" class="btn btn-<?php echo $btnclass; ?>"><?php echo $lable; ?></button></a><?php } ?>
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