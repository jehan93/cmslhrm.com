<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_leave.php';

//$leaveId = $_SESSION['leaveId'];
//unset($_SESSION['leaveId']);
$leaveId = $_GET['leaveId'];
$role = $emprow['emp_role'];
$approverEmpId = $emprow['login_emp_id'];
//echo $leaveId;
$obleave=new model_leave();
$resultLeaveType = $obleave->viewLeaveType("Approver");
$resultLEaveDetails = $obleave->viewLeaveDetails($leaveId);
$leaveDetails = $resultLEaveDetails->fetch();
$leave_type_id = $leaveDetails['leave_type_id'];
$leaveEmpId = $leaveDetails['emp_id'];
$leaveStatus = $leaveDetails['leave_status'];
$deptId = $_GET['deptId'];
//var_dump($leaveDetails);
$year = date('%Y%');
$resultDeptLeave = $obleave->viewDeptLeave($deptId, $year);
//echo $leaveEmpId;
var_dump($leaveDetails);
?>

<html>
    <head>
        <title>View Leave</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div id="content" class="col-md-9">
                    <div class="row"><div class="col-md-12 textalc text-uppercase" style="padding-bottom: 50px"><h2>View Leave</h2></div></div>
                          
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo '<p style="font-size: 20px"><b style="font-size: 21px">'.'Name of Employee : '.'</b>'.$leaveDetails['emp_fname'].' '.$leaveDetails['emp_lname'].'</p>'; ?>
                            <?php echo '<p style="font-size: 20px"><b style="font-size: 21px">'.'Applied Date : '.'</b>'.$leaveDetails['leave_applied_date'].'</p>'; ?>
                            <?php if ($leaveStatus=='Manager Approved') {
                                echo '<p style="font-size: 20px"><b style="font-size: 21px">'.'Manager Approved : '.'</b>'.$leaveDetails['LS_updated_on'].'</p>';}?>
                            <br/>
                            <!--<form method="post" action="../controller/controller_leave.php?action=updateLeave&leave_id=<?php echo $leaveId?>&leave_type_id=<?php echo $leave_type_id ?>">-->
                            <form method="post" id="form_leave_approve" name="form_leave_approve">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-5"><h4>From</h4></div>
                                            <div class="col-md-5"><h4>To</h4></div>
                                            <div class="col-md-2"><h4>Day(s)</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input class="form-control" type="date" name="leave_from_date" id="leave_from_date" readonly value="<?php echo $leaveDetails['leave_from'] ?>"/>
                                            </div>
                                            <div class="col-md-5">
                                                <input class="form-control" type="date" name="leave_to_date" id="leave_to_date" readonly value="<?php echo $leaveDetails['leave_to'] ?>"/>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control" type="text" name="leave_days" id="leave_days" readonly value="<?php echo $leaveDetails['leave_days'] ?>"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row ">
                                            <div class="col-md-10"><h4>Leave Type</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?php if ($leaveDetails['leave_days']<1) {
                                                    echo '<input type="text" id="leaveDayType" name="leaveDayType" class="form-control" readonly value="Half Day"/>';
                                                }else{
                                                    echo '<input type="text" id="leaveDayType" name="leaveDayType" class="form-control" readonly value="Full Day"/>';
                                                } ?>
                                                </div>
                                            <div class="col-md-3">
                                                <input class="form-control" type="text" name="leaveType" id="leaveType" readonly value="<?php echo $leaveDetails['leave_type'] ?>"/>
                                            </div>
                                            <div class="col-md-6">
                                                <select id="newLeaveType" class="form-control">
                                                    <option value="0">Change Leave Type</option> 
                                                    
                                                    <?php while ($leaveRow = $resultLeaveType->fetch(PDO::FETCH_BOTH)){
                                                    echo '<option value="'.$leaveRow['leave_type_id'].'">'.$leaveRow['leave_type'].'</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        
                                        <div class="row">
                                            <div class="col-md-12"><h4>Reason</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea rows="1" name="reason" id="reason" class="form form-control" readonly></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12"><h4>Comment</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea rows="2" name="comment" id="comment" class="form form-control"></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="form-control btn btn-success" id="btn_approve">Approve</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="form-control btn btn-danger" id="btn_reject">Reject</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            <div class="clearfix">&nbsp;</div>
                        </div>
                        <div class="col-md-1">&nbsp;</div>
                        <div class="col-md-5">
                            <div class="row" >
                                <p><b style="font-size: 18px">Leave Summary of Employee</b></p>
                                <div class="col-md-12" id="leaveSummaryTable">
                                    <?php include '../view/leave_table_summary.php'; ?>
                                </div>
                            </div>
                            <div class="row">
                                <p style="padding-top: 50px"><b style="font-size: 18px;">Other Employees who have applied for leave the same day</b></p>
                                <div class="col-md-12" id="otherEmpLeave" style="text-align: center; font-size: large; color: red; font-weight: bold">
                                    <table id="tb_otherEmpLeave"class="table table-bordered" style="font-size: small;">
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Leave Status</th>
                                            <th>Leave Date</th>
                                        </tr>
                                        <?php while ($deptLeaveDetails = $resultDeptLeave->fetch()){
                                            $deptLeaveFromDate = $deptLeaveDetails['leave_from'];
                                            $deptLeaveToDate = $deptLeaveDetails['leave_to'];
                                            $deptLeaveId = $deptLeaveDetails['leave_id'];
                                            $deptLeaveToDate = $deptLeaveDetails['leave_to'];
                                            $leaveDateFrom = $leaveDetails['leave_from'];
                                            $leaveDateTo = $leaveDetails['leave_to'];
        //                                    var_dump($deptLeaveDetails);
        //                                    echo $fromDate;
        //                                    echo '<br/>';
        //                                    echo $toDate;
        //                                    echo '<br/>';
        //                                    echo $leaveDate;
        //                                    echo '<br/>';
                                            if (($leaveDateFrom<=$deptLeaveToDate && $leaveDateFrom>=$deptLeaveFromDate && $deptLeaveId!=$leaveId) || ($leaveDateTo<=$deptLeaveToDate && $leaveDateTo>=$deptLeaveFromDate && $deptLeaveId!=$leaveId)) {
                                                echo "<tr>";
        //                                    echo '<br/>';
                                                echo "<td>".$deptLeaveDetails['emp_fname']." ".$deptLeaveDetails['emp_lname']."</td>";
                                                echo "<td>".$deptLeaveDetails['leave_status']."</td>";
                                                if ($deptLeaveFromDate==$deptLeaveToDate) {
                                                    echo "<td>".$deptLeaveFromDate."</td>";
                                                }else{
                                                    echo "<td>".$deptLeaveFromDate." to ".$deptLeaveToDate."</td>";
                                                }
                                                echo "</tr>"; 
                                            }
        //                                    else{
        ////                                        echo "<tr><td colspan='3'>No Data to Display</td></tr>"; 
        //                                    }
                                        }?>
                                    </table>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script type="text/javascript">
    var tableRow = document.getElementById('otherEmpLeave');
    var tableRowVal = document.getElementById('tb_otherEmpLeave').rows.length;
    var btn_approve = $('#btn_approve');
    var btn_reject = $('#btn_reject');
    var form_leave_approve = $('#form_leave_approve');
    
    var role = "<?php echo $role ?>";
    
    var leave_id = "<?php echo $leaveId ?>";
    var emp_id = "<?php echo $approverEmpId ?>";
    var leave_status = "";
    var leave_type_id = "<?php echo $leaveDetails['leave_type_id'] ?>";
    var leave_comment = $('#comment').val();
    var e = document.getElementById('newLeaveType');

        
    $(document).ready(function () {
        ;
        
        if (tableRowVal==1) {
            tableRow.innerHTML = "There are NO data to display.";
        }
        
        btn_approve.click(function(){
            
            event.preventDefault();
            if (role=='Manager') {
                leave_status = 'Manager Approved';
            }else if (role=='Department Head') {
                leave_status = 'Approved';
            }
            updateLeave();
        });
        
        btn_reject.click(function(){
            event.preventDefault();
            if (role=='Manager') {
                leave_status = 'Manager Rejected';
            }else if (role=='Department Head') {
                leave_status = 'Rejected';
            }
            updateLeave();
        });
        
        function updateLeave(){
            var leave_type_id_new = e.options[e.selectedIndex].value;
//            alert(leave_type_id_new+', '+leave_id+', '+emp_id+', '+leave_type_id);
            if (leave_type_id_new!=0 && (leave_status=='Approved' || leave_status=='Manager Approved')) {
                leave_type = leave_type_id_new;
            }else {
                leave_type = leave_type_id;
            } 
//            alert(leave_status+' Update Leave '+leave_type);
            
            if(confirm('Do you want to approve this leaves?')==true){
                $.ajax({
                    url:"../controller/controller_leave.php?action=updateLeave",
                    method:"POST",
                    data:{leave_id:leave_id,
                        leave_status:leave_status,
                        leave_type:leave_type,
                        emp_id:emp_id,
                        leave_comment:leave_comment},
                    success:function(data){
                        alert(data);
                        window.location.href = "../view/leave_approve.php";
                    } 
                });
            }  
        };
    });
    
    
    
    
</script>    

<!--<script>
    var coverEmpHead = document.getElementById('coverEmpHead');
    var coverEmpRow = document.getElementById('coverEmpRow');
    var leaveDayType = $('#leaveDayType');
    var fromDate = $('#leave_from_date');
    var toDate = $('#leave_to_date');
    var currentDate = $('#current_date');
    var leaveType = $('#leaveType');
    
    function isEmpty(){
        if (leaveDayType.val()==""){
            alert ("Please Select either Full Day of Half Day");
            return false;
        }
        if (leaveType.val()==""){
            alert ("Please Select Leave Type");
            return false;
        }
        if (fromDate.val()==""){
            alert ("Please Select From Date");
            return false;
        }
        if (toDate.val()==""){
            alert ("Please Select To Date");
            return false;
        }
//        if (fromDate.val()==toDate.val()){
//                    var r = confirm("Do you Want to Apply for "+leaveType.val()+" Leave on "+toDate.val());
//                } else if(fromDate.val()!=toDate.val() && fromDate.val()!= "" && toDate.val()==""){
//                    var r = confirm("Do you Want to Apply for "+leaveType.val()+" Leave from "+fromDate.val()+" to "+toDate.val());
//                }
//                if(r){
//                    return true;
//                }
//                else{
//                    return false;
//                }
var r = confirm("Do you Want to Apply for "+leaveType.val()+" Leave on "+toDate.val());
if(r){
                    return true;
                }
                else{
                    return false;
                }

    }
        
    $(document).ready(function(){ 
    fromDate.change(function(){
        if (leaveDayType.val()=="Half Day") {
            toDate.val(fromDate.val());
        }else{
            toDate.val();
        }
        if (fromDate.val()>currentDate.val()) {
            coverEmpHead.style.display="block";
            coverEmpRow.style.display="block";
        }else{
            coverEmpHead.style.display="none";
            coverEmpRow.style.display="none";
    }
    });
    
    toDate.change(function(){
        if (toDate.val()<fromDate.val()) {
            alert ('To date cannot be less than From date');
            toDate.val('');
//            return false;
        }
    });
    
    leaveDayType.change(function(){
        if (leaveDayType.val()=="Half Day") {
            toDate.prop('readonly',true);
            toDate.val(fromDate.val());
        }else{
            toDate.prop('readonly',false);
            toDate.val('');
        }
    });
    
    leaveType.change(function(){
        $.ajax({
            url:'../controller/controller_leave.php?action=leaveBalance',
            method:'POST',
            data:{leaveType:leaveType.val()},
            success:function(data){
                $('#leave_balance').val(data);
            }
        });
    });
});
</script>-->