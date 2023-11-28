<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_leave.php';
include '../model/model_employee.php';
include '../model/model_department.php';
include '../template/dateTime.php';

$empId=$emprow['emp_id'];
var_dump($emprow);
$obemp=new model_employee();
$resultEmp=$obemp->viewAllEmployee();
$empType=$emprow['emp_status'];
//$empType=$obemp->viewNewEmpDetails($empId)->fetch(PDO::FETCH_BOTH)['emp_status'];
$emprowCount = count($emprow);
//echo $emprowCount;
$deptId=$emprow['dept_id'];
$deptHeadId=$emprow['dept_head_emp_id'];
//$deptId=$obemp->viewEmpDeptDetails($empId)->fetch(PDO::FETCH_BOTH)['dept_id'];

//var_dump($deptId);
$obleave=new model_leave();
$resultLeaveType = $obleave->viewLeaveType($empType);

$obdept = new model_department();
$resultDeptEmp = $obdept->viewDepartmentEmployees($deptId);

?>

<html>
    <head>
        <title>CMSL - HRM System</title>
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
                    <div class="row"><div class="col-md-12 textalc text-uppercase "><h2>Apply Leave</h2></div></div>
                        <?php include '../template/messagebox.php'; ?>
                    <div class="alert alert-danger col-md-12 msgboxtext" id="msgd_refresh" style="display: none"></div>
<!--                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8"><?php $leaveBalTable="Summary"; include '../view/leave_table_1.php'; ?></div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-3">&nbsp;</div>
                        <div class="col-md-6">
                            <form method="post" id="form_apply_leave" name="form_apply_leave">
                            <!--<form method="post" action="" onsubmit="return isEmpty()">-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row ">
                                            <div class="col-md-10"><h4>Leave Type</h4></div>
                                            <div class="col-md-2"><h4>Balance</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <select id="leaveDayType" name="leaveDayType" class="form-control">    
                                                    <option value="">Select</option>
                                                    <option value="Full Day" <?php if (isset($_POST['submit'])) {
                                                        echo "Selected";} ?>>Full Day</option>
                                                    <option value="Half Day">Half Day</option>
                                                    <!--<option value="Short Leave">Short Leave</option>-->
                                                </select>
                                            </div>
                                            <div class="col-md-5">
                                                <select id="leaveType" name="leaveType" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <?php while ($leaveRow = $resultLeaveType->fetch(PDO::FETCH_BOTH)){
                                                    echo '<option value="'.$leaveRow['leave_type_id'].'">'.$leaveRow['leave_type'].'</option>';
                                                
                                                    } ?>
                                                    <!--<option value="Annual">Annual</option>-->
                                                    <!--<option value="Casual">Casual</option>-->
                                                    <!--<option value="Sick">Sick</option>-->
                                                    <!--<option value="Short Leave">Short Leave</option>-->
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <input class="form-control" type="text" id="leave_balance" readonly="readonly"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-6"><h4>From</h4></div>
                                            <div class="col-md-6"><h4>To</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="form-control" type="date" name="leave_from_date" id="leave_from_date"/>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" type="date" name="leave_to_date" id="leave_to_date"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="row">
                                            <div class="col-md-12"><h4>Reason</h4></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea rows="3" name="reason" id="reason" class="form form-control"><?php if (isset($_POST['reason'])){ echo $_POST['reason']; } ?></textarea>
                                            </div>
                                        </div>
                                        <br/>
                                        <div id="coverEmpHead" class="row" style="display: none">
                                            <div class="col-md-12"><h4>Employee Who is Going to Cover for You</h4></div>
                                        </div>
                                        <div class="row" id="coverEmpRow" style="display: none">
                                            <div class="col-md-12">
                                                <select class="form-control" name="coverEmp_id" id="coverEmp_id">
                                                    <option value="">Select Employee</option>
                                                    <?php
                                                    while ($emprow=$resultDeptEmp->fetch(PDO::FETCH_BOTH)){
                                                        echo "<option value=".$emprow['emp_id'].">".$emprow['emp_fname']." ".$emprow['emp_lname']."</option>";
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input class="btn btn-success form-control btn_apply" value="Apply" type="button"/>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="btn btn-warning form-control" value="Clear" type="reset"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix">&nbsp;</div>
                            <div class="row">
                                <div class="col-md-12">
                                    <P style="text-align: justify"><h4 style="color: red">Note : </h4>Please try and avoid selecting leave dates through weekends.<br>
                                    Eg: If you applying leave on Friday and the following Monday, instead of applying it together kindly apply for them separately (One request for Friday and another for Monday.).</p>
                                    <input class="form-control" type="date" id="current_date" value="<?php echo $date ?>" style="visibility: hidden" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>
    var coverEmpHead = document.getElementById('coverEmpHead');
    var coverEmpRow = document.getElementById('coverEmpRow');
    var leaveDayType = $('#leaveDayType');
    var fromDate = $('#leave_from_date');
    var toDate = $('#leave_to_date');
    var currentDate = $('#current_date');
    var leaveType = $('#leaveType');
    var form_apply_leave = $('#form_apply_leave');
    
//    function isEmpty(){
//        
////        if (fromDate.val()==toDate.val()){
////                    var r = confirm("Do you Want to Apply for "+leaveType.val()+" Leave on "+toDate.val());
////                } else if(fromDate.val()!=toDate.val() && fromDate.val()!= "" && toDate.val()==""){
////                    var r = confirm("Do you Want to Apply for "+leaveType.val()+" Leave from "+fromDate.val()+" to "+toDate.val());
////                }
////                if(r){
////                    return true;
////                }
////                else{
////                    return false;
////                }
//var e = e.getElementById('leaveType');
//        var text = e[e.selectedIndex].text;
//var r = confirm("Do you Want to Apply for Leave on "+toDate.val());
//if(r){
//                    return true;
//                }
//                else{
//                    return false;
//                }
//
//    }
        
    $(document).ready(function(){
        $(document).on('click','.btn_apply',function(){
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
            var e = document.getElementById('leaveType');
            var text = e[e.selectedIndex].text;
            if (fromDate.val()==toDate.val()) {
                var date = "on "+toDate.val();
            }else if (fromDate.val()<toDate.val()) {
                var date = "from "+fromDate.val()+" to "+toDate.val();
            }

            
            if (confirm("Do you Want to Apply for "+text+" Leave "+date)==true) {
                $.ajax({
                    url:'../controller/controller_leave.php?action=applyLeave',
                    method:'POST',
                    data:form_apply_leave.serialize(),
                    success:function(data){
                        alert(data);
                    }
                });
            }else{
                return false;
            }
        });
        
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
</script>