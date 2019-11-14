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
<h3 class="page-title  uppercase bold"> <i class="fa fa-desktop"></i> Social Setting

<a href="http://fontawesome.io/icons/" target="_blank" class="btn btn-info pull-right">Font Awesome Icon Codes</a>


</h3>
<hr>

<div class="row">



<div class="col-md-12">
<!-- BEGIN SAMPLE FORM PORTLET-->
<div class="portlet light bordered">

<div class="portlet-body form">
<form class="form-horizontal" action="" method="post" role="form">
<div class="form-body">


<?php

if($_POST){

$icon = $_POST["icon"];
$btxt = $_POST["btxt"];
$res = $db->query("INSERT INTO social SET icon='".$icon."', url='".$btxt."'");
if($res){
notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
}
?>										



<div class="row">
	
<div class="col-md-3">
<b class="btn green btn-outline btn-lg btn-block sbold uppercase">Font Awesome Icon Code</b>
</div>
	
<div class="col-md-9">
<b class="btn green btn-outline btn-lg btn-block sbold uppercase">URL</b>
</div>


</div>





<br><br>
<div class="row">

<div class="col-md-3">
<div class="input-group mb15">
<span class="input-group-addon">fa fa-</span>
<input class="form-control input-lg" name="icon" type="text">
</div>
</div>
	
<div class="col-md-9">
<input class="form-control input-lg" name="btxt" type="text">
</div>

</div>




<br><br>

<div class="row">
<div class="col-md-12">
<button type="submit" class="btn blue btn-block btn-lg">ADD NEW</button>
</div>
</div>



</div>
</form>
</div>
</div>
</div>		
</div><!---ROW-->		



<div class="row">
	


<div class="portlet box green">

<div class="portlet-title">
<div class="caption"><i class="fa fa-list"></i> SOCIAL LIST</div>
</div>

<div class="portlet-body">



<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> ICON </th>
<th> URL </th>
<th> DELETE </th>
</tr>
</thead>
<tbody>



<?php
$ddaa =$db->query("SELECT id, icon, url FROM social ORDER BY id");
while ($data = $ddaa->fetch()){

echo "                                
<tr id='$data[0]'>

<td><i class='fa fa-$data[1]'></i></td>
<td>$data[2]</td>
<td>

<button type=\"button\" class=\"btn btn-danger btn-sm delete_button\" 
data-toggle=\"modal\" data-target=\"#DelModal\"
data-id=\"$data[0]\">
<i class=\"fa fa-times\"></i> DELETE
</button>


</td>



</tr>";

}
?>


</tbody>
</table>
</div>

</div>
</div>



</div><!-- row -->







<!-- Modal for DELETE -->
<div class="modal fade" id="DelModal" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete !</h4>
</div>

<div class="modal-body">
<strong>Are you sure you want to Delete ?</strong>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="button" class="delete_product btn btn-danger" data-did="0" data-dismiss="modal">DELETE</button>
</div>


</div>
</div>





<!-- Modal for DEL SUCCESS -->
<div class="modal fade" id="DelDone" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <i class='fa fa-trash'></i> Delete!</h4>
</div>

<div class="modal-body">      
<b class="msg"></b>         
</div>

<div class="modal-footer">
<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
</div>


</div>
</div>
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
                  "delete.php",
                  { 
          delete: pid,
          frm: "social"
          },
                  function(data) {
            
        $("#"+pid).fadeOut("slow");
        $(".msg").text(data);
        $("#DelDone").modal('show');          
                  }
               );



        });


        
    });
</script>
</body>
</html>