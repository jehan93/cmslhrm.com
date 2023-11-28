<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_employee.php';
$obemp=new model_employee();

?>
<html>
    <head>
        <title>CMSL - HRM System</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/layout.css" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"/>-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body id="body">
        <div id="main">
            <?php include '../template/header.php';?>
                <div class="row">
                    <?php include '../template/navigation.php' ?>
                    <div class="col-md-9" id="content">
                        <div class="row">
                            <h2><div class="col-md-12" id="timer"></div></h2>
                        </div>
                        <div style="height: 50px">&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <!--Information BOxes-->
                                <?php include "../view/dashboard_info_box.php" ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php include '../template/footer.php';?>
        </div>   
    </body>
    
</html>

<script>

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