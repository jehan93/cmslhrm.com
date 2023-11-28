<?php 
include '../model/model_leave.php';
include '../template/dateTime.php';
include '../model/model_holiday.php';
$obleave=new model_leave();
$obholiday = new model_holiday();
//var_dump($emprow);
//$emprowCount = count($emprow);
//$deptId=$emprow[$emprowCount['dept_id'];
$deptId=$emprow['dept_id'];
$deptHeadId=$emprow['dept_head_emp_id'];
$deptManagerId = $emprow['dept_manager_id'];

$role = $emprow['emp_role'];
//echo $role;
if ($role=='Admin') { ?>
    <div class="row">
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Total Employees</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $totalEmployees = $obemp->viewAllEmployee()->rowCount();
                        echo '<p style="text-align: center; font-size: 80px; font-weight: bold">'.$totalEmployees.'</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Total Active Employees</div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center; padding-top: 7px">
                        <?php
                        $totalActiveEmployees=$obemp->viewActiveEmployees()->rowCount();
                        echo '<p style="text-align: center; font-size: 80px; font-weight: bold">'.$totalActiveEmployees.'</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Active Logins</div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center; ">
                        <?php
                        $totalActiveLogins = $obemp->viewActiveLogins()->rowCount();
                        echo '<p style="text-align: center; font-size: 80px; font-weight: bold">'.$totalActiveLogins.'</p>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>
    <div class="row">
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Pending Leaves</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            $resultPendingLeave=$obleave->viewEmpPendingLeave($empId);
                            $nor=$resultPendingLeave->rowCount();
                            if ($nor>0) {
                                echo '<a href="../view/leave.php" style="text-decoration:none; color: white">
                                     <p style="text-align: center; font-size: 80px; font-weight: bold">'.$nor.'</p>
                                     </a>';
                            }else{
                                echo '<p style="text-align: center; font-size: 80px; font-weight: bold">0</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Upcoming Leave</div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center; padding-top: 7px">
                        <?php
                            $resultUpcomingLeave=$obleave->viewUpcomingLeaveEmp($deptId, $empId, $date);
                            $upcomingEmpLeave = $resultUpcomingLeave->fetch(PDO::FETCH_BOTH);
                            $norUpcomingLeave=$resultUpcomingLeave->rowCount();
//                            echo $norUpcomingLeave;
                            if ($norUpcomingLeave>0) {
                            $dateToday= new DateTime($date);
                            $dateLeave= new DateTime($upcomingEmpLeave["leave_from"]);
                            $dateDiff= $dateToday->diff($dateLeave);
                            $leaveDays = ($dateDiff->d);
                            
    //                            echo '<br/>';
                                echo '<b style="font-size: 20px; font-weight: bold">'.$upcomingEmpLeave["leave_type"].'</b> 
                                     Leave from <b style="font-size: 20px; font-weight: bold">'.$upcomingEmpLeave["leave_from"].'</b>
                                     to <b style="font-size: 20px; font-weight: bold">'.$upcomingEmpLeave["leave_to"].'</b>
                                     for <b style="font-size: 20px; font-weight: bold">'.$upcomingEmpLeave["leave_days"].'</b> Day(s).';
                                echo '<br/><br/>';
                                echo '<b style="font-size: 25px; font-weight: bold;">'.$leaveDays.'</b><i> day(s) more.</i>';
                            }else{
                                echo '<p style="text-align: center; font-size: 80px; font-weight: bold">0</p>';
                            }
                        ?>
                        <p style="font-size: 15px; font-weight: bold; margin: 0px; padding: 0px"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Upcoming Holiday</div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="text-align: center; ">
                        <?php 
                            $resultUpcomingOfficeHoliday = $obholiday->upcomingOfficeHoliday($date)->fetch(PDO::FETCH_BOTH);
                            $date1= new DateTime($date);
                            $date2= new DateTime($resultUpcomingOfficeHoliday['holidays_date']);
                            $dateDIff= $date1->diff($date2);
                            $leave_days = ($dateDIff->d);

                            echo '<b style="font-size: 27px; font-weight: bold">'.date_format($date2,"l, d-m-Y").'</b>';
                            echo "<br/>";
                            echo "(".$resultUpcomingOfficeHoliday['holidays_name'].")";
                            echo " (".$resultUpcomingOfficeHoliday['holidays_type'].")";
                            echo "<br/>";
                            echo '<b style="font-size: 23px; font-weight: bold;">'.$leave_days.'</b><i> day(s) more.</i>';
                        ?>
                        <p style="font-size: 15px; font-weight: bold; margin: 0px; padding: 0px"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <?php if ($role=="Manager" || $role=="Department Head") { ?>
    <div class="row">
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Leaves for your Approval</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            if ($role=="Manager") {
                                $resultApprovalLeave=$obleave->viewLeaveToApproveByManager($deptId, $deptManagerId);
                            }elseif ($role=="Department Head") {
                                $resultApprovalLeave=$obleave->viewLeaveToApproveByDeptHead($deptHeadId);
                            }
                            $norApprovalLeave=$resultApprovalLeave->rowCount();
                            if ($norApprovalLeave>0) {

                                echo '<a href="../view/leave_approve.php" style="text-decoration:none; color: white">
                                    <p style="text-align: center; font-size: 80px; font-weight: bold">'.$norApprovalLeave.'</p>
                                    </a>';
                            }else{
                                echo '<p style="text-align: center; font-size: 80px; font-weight: bold">0</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">Upcoming Employee Leave</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php


                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding: 8px">
            <div class="col-md-12 dashInfoBox">
                <div class="row">
                    <div class="col-md-12 dashInfoBoxHeading">**Heading**</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        **Information**
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }}
                            