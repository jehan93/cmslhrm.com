<?php 
date_default_timezone_set('Asia/Colombo');
include '../config/dbconnection.php';
include '../model/model_attendance.php';
include '../template/dateTime.php';

$obEmpTime=new model_attendance();

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
            <?php include '../template/header2.php';?>
            <div style="font-size: x-large; text-align: right; padding-right: 10"><a href="login.php"> Login <div class="glyphicon glyphicon-log-in"></div></a></div>
            <div id="content" class="container">
                <div class="row">
                    <div class="col-md-12 textalc text-uppercase "><h2>Staff Attendance</h2></div>
                </div>
                <div class="row">
                    <h3><div class="col-md-12" id="timer" style="text-align: center"></div></h3>
                </div>
                <br/>
                <form name="att_add" method="post" action="../controller/controller_attendance_1_1.php?action=attendance" onsubmit="return isEmpty();">
                    <div class="clearfix">&nbsp;</div>                    
                    <div class="row">
                    <div class="col-md-4 text-right"><h4>Enter Staff ID No.</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="emp_id" id="emp_id" type="text"/>
                    </div>
                    <div class="col-md-2">
                        <?php
                        
                        $hour = date('H', time());       
                        if ($hour<12) {$btn_value = "Sign In";} 
                        else {$btn_value = "Sign Out";}
                        
                        ?>
                        <input class="form-control btn-primary" style="font-size: large" name="attendance_mark" id="attendance_mark" type="submit" value="<?php echo $btn_value; ?>" />
                    </div>
                    </div>
                </form>
                <?php
                include '../template/messagebox.php';
        
                if (isset($_REQUEST['emp_id'])) {
                            $emp_id=$_REQUEST['emp_id'];
                            $att_id=$_REQUEST['att_id'];
                            $rowEmpTime=$obEmpTime->checkEmpAttendance($emp_id,$att_id)->fetch(PDO::FETCH_BOTH);
                ?>
                <form name="att_result" method="get">
                    <div class="clearfix">&nbsp;</div>                    
                    <div class="row bborder">
                        <div class="col-md-4 text-right"><h4>Name of Staff</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="result_emp_name" id="result_emp_name" readonly value="<?php echo $rowEmpTime['emp_fname']." ".$rowEmpTime['emp_lname']?>"/>
                    </div>
                    </div>
                    <div class="row bborder">
                        <div class="col-md-4 text-right"><h4>In Time</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="result_in_time" id="result_in_time" readonly value="<?php echo $rowEmpTime['attendance_in_date']." ".$rowEmpTime['attendance_in_time'] ?>"/>
                    </div>
                    </div>
                    <div class="row bborder">
                        <div class="col-md-4 text-right"><h4>Out Time</h4></div>
                    <div class="col-md-4">
                        <input class="form-control" name="result_out_time" id="result_out_time" readonly value="<?php echo $rowEmpTime['attendance_out_date']." ".$rowEmpTime['attendance_out_time']?>"/>
                    </div>
                    </div>
                </form>   
                        <?php 
                        $secondsWait = 5;
                        header("Refresh:$secondsWait,attendance_add.php");
                        }
                        ?>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
    <script type="text/javascript">
            function isEmpty(){
                if (document.forms['att_add'].emp_id.value=="") {
    alert("Please Enter your Staff ID No.");
    return false;
}
return true;
                }
                
$(document).ready(function() {
    function update() {
      $.ajax({
       type: 'POST',
       url: '../template/dateTime.php?action=view_datatime',
       timeout: 1000,
       success: function(data) {
          $("#timer").html(data); 
          window.setTimeout(update, 1000);
       }
      });
     }
     update();
});
            
    </script>
</html>
