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
<h3 class="page-title  uppercase bold"> Withdraw Method Management


<button type="button" class="btn btn-primary  btn-md pull-right edit_button" 
data-toggle="modal" data-target="#myModal"
data-act="Add New"
data-name=""
data-id="0">
<i class="fa fa-plus"></i>  ADD NEW
</button> 

</h3>
<hr>




<div class="row">
<div class="col-md-12">

<?php

if(isset($_GET['act'])) {
$id = $_GET['id']; 
$act = $_GET['act']; 
mysql_query("UPDATE packs SET tm='0', st='1' WHERE id='".$id."'");
}
?>  



<?php

if(isset($_POST['tm'])){

$id = mysql_real_escape_string($_POST["id"]);
$tm = mysql_real_escape_string($_POST["tm"]);

$ttm = time()+($tm*3600);

$res = mysql_query("UPDATE packs SET st='0', tm='".$ttm."' WHERE id='".$id."'");
if($res){
notification("Updated Successfully!", "", "success", false, "btn-primary", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-primary", "OKAY");
}

}


if(isset($_POST['name'])){

$id = $_POST["id"];
$name = $_POST["name"];
$min = $_POST["min"];
$max = $_POST["max"];
$charged = $_POST["charged"];
$chargep = $_POST["chargep"];
$processtm = $_POST["processtm"];



$err1 = trim($name)=="" ? 1:0;
$err2 = trim($min)=="" ? 1:0;
$err3 = trim($max)=="" ? 1:0;
$err4 = trim($charged)=="" ? 1:0;
$err5 = trim($chargep)=="" ? 1:0;
$err6 = trim($processtm)=="" ? 1:0;
$err7 = $chargep<0 ? 1:0;
$err8 = $charged<0 ? 1:0;

$error = $err1+$err2+$err3+$err4+$err5+$err6+$err7+$err8;


if ($error == 0){

if ($id==0) {
$res = $db->query("INSERT INTO wd_method SET name='".$name."',  minamo='".$min."', maxamo='".$max."', charged='".$charged."', chargep='".$chargep."', processtm='".$processtm."'");
if($res){
notification("Added Successfully!", "", "success", false, "btn-primary", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-primary", "OKAY");
}
}else{
$res = $db->query("UPDATE wd_method SET name='".$name."',  minamo='".$min."', maxamo='".$max."', charged='".$charged."', chargep='".$chargep."', processtm='".$processtm."' WHERE id='".$id."'");
if($res){
notification("Updated Successfully!", "", "success", false, "btn-primary", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-primary", "OKAY");
}
}


} else {


if ($err1 == 1){
notification("Method Name Can Not be Empty!", "Please Check..", "error", false, "btn-success", "OKAY");
}    
if ($err2 == 1 || $err3 == 1){
notification("Limiting Factors Are Required!", "Please Check..", "error", false, "btn-success", "OKAY");
}    
if ($err4 == 1 || $err5 == 1 ){
notification("Charges Are required!", "Please Check..", "error", false, "btn-success", "OKAY");
}
if ($err6 == 1 ){
notification("Process Time required!", "Please Check..", "error", false, "btn-success", "OKAY");
}

if ($err7 == 1 || $err8 == 1 ){
notification("Charges Can Not be Negative!", "Please Check..", "error", false, "btn-success", "OKAY");
}    

}
}

?>      


<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-dark">
<!--i class="icon-settings font-dark"></i>
<span class="caption-subject bold uppercase">AAA</span-->
</div>
<div class="tools"> </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>



<tr>
<th> ID# </th>
<th> Name </th>
<th> Limit/Trx </th>
<th> Charge/Trx </th>
<th> Process Time </th>
<th> Action </th>
</tr>

</thead><tbody>

<?php
$ddaa = $db->query("SELECT id, name, minamo, maxamo, charged, chargep, processtm FROM wd_method ORDER BY id");
while ($data = $ddaa->fetch()){

echo "                                
<tr id='$data[0]'>

<td>$data[0]</td>
<td>$data[1]</td>
<td><b>$basecur $data[2] </b> TO <b>$basecur $data[3]</b></td>
<td><b>$basecur  $data[4] </b> + <b>$data[5] %</b></td>
<td><b>$data[6] Days</b></td>
<td>

<button type=\"button\" class=\"btn purple btn-sm edit_button\" 
data-toggle=\"modal\" data-target=\"#myModal\"
data-act=\"Edit\"
data-ptm=\"$data[6]\"
data-cp=\"$data[5]\"
data-cd=\"$data[4]\"
data-max=\"$data[3]\"
data-min=\"$data[2]\"
data-name=\"$data[1]\"
data-id=\"$data[0]\">
<i class=\"fa fa-edit\"></i> EDIT
</button> 


<button type=\"button\" class=\"btn btn-danger btn-sm delete_button\" 
data-toggle=\"modal\" data-target=\"#DelModal\"
data-id=\"$data[0]\">
<i class=\"fa fa-times\"></i>  DELETE
</button>




</td>



</tr>";

}
?>



</tbody>
</table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

</div>
</div><!-- ROW-->











</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->






<!-- Modal for Edit button -->
<div class="modal container fade" id="myModal" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <b class="abir_act"></b> Withdraw Method</h4>
</div>
<form method="post" action="">
<div class="modal-body">


<input class="form-control abir_id" type="hidden" name="id">


<div class="row">

<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Method Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg abir_name" name="name" placeholder="" type="text">
</div>
</div>
</div>

<br><br>

<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Process Time</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg abir_ptm" name="processtm" value="" type="text">
<span class="input-group-addon">DAYS</span>
</div>
</div>
</div>

</div>

<br><br>


<div class="row">


<div class="col-md-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Limit Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MINIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg abir_min" name="min" value="" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>



<div class="col-md-6">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">MAXIMUM</strong></label>
<div class="col-md-12">
<div class="input-group mb15">
<input class="form-control input-lg abir_max" name="max" value="" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>
</div>
</div>

</div><!-- row 2nd   -->
</div>
</div>


</div><!-- col-6   -->


<div class="col-md-6">


<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="panel-title" style="text-transform: uppercase; font-weight: bold;">Charge Per Transaction</h1>
</div>
<div class="panel-body">
<div class="row">


<div class="col-md-5"> <br>
<div class="input-group mb15">
<input class="form-control input-lg abir_cd" name="charged" value="" type="text">
<span class="input-group-addon"><?php echo $basecurrency; ?></span>
</div>
</div>

<div class="col-md-2"><br><b class="btn btn-success btn-lg btn-block">AND</b></div>


<div class="col-md-5"><br>
<div class="input-group mb15">
<input class="form-control input-lg abir_cp" name="chargep" value=""  type="text">
<span class="input-group-addon">%</span>
</div>
</div>  

</div><!-- row 2nd   -->
</div>
</div>


</div>

</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
</div>



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
        
$(document).on( "click", '.edit_button',function(e) {

        var name = $(this).data('name');
        var id = $(this).data('id');
        var act = $(this).data('act');
        var min = $(this).data('min');
        var max = $(this).data('max');
        var cd = $(this).data('cd');
        var cp = $(this).data('cp');
        var ptm = $(this).data('ptm');

        $(".abir_id").val(id);
        $(".abir_name").val(name);
        $(".abir_act").text(act);
        $(".abir_min").val(min);
        $(".abir_max").val(max);
        $(".abir_cd").val(cd);
        $(".abir_cp").val(cp);
        $(".abir_ptm").val(ptm);

    });



$(document).on( "click", '.inc_button',function(e) {


        var id = $(this).data('id');

        $(".abirid").val(id);
            });


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
          frm: "wd_method"
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