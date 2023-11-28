<table class="table table-bordered table-condensed" style="border: black solid;">
            <thead>
                <tr style="background-color: #DDD; border-bottom: black solid;">
                    <th>a. Employee Basic Information</th>
                </tr>   
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form name="form_add_employee" id="form_add_employee" method="">
                            <!--<form name="add_emp" id="add_emp" method="post" action="#">-->
                            <br/>
                            <div class="row">
                                <div class="col-md-5"><h4>First Name</h4></div>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" required value="<?php if(isset($_POST['fname'])){ echo $_POST['fname'];} ?>" onkeyup="clearMsg('fnameerr')">
                                    <a class="error">*</a><span id="fnameerr" class="error" ></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5"><h4>Other Names</h4></div>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" name="onames" id="onames" placeholder="Other Names" value="<?php if(isset($_POST['oname'])){ echo $_POST['oname'];} ?>" >
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-5"><h4>Last Name / Surname</h4></div>
                                <div class="col-md-7">
                                    <input class="form-control" type="text" name="lname" id="lname" placeholder="Last/Surname" required value="<?php if(isset($_POST['lname'])){ echo $_POST['lname'];} ?>" onkeyup="clearMsg('lnameerr')">
                                    <a class="error">*</a><span id="lnameerr" class="error" ></span>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-5"><h4>National Identity Card No.</h4></div>
                                <div class="col-md-7">
                                    <input class="form-control error" type="text" name="nic" id="nic" onkeyup="clearMsg('nicerr')" placeholder="NIC No." value="<?php if(isset($_POST['nic'])){ echo $_POST['nic'];} ?>" >
                                    <a class="error">*</a><span id="nicerr" class="error" ></span>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-5"><h4></h4></div>
                                <div class="col-md-7">
                                    <!--<button type="button" class="btn btn-success btn-submit" btn-id="1" id="btn_submit">Success</button>-->
                                    <input type="button" id="btn_submit" name="btn_submit" value="Submit" class="btn btn-success btn-submit" btn-id="1"/>
                                    <input type="reset" name="btn_reset" value="Clear" class="btn btn-warning"/>
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