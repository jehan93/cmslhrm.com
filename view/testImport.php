<?php
include '../config/dbconnection.php';
include '../model/model_import.php';
$csv = new model_import();
if (isset($_POST['btn_submit'])) {
    $csv ->import($_FILES['file']['tmp_name']);
}
?>
<html>
    <head>
        <title>Import File</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="btn_submit" value="Import">
        </form>
    </body>
</html>