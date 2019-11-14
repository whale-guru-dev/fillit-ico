
</div>
</div>
</div>
</div>
</div>
<div class="page-prefooter">
<div class="container">
<div class="row">
<div class="col-md-3 col-sm-4 col-xs-12 footer-block">
<img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="**" class="alignleft" style="width: 100%; filter: brightness(0) invert(1);">

<div class="social-iconssss">
<ul>

<?php
$ddaa =$db->query("SELECT id, icon, url FROM social ORDER BY id");
while ($data = $ddaa->fetch()){

echo "<li><a href=\"$data[2]\" target=\"_blank\"><i class=\"fa fa-$data[1]\"></i> </a></li>";
}
?>
</ul>
</div>


</div>

<?php 
$txt = $db->query("SELECT heading, btxt FROM home_text WHERE id='4'")->fetch();
$old = $db->query("SELECT cemail, cmobile, clocation FROM general_setting WHERE id='1'")->fetch();
?>

<div class="col-md-6 col-sm-4 col-xs12 footer-block">
<h2><?php echo $txt[0]; ?></h2>
<p><?php echo $txt[1]; ?></p>
</div>

<div class="col-md-3 col-sm-4 col-xs-12 footer-block">
<h2>Contacts</h2>
<address>
<i class="fa fa-phone" style="color: #ccc;"></i>  <?php echo $old[1]; ?> <br>
<i class="fa fa-envelope-o" style="color: #ccc;"></i> <a href="mailto:<?php echo $old[0]; ?>"><?php echo $old[0]; ?></a><br>
<i class="fa fa-map-marker" style="color: #ccc;"></i>   <?php echo $old[2]; ?><br>


</address>
</div>
</div>
</div>
</div>
<div class="page-footer">
<div class="container"> <?php echo date("Y"); ?> &copy; <a href="#"><?php echo $basetitle; ?></a>. All Right Reserved
</div>
</div>
<div class="scroll-to-top">
<i class="fa fa-arrow-circle-o-up"></i>
</div>


<script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/layout.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?php echo $baseurl; ?>/assets/js/bootstrap-toggle.min.js"></script>




<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>




<script>
// make The Link Active 

$(function() {
var pgurl = window.location.href;
$('.navbar-nav li a').each(function(){

   var myHref= $(this).attr('href');
   if( pgurl == myHref) {
        $(this).parent().addClass("active");
   }

        });
             });
</script>
<?php

if(!isset($uid)){
    $uid=0;
}

if(!isset($plax)){
    $plax=0;
}
?>
<script>
    $(document).ready(function() {


        var balanta = $("#balanceex");
        if(balanta.length){
        setInterval(function(){


            $.ajax({
                type: 'POST',
                url: 'ajax.php',
                data: {
                    'coi': '<?php echo $uid ?>',
                    'coi2': '<?php echo $plax[0]; ?>'
                },
                success: function (msg) {
                    balanta.text(msg);
                    //$("#cryptocoin").removeAttr('disabled');
                }
            });
        }, 3000); }
    });

</script>
<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
    window.__lc = window.__lc || {};
    window.__lc.license = 9306400;
    (function() {
        var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
        lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
    })();
</script>
<!-- End of LiveChat code -->
