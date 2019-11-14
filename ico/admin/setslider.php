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
<h3 class="page-title  uppercase bold"><i class="fa fa-file-image-o"></i> SET Home Sliders</h3>

<hr>
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">



<?php

if($_POST){
$btxt = $_POST["btxt"];
$stxt = $_POST["stxt"];

$err1 = 0;

if (empty($_FILES['bgimg']['name'])) {
$err1 = 1;
}else{
// IMAGE UPLOAD //////////////////////////////////////////////////////////
$folder = "../assets/images/slider/";
$extention = strrchr($_FILES['bgimg']['name'], ".");
$new_name = time();
$bgimg = $new_name.'.jpg';
$uploaddir = $folder . $bgimg;
move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);

//------------------>>> RESIZE
include_once("abirimageclass.php");
$target_file = $folder.$bgimg;
$resized_file = $folder.$bgimg;
$wmax = 1200;
$hmax = 800;
$ext = ".jpg";
ak_img_resize($target_file, $resized_file, $wmax, $hmax, $ext);


//------------------>>> RESIZE
//////////////////////////////////////////////////////////////////////////
}

$error = $err1;


if ($error == 0){

$res = $db->query("INSERT INTO slider_home SET img='".$bgimg."', btxt='".$btxt."', stxt='".$stxt."'");
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
<label class="col-sm-3 control-label"><strong>SLIDER IMAGE</strong></label>
<div class="col-sm-3"><input type="file" name="bgimg"></div>
<div class="col-sm-3"><b style="color:red; font-weight: bold;"> Will Resized To 1200 X 800</b></div>

</div>


<div class="form-group">
<label class="col-sm-3 control-label"><strong>Bold Text</strong></strong></label>
<div class="col-sm-6"><input type="text" name="btxt" class="form-control input-lg"></div>          
</div>

<div class="form-group">
<label class="col-sm-3 control-label"><strong>Small Text</strong></strong></label>
<div class="col-sm-6"><input type="text" name="stxt" class="form-control input-lg"></div>          
</div>


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

$ddaa = $db->query("SELECT id, img, btxt, stxt FROM slider_home ORDER BY id");
while ($data = $ddaa->fetch()){

echo "<div class=\"col-md-4 col-sm-12\"  id='$data[0]'>

<div class=\"portlet box blue\">
<div class=\"portlet-title\">
<div class=\"caption\">SLIDER DETAILS</div>
</div>
<div class=\"portlet-body\" style='min-height:560px;'>



<img src=\"../assets/images/slider/$data[1]\" alt=\"IMG\" style=\"width:100%;\"><br/>
<h3 style=\"font-weight:bold; min-height:40px;\">$data[2] </h3> $data[3] <br><br>

<button type=\"button\" class=\"btn btn-danger btn-block delete_button\" 
data-toggle=\"modal\" data-target=\"#DelModal\"
data-id=\"$data[0]\">
<i class=\"fa fa-times\"></i>  DELETE
</button>

</div>
</div>
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
          frm: "slider_home"
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