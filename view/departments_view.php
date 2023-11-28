<?php
include '../config/dbconnection.php';
include '../config/sessionhandling.php';
include '../model/model_department.php';
include '../restrictedAccess/all_restricted.php';

$obdept = new model_department();
$result = $obdept ->viewDepartment();

?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Dept. ID</th>
            <th>Department Name</th>
            <th>Department Head</th>
            <th>Department Employees</th>
        </tr>
    </thead>
    <tbody>
        <?php
//        $result = $obdept ->viewDepartment();
        while ($deptrow=$result->fetch(PDO::FETCH_BOTH)){?>
        <tr>
            <td><?php echo $deptrow['dept_id'];?></td>
            <td><?php echo $deptrow['dept_name'];?></td>
            <td><?php echo $deptrow['emp_fname']." ".$deptrow['emp_lname'];?></td>
            <td><a href="../view/department_emp.php?dept_id=<?php echo $deptrow['dept_id'];?>"><button class="btn btn-primary" id="btn_viewEmp">View Employees</button></a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>