<?php 
include '../config/sessionhandling.php';
//include '../config/dbconnection.php';
//include '../model/model_employee.php';
include '../template/dateTime.php';

//$obemp=new model_employee();

$empId_login=$emprow['emp_id'];
$currentYear = date("Y");

?>

<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <!--<script type="text/javascript" src="../JQuery/jquery-3.2.1.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
            <div class="row">
                <?php include '../template/navigation.php'; ?>
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>Add New Employee</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8" id="div_new_emp_details">
                            <?php include '../view/employees_add_basic.php'; ?>
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script>

$(document).ready(function(){
    
});

</script>