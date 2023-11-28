<?php
include '../config/sessionhandling.php';
$empId=$emprow['emp_id'];

$link = mysqli_connect("localhost", "root", "", "cmsl_hrm2");

$output = "";

if (isset($_POST["cityId"])) {
    $cityId=$_POST['cityId'];
    $sql = "SELECT * FROM city WHERE cityId =".$cityId;
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
    }
    
if (isset($_GET["form_add"])) {
//    echo 'GOt Data';
    print_r($_POST);
    
    
    }
    
if (isset($_POST["leaveType"])) {
    $leaveType=$_POST['leaveType'];
    $sql = "SELECT SUM(leave_days) FROM leaves WHERE leave_emp_id=".$empId." AND leave_type_id=".$leaveType." AND (leave_status='Approved' OR leave_status='Pending')";
    $sql1 = "SELECT * FROM leave_type l WHERE l.leave_type_id =".$leaveType;
    $result = mysqli_query($link, $sql);
    $result1 = mysqli_query($link, $sql1);
    $leaveTaken = mysqli_fetch_array($result)['SUM(leave_days)'];
    $allotedLeave = mysqli_fetch_array($result1)['leave_type_limit'];
    echo $allotedLeave-$leaveTaken;
    }
    
if (isset($_POST["deptId"])) {
    $deptId=$_POST['deptId'];
    $sql = "SELECT * FROM department_managers dm JOIN department d JOIN employee_details_basic e WHERE dm.dept_id = d.dept_id AND dm.dept_manager_emp_id = e.emp_id AND dm.dept_id =".$deptId;
    $result = mysqli_query($link, $sql);
    $rowCount = mysqli_num_rows($result);
//    $output = $rowCount;
    if ($rowCount==0) {
        $output .= '<option value="">Select Reporting Manager</option>';
    } else {
        while ($row = mysqli_fetch_array($result)){
        $output .= '<option value="">Select Reporting Manager</option>';
        $output .= '<option value="'.$row["dept_manager_id"].'">'.$row["emp_fname"].' '.$row["emp_lname"].'</option>';
    }
    }
//    $row = mysqli_fetch_array($result);
//    if
//    while ($row=mysqli_fetch_array($result)){
//        if ($row["emp_id"]>0) {
//            $output .= $row["emp_fname"];
//            
//        } else {
//            $output = "no";
//        }
//        
//    }
    
        
    
    
//    if (mysqli_fetch_array($result)==NULL) {
//        $output .= '<option value="">Select Manager</option>';
//        $output .= '<option value="">Testing</option>';
//    }else{
//        $row = mysqli_fetch_array($result);
//    while ($row){
//        $output .= '<option value="">Select Manager</option>';
//        $output .= '<option value="'.$row["emp_id"].'">'.$row["emp_fname"].' '.$row["emp_lname"].'</option>';
//    }
//    }
//    var_dump($output);
    echo $output;
}
if (isset($_POST['profile_viewer_uid'])) {
    $profile_viewer_uid = $_POST['profile_viewer_uid'];
 echo($profile_viewer_uid);
    
    
    }
?>
    