
<form class="form-group" method="">
    
                    <label for="name">Name</label>
                    <input class="form-control" name="fname" id="fname" type="text" value="<?php if (isset($_POST['fname'])) {echo $_POST['fname'];} ?>"/>
                    <label for="nic">NIC</label>
                    <input class="form-control" name="nic" id="nic" type="text"/>
                    <!--<input class="form-control btn btn-success" name="btn_submit" id="btn_submit" value="Submit" type="button"/>-->
                    <br><br>    
                    <!--<button class="form-control btn btn-success" id="btn_next">Next</button>-->
                    <button type="button" class=" form-control btn btn-success btn-submit" btn-id="1" id="btn_submit" >Success</button>
                    <button type="button" class=" form-control btn btn-success btn-submit" btn-id="1" id="btn_test" >Test</button>
                    <!--<button type="button" class=" form-control btn btn-warning btn-submit" btn-id="2" id="btn_submit" >Success</button>-->
                    <button type="button" class="btn btn-sm btn-danger btn-next" btn-next="1" id="btn_back" >Back</button>
                </form>
<script>



</script>