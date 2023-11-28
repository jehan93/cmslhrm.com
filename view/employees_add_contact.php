<table class="table table-bordered table-condensed" style="border: black solid">
                                <thead>
                                    <tr style="background-color: #DDD; border-bottom: black solid;">
                                        <th>d. Employee Contact Details</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <form name="add_emp_contact_details" id="add_emp_contact_details" method="post" action="../controller/controller_employee.php?action=addEmpContactDetails">
                                                <div class="row">
                                                    <div class="col-md-5"><h4>New Employee Name</h4></div>
                                                    <div class="col-md-7"><h4><?php echo $newEmpInfo['emp_fname']." ".$newEmpInfo['emp_lname']; ?></h4></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Mobile Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="mobno" id="mobno" placeholder="Mobile No.07XXXXXXXX" onkeyup="clearMsg('mobnoerr')">
                                                        <a class="error">*</a><span id="mobnoerr" class="error" ></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Telephone Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="telno" id="telno" placeholder="Telephone No.011XXXXXXX">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Email Address</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="email" id="email" placeholder="Email Address" onkeyup="clearMsg('emailerr')">
                                                        <a class="error">*</a><span id="emailerr" class="error" ></span>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h3>In Case of Emergency</h3></div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Contact Person</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="emeContName" id="emeContName" placeholder="Name of Emergency Contact Person">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Contact Number</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="tel" name="emeContNo" id="emeContNo" placeholder="Number of Emergency Contact Person">
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4>Relationship</h4></div>
                                                    <div class="col-md-7">
                                                        <input class="form-control" type="text" name="emeContRelation" id="emeContRelation" placeholder="Relationship">
                                                    </div> 
                                                </div>
                                                <div>&nbsp;</div>
                                                <div class="row">
                                                    <div class="col-md-5"><h4></h4></div>
                                                    <div class="col-md-7">
                                                        <input type="submit" name="sub" value="Next" class="btn btn-success"/>
                                                        <input type="reset" name="reset" value="Clear" class="btn btn-warning"/>
                                                    </div> 
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr style="border-top: black solid">
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>