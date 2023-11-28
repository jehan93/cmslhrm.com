<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
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
                <div class="col-md-9" id="content">
                    <div class="row">
                        <div class="col-md-12 textalc text-uppercase" style="padding-bottom: 30px;"><h2>Add Employee Details</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <?php include '../template/messagebox.php'; ?>
                            <table class="table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th><b style="color:red">!!ALERT!! </b>Confirmation</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><br>You can continue to add details of the new employee, or you can skip this and come back later to complete adding the remaining information.</td>
                                    </tr>
                                    <tr>
                                        <td>Do you wish to continue?</td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div class="row">
                                                <div class="col-md-7">&nbsp;</div>
                                                <div class="col-md-5">
                                                    <a href="../view/employees_add_details.php"><button class="btn btn-success">Continue</button></a>
                                                    <a href="../view/dashboard.php"><button class="btn btn-primary">Skip, & add later</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr style="border-top: black solid">
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>