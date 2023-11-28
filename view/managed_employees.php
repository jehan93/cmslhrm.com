<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_department.php';

if (isset($_SESSION['managerId'])) {
    $managerId = $_SESSION['managerId'];
    $deptName = $_SESSION['dept_name'];
    $managerName = $_SESSION['managerName'];
    
//unset($_SESSION['managerId']);
//unset($_SESSION['dept_name']);
//unset($_SESSION['managerName']);

}    
$obdept = new model_department();


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
                <div class="col-md-9 container" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase"><h2>Managed Employees</h2></div>
                    </div>
                        <?php include '../template/messagebox.php'; ?>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div class="row">
                        <div class="col-md-12">
                            
                            <?php echo '<p style="font-size: 20px"><b style="font-size: 21px">'.'Name of Manager : '.'</b>'.$managerName.'</p>' ?>
                            <?php echo '<p style="font-size: 20px"><b style="font-size: 21px">'.'Department : '.'</b>'.$deptName.'</p>' ?><br/>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:5%; vertical-align: text-top">Employee ID</th>
                                        <th style="width:20%; vertical-align: text-top">Employee Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result=$obdept->viewManagedEmployees($managerId);
                                    while ($managedEmp=$result->fetch(PDO::FETCH_BOTH)){?>
                                   <tr>
                                        <td><?php echo $managedEmp['emp_id'];?></td>
                                        <td><?php echo $managedEmp['emp_fname']." ".$managedEmp['emp_lname'];?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row textalc">
                            <!--<button type="submit" onclick="history.back();">Back</button>-->
                            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><button class="btn btn-danger">Back</button></a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>