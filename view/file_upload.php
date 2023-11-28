<?php 
include '../config/sessionhandling.php';
include '../config/dbconnection.php';
include '../model/model_department.php';
$obdept = new model_department();
$result=$obdept->viewDepartment();
$connect= mysqli_connect('localhost', 'root', '', 'CMSL_HRM');

$filename = $_FILES['file']['name'];

//if (isset($_POST["submit"])) {
//    if ($_FILES['file']['name']) {
//        $filename = $_FILES['file']['name'];
//        $uploadFileName = explode(".", $_FILES['file']['name']);
//        
//        $uploadFileArrayCount = count($uploadFileName);
//        
//        $handle = fopen($_FILES['file']['tmp_name'],"r");
//        $data = fgetcsv($handle);
//        
//        $i=0;
//        while ($data = fgetcsv($handle)){ 
           
        
//        }
////        while(!feof($handle)){
////            $line = fgetcsv($handle);
////            var_dump($line);
////            
//////            var_dump($data);
//////            $i++;
//////            echo $i;
////        }
//    }
//}

//$i=0;
//
//if(isset($_POST["submit"])){
//    if($_FILES['file']['tmp_name']){
//        $filename= explode(".", $_FILES['file']['name']);
//        $arraycount = count($filename);
////        var_dump($filename[$arraycount-1]);
//        
//        if($filename[$arraycount-1]=='csv')
//        {
//            $handle = fopen($_FILES['file']['tmp_name'], "r");
//            while($data = fgetcsv($handle))
//            {
//                if ($i>0) {
//                    
//                
////                var_dump($data[0]);
////                $iteml=mysqli_real_escape_string($connect, $data[0]);
////                $item2=mysqli_real_escape_string($connect, $data[1]);
////                $item3=mysqli_real_escape_string($connect, $data[2]);
//                $sql="INSERT into test(test1,test2,test3) VALUES ('$data[0]','$data[1]','$data[2]')";
//                mysqli_query($connect, $sql);
//                
//                }
//                $i++;
//                
//            }
//            fclose($handle);
//            $msg= $_FILES['file']['name']." Imported Successfully";
//            header("location:../view/file_upload.php?msg=$msg");
//        }else{
//            $msg=$filename[$arraycount-1].". file format not supported. Plesae upload a CSV file.";
//            header("location:../view/file_upload.php?msgd=$msg");
//        }
//        
//    }
//    
//}
//      if (isset($_POST['submit'])) {
//    $i=0; //so we can skip first row
//
//    if (is_uploaded_file($_FILES['file']['tmp_name'])) {
//        echo "<h1>" . "File ". $_FILES['file']['name'] ." uploaded successfully." . "</h1>";
//        echo "<h2>Displaying contents:</h2>";
//        readfile($_FILES['file']['tmp_name']);
//    }
//
//    //Import uploaded file to Database
//    $handle = fopen($_FILES['file']['tmp_name'], "r");
//
//    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
//        if($i>0) {
//            $import="INSERT into test(test1,test2,test3) VALUES ('$data[0]','$data[1]','$data[2]')";
//
//            mysqli_query($connect,$import);
//        }
//        $i++;
//    }
//
//    fclose($handle);
//
//    print "Import done";
//}      

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
                        <div class="col-md-12 textalc text-uppercase"><h2>File Upload</h2></div>
                    </div>
                        <?php include '../template/messagebox.php';?>
                    <div class="row">
                        <div class="col-md-2">&nbsp;</div>
                        <div class="col-md-8">
                            <form method="post" enctype="multipart/form-data">
                                <lable for="file">Select File</lable>
                                <input type="file" name="file" id="file" onchange=""/>
                                <input type="submit" name="submit" value="Upload"/>
                            </form>
                            <table id="tbl_upload_extract" class=" table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Date</th>
                                        <th style="width: 70%">Holiday Name</th>
                                        <th style="width: 10%">Holiday Type</th>
                                    </tr>
                                </thead>
                                <tbody name="tbl" id="tbl">
                                 <?php 
                                 if ($filename != "") {
//                                    $filename = $_FILES['file']['name'];
                                    $uploadFileName = explode(".", $_FILES['file']['name']);

                                    $uploadFileArrayCount = count($uploadFileName);

                                    $handle = fopen($_FILES['file']['tmp_name'],"r");
                                    $data = fgetcsv($handle);

                                    $i=0;
                                    while ($data = fgetcsv($handle)){ 
                                        echo "<tr>";
                                        echo "<td>".$i."</td>";
                                        echo "<td>".$data[0]."</td>";
                                        echo "<td>".$data[1]."</td>";
                                        echo "<td>".$data[2]."</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                 }
                                 
                                 ?>   
                                </tbody>
                            </table>
                            
                        </div>
                        <div class="col-md-2">&nbsp;</div>
                    </div>
                </div>
            </div>
            <?php include '../template/footer.php';?>
        </div>
<!--        <script type="text/javascript">
            $(document).ready(function(){
                const upload_file = $('#file');
                
                upload_file.change(function(){
//                    $filename = $_FILES['file']['name'];
//                    $filepath = $_FILES['file']['tmppath'];
                    if ($_FILES['file']['name']) {
                        
                        
                        $uploadFileName = explode(".", $_FILES['file']['name']);
                        $uploadFileArrayCount = count($uploadFileName);
                        
                        alert ("$uploadFileName[0");
                    };
                    
//                  alert ("Upload Okay");  
                    
                });
            });
        </script>-->
    </body>
</html>


