<?php
Include('include-global.php');
$pagename = "API Manager";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Manage Your API For $basetitle Account";
?>

<style>
.propic{
    float: none;
    margin: 0 auto;
    width: 50%;
    height: 50%;
    -webkit-border-radius: 50% !important;
    -moz-border-radius: 50% !important;
    border-radius: 50% !important;
}





::-moz-focus-inner { 
  padding: 0;
  border: 0;
}


button {
  position: relative;
/*  background-color: #aaa;
  border-radius: 0 3px 3px 0;
  cursor: pointer;*/
}

.copied::after {
  position: absolute;
  top: 12%;
  right: 110%;
  display: block;
  content: "COPIED";
  font-size: 1.40em;
  padding: 2px 10px;
  color: #fff;
  background-color: #22a;
  border-radius: 3px;
  opacity: 0;
  will-change: opacity, transform;
  animation: showcopied 1.5s ease;
}

@keyframes showcopied {
  0% {
    opacity: 0;
    transform: translateX(100%);
  }
  70% {
    opacity: 1;
    transform: translateX(0);
  }
  100% {
    opacity: 0;
  }
}

</style>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');

if ($_POST) {
$cc = md5("$user-$tm-$txn_id");
$apic = strtoupper($cc);
$res = $db->query("UPDATE users SET api='".$apic."' WHERE id='".$uid."'");
if($res){
echo "<div class=\"alert alert-success alert-dismissable\">
Updated Successfully!
</div>";
}else{
echo "<div class=\"alert alert-danger alert-dismissable\">
Some Problem Occurs, Please Try Again. 
</div>";
}
}



$data = $db->query("SELECT * FROM users WHERE id='".$uid."'")->fetch();
?>

<div class="row">
<div class="col-md-12">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-cogs"></i> API MANAGER</div>
</div>
<div class="portlet-body">







<h4 class="bold">API AUTH CODE:</h4>
<div class="input-group mb15">
<input type="text" class="form-control input-lg" id="api" value="<?php echo $data['api'] ?>"/>
<span class="input-group-btn">
<button data-copytarget="#api" class="btn btn-success btn-lg">COPY TO CLIPBOARD</button>
</span>
</div>
<br>




<form action="" method="post">
	
<input type="hidden" name="api" value="change">

<br><br>
<button type="submit" class="btn btn-success btn-lg btn-block">GENERATE NEW AUTH CODE</button>



</form>

</div>
</div>

</div>


<div class="col-md-12">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">API IINFO</div>
</div>
<div class="portlet-body">

<h3 class="uppercase text-center bold">To get paid by API Just Follow The below instruction</h3>
<hr>

<strong class="uppercase">Post Below Data To </strong> <i><?php echo $apiurl; ?></i>

<h3 class="bold">API Method: post</h3>

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> Name </th>
<th> Value </th>
</tr>
</thead>
<tbody>


<tr>
<td> amount </td>
<td> Amount in numeric </td>
</tr>


<tr>
<td> payto </td>
<td> Your <?php echo $basetitle; ?> email address - <?php echo $user; ?> </td>
</tr>

<tr>
<td> paytoname </td>
<td> Name of your website or Store </td>
</tr>

<tr>
<td> itemname </td>
<td> Name of Item or Why the user paying for </td>
</tr>

<tr>
<td> responseurl </td>
<td> URL , Where the payment information should send so you can check them </td>
</tr>


<tr>
<td> successurl </td>
<td> URL , Where The user redirected When payment is completed </td>
</tr>


<tr>
<td> cancelurl </td>
<td> URL , Where The user redirected When payment is Canceled </td>
</tr>


<tr>
<td> custom </td>
<td> Custom Data By you. <strong> NO SPACE OR SPECIAL CHAR</strong></td>
</tr>

</tbody>
</table>
</div>



</div>
</div>
</div>



<div class="col-md-12">

<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">API RESPONSE</div>
</div>
<div class="portlet-body">

<strong class=""> <?php echo $basetitle; ?> will Send you the information to the "responseurl" Posted by you</strong>

<h3 class="bold">Response Method: get</h3>



<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> Name </th>
<th> Value </th>
</tr>
</thead>
<tbody>

<tr>
<td> amount </td>
<td> Amount Paid </td>
</tr>

<tr>
<td> paidby </td>
<td> Email Of The user paid </td>
</tr>

<tr>
<td> payto </td>
<td> Email Of The Merchant (Your Email)</td>
</tr>

<tr>
<td> custom </td>
<td> Your Posted "custom" Data </td>
</tr>


<tr>
<td> trx </td>
<td> Transaction ID </td>
</tr>


<tr>
<td> secret </td>
<td> Your API KEY - For verification at your end </td>
</tr>

</tbody>
</table>
</div>



</div>
</div>
</div>



<div class="col-md-12">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">DATA BY Transaction ID</div>
</div>
<div class="portlet-body">

<h3 class="bold">Request Method: get</h3>
<br><br>
<p class="lead">
Example: <br>
<strong ><i> <?php echo $verifyurl; ?>?api=[YOUR-API-KEY]&amp;trx=[TRANSACTION-ID] </i></strong>
</p>
<br><br>
<h3 class="bold">Response : json</h3>

<div class="table-scrollable">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th> Name </th>
<th> Value </th>
</tr>
</thead>
<tbody>

<tr>
<td> amount </td>
<td> Amount Paid </td>
</tr>

<tr>
<td> charge </td>
<td> Transaction Charge </td>
</tr>

<tr>
<td> paidby </td>
<td> Email Of The user paid </td>
</tr>

<tr>
<td> payto </td>
<td> Email Of The Merchant (Your Email)</td>
</tr>

<tr>
<td> time </td>
<td> Time of payment Made </td>
</tr>

<tr class="danger">
<td> error </td>
<td> Value = 1 , When Information Having Error</td>
</tr>

<tr class="danger">
<td> messase </td>
<td> When Information Having Error, message will contain the error message</td>
</tr>


</tbody>
</table>
</div>



</div>
</div>
</div>


</div><!-- row -->





<?php 
include('include-footer.php');
?>


<script>
	

(function() {

	'use strict';
  
  // click events
  document.body.addEventListener('click', copy, true);

	// event handler
	function copy(e) {

    // find target element
    var 
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);
      
    // is element selectable?
    if (inp && inp.select) {
      
      // select text
      inp.select();

      try {
        // copy text
        document.execCommand('copy');
        inp.blur();
        
        // copied animation
        t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
      
    }
    
	}

})();

</script>


</body>
</html>