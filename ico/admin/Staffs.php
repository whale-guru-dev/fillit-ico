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
<h3 class="page-title uppercase bold"> Manage Staffs

<a class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#AddModal" href="javascript:;">
<i class="fa fa-plus"></i>   ADD NEW
</a>

 </h3>
<hr>


<div class="row">
<div class="col-md-12">


<?php

if(isset($_POST['newpass'])){
$id = $_POST["id"];
$pass = $_POST["newpass"];
$passmd = MD5($pass);
$res = $db->query("UPDATE admin SET password='".$passmd."' WHERE id='".$id."'");
if($res){
notification("Updated Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}
}



if(isset($_POST['name'])){

$name = $_POST["name"];
$fnm = $_POST["fnm"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$pass = $_POST["pass"];
$powr = $_POST["powr"];


$err1=trim($name)=="" ? 1:0;
$err2=trim($email)==""?1:0;
$err3=strlen($pass)<=3?1:0;
$count = $db->query("SELECT COUNT(*) from admin WHERE username='".$name."'")->fetch();
$err4=$count[0]>=1?1:0;
$count = $db->query("SELECT COUNT(*) from admin WHERE email='".$email."'")->fetch();
$err5=$count[0]>=1?1:0;

$error = $err1+$err2+$err3+$err4+$err5;
if ($error == 0){
$passmd = MD5($pass);

$res = $db->query("INSERT INTO admin SET username='".$name."', fullname='".$fnm."', email='".$email."', mobile='".$mobile."', pwr='".$powr."', password='".$passmd."'");

if($res){
notification("Added Successfully!", "", "success", false, "btn-success", "OKAY");
}else{
notification("Some Problem Occurs!", "Please Try Again...", "error", false, "btn-success", "OKAY");
}

} else {
  
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Username Can Not be Empty!!!
</div>";
}   
  
if ($err2 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Email Can Not be Empty!!!
</div>";
}   
  
if ($err3 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Password Can Not be less than 4 char!!!
</div>";
}   
  
if ($err4 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Username Already Exist!!!
</div>";
}   
  
if ($err5 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
Email Already Exist!!!
</div>";
}   

}




}

?>    


<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-dark">
</div>
<div class="tools"> </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="sample_1">
<thead>



<tr>
<th> ID# </th>
<th> Username </th>
<th> Full Name </th>
<th> Email </th>
<th> Phone </th>
<th> Role </th>
<th> Action </th>
</tr>

</thead><tbody>

<?php
$ddaa =$db->query("SELECT id, username, fullname, email, mobile, pwr FROM admin ORDER BY id");
while ($data = $ddaa->fetch()){

if($data[5]==100){
$rr = "<p class=\"btn green btn-outline sbold uppercase btn-xs\"> ADMIN </p>";	
}else{
$rr = "<p class=\"btn blue btn-outline sbold uppercase btn-xs\"> STAFF </p>";	
}	

echo "                                
<tr id='$data[0]'>

<td>$data[0]</td>
<td>$data[1]</td>
<td>$data[2]</td>
<td>$data[3]</td>
<td>$data[4]</td>
<td>$rr</td>
<td>

<button type=\"button\" class=\"btn btn-danger btn-sm pass_button\" 
data-toggle=\"modal\" data-target=\"#PasswordModal\"
data-id=\"$data[0]\">
<i class=\"fa fa-edit\"></i> CHANGE PASSWORD
</button>



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
</div><!-- ROW-->




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





<!-- Modal forADD -->
<div class="modal fade" id="AddModal" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <i class='fa fa-plus'></i> ADD NEW STAFF</h4>
</div>
<form method="post" action="">
<div class="modal-body">      



<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Username</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="name" placeholder="Unique - Required for Login" type="text" required="">
</div>
</div>
</div>




<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Full Name</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="fnm" placeholder="Full name" type="text" required="">
</div>
</div>
</div>



<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Email</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="email" placeholder="Valid Email - Required for Password Reset" type="email" required="">
</div>
</div>
</div>





<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">mobile</strong></label>
<div class="col-md-12">
 <input class="form-control input-lg" name="mobile" placeholder="Mobile Number" type="text" required="">
</div>
</div>
</div>





<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Password</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="pass" placeholder="Make it strong" type="password" required="">
</div>
</div>
</div>


<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">Role</strong></label>
<div class="col-md-12">
<select class="form-control input-lg" name="powr">
<option value="0">STAFF</option>
<option value="100">ADMIN</option>
</select>
</div>
</div>
</div>

       
</div>

<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save Changes</button>
</div>
</form>


</div>
</div>
<!-- modal -->



<!-- Modal for PASS -->
<div class="modal fade" id="PasswordModal" tabindex="-1" role="dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel"> <i class='fa fa-edit'></i> CHANGE PASSWORD</h4>
</div>
<form method="post" action="">
<div class="modal-body">      
<input type="hidden" name="id" class="abirid">
<div class="row">
<div class="form-group">
<label class="col-md-12"><strong style="text-transform: uppercase;">NEW Password</strong></label>
<div class="col-md-12">
<input class="form-control input-lg" name="newpass" placeholder="Make it strong" type="password" required="">
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save Changes</button>
</div>
</form>
</div>
</div>
<!-- modal -->




<?php
include ('include/footer.php');
?>




<script>
    $(document).ready(function(){
        



        
$(document).on( "click", '.delete_button',function(e) {
        var id = $(this).data('id');
        $('.delete_product').data('did', id);

    });
        
$(document).on( "click", '.pass_button',function(e) {
        var id = $(this).data('id');
        $(".abirid").val(id);
    });






        $('.delete_product').click(function(e){
            
            e.preventDefault();


        var pid = $(this).data('did');

        $.post( 
                  "delete.php",
                  { 
          delete: pid,
          frm: "admin"
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