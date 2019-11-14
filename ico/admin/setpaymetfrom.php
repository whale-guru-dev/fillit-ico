<?php
include ('include/header.php');
if ($mypower<100) {
redirect("$adminurl/Dashboard");
}
?>
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo">
<?php
include ('include/sidebar.php');
?>
<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title  uppercase bold"><i class="fa fa-file-image-o"></i> SET  Processing payments from</h3>

<hr>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">



<?php

if($_POST){

$err1 = 0;

if (empty($_FILES['bgimg']['name'])) {
$err1 = 1;
}else{
// IMAGE UPLOAD //////////////////////////////////////////////////////////
$folder = "../assets/images/processing/";
$extention = strrchr($_FILES['bgimg']['name'], ".");
$new_name = time();
$bgimg = $new_name.'.png';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);

//------------------>>> RESIZE
//////////////////////////////////////////////////////////////////////////
}

$error = $err1;


if ($error == 0){

$res = $db->query("INSERT INTO payment_image SET img='".$bgimg."'");
if($res){
notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
}else{
if ($err1 == 1){
notification("IMAGE IS REQUIRED!!!", "", "error", false, "btn-success", "OKAY");
} 

}
}

?>                  







<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-body"> 


<div class="form-group">
<label class="col-sm-3 control-label"><strong>IMAGE</strong></label>
<div class="col-sm-3"><input type="file" name="bgimg"></div>
<div class="col-sm-3"><b style="color:red; font-weight: bold;"> PNG IMAGE RECOMMENDED</b></div>

</div>

<input type="hidden" name="act" value="1">



<div class="row">
<div class="col-md-offset-3 col-md-6">
<button type="submit" class="btn blue btn-block">ADD NEW</button>
</div>
</div>

</div>
</form>
</div>
</div>




<?php

$ddaa = $db->query("SELECT id, img FROM payment_image ORDER BY id");
while ($data = $ddaa->fetch()){

echo "<div id='$data[0]' class='text-center' style='float:left; margin:30px;'>




<img src=\"../assets/images/processing/$data[1]\" alt=\"IMG\" style=\"height:100px;\"><br/>

<button type=\"button\" class=\"btn btn-danger btn-sm delete_button\" 
data-toggle=\"modal\" data-target=\"#DelModal\"
data-id=\"$data[0]\">
<i class=\"fa fa-times\"></i>  DELETE
</button>

</div>
";





}
?>                    
</div>    
</div><!---ROW-->   



</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->






<!-- Modal for DELETE -->
<div class="modal fade" id="DelModal" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
</div>
<div class="modal-body">
<strong>Are you sure, You want to  Delete ?</strong>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">NO</button>
<button type="button" class="delete_product btn btn-danger" data-did="0" data-dismiss="modal">DELETE</button>
</div>
</div>
</div>



<?php
include ('include/footer.php');
?>




<script>
    $(document).ready(function(){
  


$(document).on( "click", '.delete_button',function(e) {
        var id = $(this).data('id');
        $('.delete_product').data('did', id);

    });






        $('.delete_product').click(function(e){
            e.preventDefault();
        var pid = $(this).data('did');

        $.post( 
                  "<?php echo $adminurl; ?>/delete.php",
                  { 
          delete: pid,
          frm: "payment_image"
          },
              function(data) {
            
        $("#"+pid).fadeOut("slow");
        $(".msg").text(data);

                swal({
          title: data,
          text: "",
          type: "success",
          showCancelButton: false,
          confirmButtonClass: 'btn-primary',
          confirmButtonText: 'Okay'
        });


                  }
               );



        });


        
    });


</script>
</body>
</html>