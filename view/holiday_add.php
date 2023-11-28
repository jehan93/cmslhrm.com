<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../template/dateTime.php';
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
                        <div class="col-md-12 textalc text-uppercase"><h2>Add Holidays</h2></div>
                    </div>
                        <?php include '../template/messagebox.php'; ?>
                    <div class="row">
                        <div class="col-md-4 clearfix">&nbsp;</div>
                        <div class="col-md-4">
                            <form name="holiday_add" method="post" action="../controller/controller_holiday.php?action=addHoliday" >
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-12"><h4>Select Holiday Date</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="holi_date" id="holi_date" type="date"/>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>                    
                                <div class="row">
                                    <div class="col-md-12"><h4>Enter Holiday Name</h4></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="holi_name" id="holi_name" type="text"/>
                                    </div>
                                </div>
                                <div class="clearfix">&nbsp;</div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Add" type="submit"/>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="btn btn-primary btn-block" value="Reset" type="reset"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 clearfix">
                            <div class="row">
                                <button class="btn btn-primary" name="btn_import" id="btn_import" style="position: absolute; right: 5px">Import Holidays</button>
                                                       </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                $('form').submit(function(){
                    var holi_name=$('#holi_name').val();
                }
                if(holi_name==""){
                    document.getElementById('error').text("First name can't be blank");
                }
                $('#holi_name').focus();
                return false;
                
                var btn_import = document.getElementById('btn_import');
            }
        </script>
    </body>
</html>