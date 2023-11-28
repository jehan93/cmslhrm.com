<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_leave.php';

$obleave=new model_leave();
//var_dump($emprow);
$empId=$emprow['login_emp_id'];
$result=$obleave->viewEmpLeave($empId);
$currentYear = date('Y');
$leaveTableYear = date('Y');

if( isset($_POST['name']) ){
// echo $_POST['name'];
 $leaveTableYear = $_POST['name'];
 echo $leaveTableYear;
 exit;
} 
//else {
//   $leaveTableYear = date('Y'); 
//   echo $leaveTableYear;
//}

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
                <div class="row ">
                    <div class="col-md-12 textalc text-uppercase"><h2>Leave History</h2></div>
                </div>
                <div class="row" style="min-height: 130px; padding-top: 20px;">
                    <div class="col-md-2 ">
                        <a href="../view/leave_add.php"><button class=" btn btn-primary form-control">Apply for Leave</button></a></div>
                    <div class="col-md-5 ">&nbsp;</div>
                    <div class="col-md-5 ">
                        <h4 class="textalc">
                            Leave Summary for <e id="year"><?php echo $currentYear; ?></e>
                        </h4>
                        <?php include '../view/leave_table_detailed.php';?>
                    </div>
                </div>
                <?php include '../template/messagebox.php'; ?>
                <div class="alert alert-danger col-md-12 msgboxtext" id="msgd_refresh" style="display: none"></div>
                <div class="row">
                    <div class="col-md-12">
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
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
    <script>
    $(document).ready(function(){
        $('#add').click(function(){
            var name = $('#leaveTableYear').val();
 
  

  $.ajax({
      url: 'leave.php',
   type: 'post',
   data: {name: name},
   success: function(response){
   alert(response);
   }
  });
 });
});
    </script>
</html>