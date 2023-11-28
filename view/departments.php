<?php
include '../config/dbconnection.php';
include '../config/sessionhandling.php';
include '../model/model_department.php';
include '../restrictedAccess/all_restricted.php';

$obdept = new model_department();
$result = $obdept ->viewDepartment();

?>
<html>
    <head>
        <?php include '../template/htmlHead.php'; ?>
    </head>
    <body>
        <div id="main">
            <div id="body">
                <?php include '../template/header.php';?>
                <div class="row">
                    <?php include '../template/navigation.php'; ?>
                    <div class="col-md-9 container" id="content">
                        <div class="row">
                            <div class="col-md-12 textalc text-uppercase"><h2>Departments</h2></div>
                        </div>
                            <?php include '../template/messagebox.php'; ?>
                        <div>&nbsp;</div> 
                        <!--<div>&nbsp;</div>-->
                        
                        <div class="row bborder">
                        <div class="col-md-5" id="add_department">
                            <div class="row">
                                <!--<div class="col-md-1">&nbsp;</div>-->
                                <div class="col-md-10">
                                    <h4><b>Add / Edit Department</b></h4>
                                    <br/>
                                    <form id="form_add_department">
                                        <label>Department Name</label>
                                        <input class="form-control" type="text" id="dept_id" name="dept_id" value="0" style="display: none"/>
                                        <input class="form-control" type="text" placeholder="Enter Department Name" id="dept_name" name="dept_name" required/>
<!--                                        <br/>
                                        <label>Description</label>
                                        <textarea class="form-control" cols="3" placeholder="Enter Product Description" id="product_description" name="product_description" required></textarea>
                                        <br/>
                                        <label>Rate</label>
                                        <input class="form-control" type="number" placeholder="Enter Product Rate" id="product_rate" name="product_rate" required/>-->
                                        <br/>
                                        <input class="btn btn-success" type="button" value="Save Department" id="btn_save"/>
                                        <input class="btn btn-warning" type="reset" value="Clear Details" id="btn_clear"/>
                                    </form>
                                </div>
                                <!--<div class="col-md-1">&nbsp;</div>-->
                            </div>
                        </div>
                        <div class="col-md-7" id="department_details"></div>   
                        </div>
                        
<!--                        <div class="row">
                            <div class="col-md-3">
                                
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Department ID</th>
                                            <th>Department Name</th>
                                            <th>Department Head</th>
                                            <th>Department Employees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
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
                            </div>
                        </div>-->
                    </div>
                </div>
                <?php include '../template/footer.php';?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
var dept_id = $('#dept_id');
var dept_name = $('#dept_name');
var btn_save = $('#btn_save');
var btn_view = $('.btn_view');
var form_add_department = $('#form_add_department');

$(document).ready(function(){
    
    $('#department_details').load('departments_view.php');
    
    btn_save.click(function(){
        if (product_id.val()==0) {
            if (product_name.val()=="") {
                alert('Please Enter Product Name');
                product_name.focus();
                return false;
            }else if (product_description.val()=="") {
                alert('Please Enter Product Description');
                product_description.focus();
                return false;
            }else if (product_rate.val()=="" || product_rate.val==0) {
                alert('Please Enter Product Rate');
                product_rate.focus();
                return false;
            }else if(confirm('Do you want to add this product?')==true){
                $.ajax({
                    url:"../controller/controller_product.php?action=addNewProduct",
                    method:"POST",
                    data:{product_name:product_name.val(),
                        product_description:product_description.val(),
                        product_rate:product_rate.val()},
                    success:function(data){
                        $('<tr></tr>').html(data).appendTo('#tbl_product_details');
                        $('#form_add_product')[0].reset();
                        product_id.val(0);
                        alert('New Product Added');
    //                    alert(data);
                    } 
                });
            }
        }else if (product_id.val()!=0) {
            if (confirm('Are you sure you want to update this data?')==true) {
                $.ajax({
                    url:"../controller/controller_product.php?action=updateProductDetails",
                    method:"POST",
                    data:form_add_product.serialize(),
                    success:function(data){
                        $('#product_details').load('product_view.php');
                        $('#form_add_product')[0].reset();
                        product_id.val(0);
                        alert('Product has been Updated.');
//                        alert(data);
                    } 
                });
            }
        }
    });
    
    $(document).on('click','.btn_del',function(){
        var del = $(this);
        var del_id = $(this).attr('del-id');
        if (confirm('Are you sure you want to delete this product?')==true) {
            if (confirm('Deleting Product, You Sure?')) {
                $.ajax({
                    url:'../controller/controller_product.php?action=deleteProduct',
                    method:'POST',
                    data:{product_id:del_id},
                    success:function(data){
                        if (data=='Querry Error') {
                            alert('Product cannot be deleted as it has been used in Invoices');
                        }else{
                        del.closest('tr').hide();   
                    alert ('Product Deleted');
                }
                    }
                });
            }
        }
    });
    
    $(document).on('click','.btn_edit',function(){
        var edit = $(this);
        var edit_id = $(this).attr('edit-id');
        
        $.ajax({
            url:'../controller/controller_product.php?action=viewProductDetails',
            method:'POST',
            data:{product_id:edit_id},
            success:function(data){
                var productDetails = jQuery.parseJSON(data);   
                product_id.val(productDetails['product_id']);
                product_name.val(productDetails['product_name']);
                product_description.val(productDetails['product_description']);
                product_rate.val(productDetails['product_rate']);
            }
        });
    });
    
});
</script>