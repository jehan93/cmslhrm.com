<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../restrictedAccess/all_restricted.php';

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
                        <div class="col-md-12 textalc text-uppercase"><h2>Add New Department</h2></div>
                    </div>
                        <?php include '../template/messagebox.php'; ?>
                    <div class="row">
                        <div class="col-md-4">&nbsp;</div>
                        <div class="col-md-4">
                            <form name="department_add" method="post" action="../controller/controller_department.php?action=addDepartment">
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-12"><h4>Enter New Department Name</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="dept_name" id="dept_name" type="text" placeholder="Enter New Department Name"/>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6"><input class="btn btn-success btn-block" value="Add" type="submit"/></div>
                                    <div class="col-md-6"><input class="btn btn-primary btn-block" value="Clear" type="reset"/></div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>