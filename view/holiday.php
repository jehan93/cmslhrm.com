<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../template/dateTime.php';
include '../model/model_holiday.php';

$obholiday=new model_holiday();
$rowno=1;
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
                    <h2><div class="col-md-12 textalc text-uppercase" id="title">Holidays - 
                        <?php 
                        if (isset($_POST['search'])) {
                            echo $_POST['hd_year'];
                        }
                        ?>
                        </div></h2>
                </div>
                    <br/><br/>
                <form id="holiday_view" name="holiday_view" method="post" >
                    <div class="row">
                        <div class="col-md-2" style="text-align: right">
                            <h4><b>Select Year :   </b></h4>
                        </div>
                        <div class="col-md-2" style="margin: 0px; padding: 0px">
                            <select name="hd_year" id="hd_year" class="form-control">
                                <option value="">Select Year</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                        <div class="col-md-3" style="margin: 0px; padding: 0px">
                            <button class="btn btn-primary"id="search" name="search">Search</button>
                        </div>
                        <div class="col-md-5" style="text-align: right">
                            <a href="../view/holiday_add.php"><button class="btn btn-primary">Add Holidays</button></a>
                        </div>
                    </div>
                </form>
                
                <div>
                    <table class="table table-bordered table-condensed table-striped">
                        <?php
                            if (isset($_POST['search'])){
                                $hd_year=$_POST['hd_year'];
//                                var_dump($hd_year);
                                $result=$obholiday->viewYearHoliday($hd_year);
                                ?>
                        <thead>
                            <tr>
                                <th width="5%"></th>
                                <th width="35%">Date</th>
                                <th width="60%">Holiday Name</th>
                                <th width="60%">Holiday Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php while ($rowHoliday=$result->fetch(PDO::FETCH_BOTH)){ ?>
                                <td><b><?php echo $rowno++; ?></b></td>
                                <?php $date = date_create($rowHoliday['holidays_date']); ?>
                                <td><?php echo date_format($date,"d-m-Y (l)"); ?></td>
                                <!--<td><?php echo $rowHoliday['holidays_date']; ?></td>-->
                                <td><?php echo $rowHoliday['holidays_name']; ?></td>
                                <td><?php echo $rowHoliday['holidays_type']; ?></td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                        
                    </table>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
    </body>
</html>
<script >//
//$(document).ready(function(){
//    $('#search').click(function(){
//        var year = $('#hd_year').val();
//document.getElementById('title').innerHTML = 'HOLIDAYS - '+year;
//
//    
//    
//    });
//});
</script>