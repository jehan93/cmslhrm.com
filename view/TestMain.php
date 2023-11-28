<?php 
$post_fname = '';
if (isset($_POST['fname'])) {
    $post_fname = $_POST['fname'];
    echo $post_fname;
}
?>
<html>
    <head>
        <title>CMSL - HRM System</title>
        <?php include '../template/htmlHead.php'; ?>
    </head>
    <body id="body">
        <div id="main">
            <div class="col-md-12" id="content">
                <div class="col-md-12" id="div_load"></div>
                <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                   THis is just a test 
                </div>
                
                <!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>

<!-- Small modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      ...
    </div>
  </div>
</div>
                
                
                
                
                
                
                
                
        </div>
    </body>
</html>
<!--<script>
$('#div_load').load('testForm.php');

</script>-->

<script>
//      $('#div_load').load('testForm.php');
      $('#div_load').load('employees_add_basic.php');
    
   
$(document).ready(function(){
   
    var fname = document.getElementById('fname');
    var nic = document.getElementById('nic');
var btn_submit = document.getElementById('btn_submit');
var btn_test = document.getElementById('btn_test');
var btn_back = document.getElementById('btn_back');
   var post_fname = "<?php echo $post_fname?>";
   
//btn_test.addEventListener('click',function(){
//    
//    $('#myAlert').on('closed.bs.alert', function () {
//  // do something…
//});
////    fname.value='This is a test';
////   alert(fname.value); 
//});

//$(document).on('click','#btn_test',function(){
//    fname.value='This is a test';
////   alert(fname.value); 
//});

btn_submit.addEventListener('click',function(){
//    $('#div_load').unload('employees_add_basic.php');
    $('#div_load').load('testForm.php');
    
//    
//    $.ajax({
//    type:'POST',
//    url:'process.php',
//    data:{fname:fname.value},
//    success:function(data){
////        alert(data);
//        nic.value=data;
//    }
//        });
//    
});

btn_back.addEventListener('click',function(){
    $('#div_load').load('employees_add_basic.php');
    });

if (post_fname!="") {
//    alert (post_fname);
    nic.value=post_fname;
}

});
    
  
    
    
    
//    function darkMode() {
//   var element = document.getElementById('content');
//   element.classList.toggle("dark-mode");
//}
////      nic = $('#nic').val();
//    
//    
//    $(document).ready(function(){
//        
////        var name = $('#name');
//        
//    var nic = $('#nic');
////    nic = "";
//    var fname = document.getElementById('fname');
//    var btn_submit = document.getElementById('btn_submit');
//    var btn_next = document.getElementById('btn_next');
////    var slider = =document.getElementById('switch_dark_mode');
//    var slider = $('#switch_dark_mode');
////    var btn_next = $('#btn_next');  
//        
//        
//        
////        $(document).on('click','#btn_next',function(){
//        btn_next.addEventListener('click',function(){
//            
//            x = slider.val();
////           console.log(x);
//            alert(x);
//        
//
//
//        });
//        $(document).on('click','.btn-submit',function(){
//            var submit_id = $(this).attr('btn-id');
//            console.log(submit_id);
//            alert(nic.val());
//        });
////        var btn_submit = function(){
////            alert('name');
////        };
////        function btn_submit() {
////            alert('name');
////        }
//        
//        
////        $(document).on('click','.btn-next',function(){
////        var del = $(this);
////        var del_id = $(this).attr('btn-next');
////        alert('name');
//////        if (confirm('Are you sure you want to delete this product?')==true) {
//////            if (confirm('Deleting Product, You Sure?')) {
//////                $.ajax({
//////                    url:'../controller/controller_product.php?action=deleteProduct',
//////                    method:'POST',
//////                    data:{product_id:del_id},
//////                    success:function(data){
//////                        if (data=='Querry Error') {
//////                            alert('Product cannot be deleted as it has been used in Invoices');
//////                        }else{
//////                        del.closest('tr').hide();   
//////                    alert ('Product Deleted');
//////                }
//////                    }
//////                });
//////            }
//////        }
////    });
//        
//        
//        
//    });
</script>