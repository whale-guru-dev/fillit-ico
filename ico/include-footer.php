

  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container">



 <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12 footer-block">
                   

<img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="**" class="alignleft" style="width: 100%; filter: brightness(0) invert(1);">

<div class="social-icons">
            <ul>

<?php
$ddaa =$db->query("SELECT id, icon, url FROM social ORDER BY id");
while ($data = $ddaa->fetch()){

echo "<li><a href=\"$data[2]\" target=\"_blank\"><i class=\"fa fa-$data[1]\"></i></a></li>";
}
?>
            </ul>
          </div>

                    </div>

<?php 
$txt = $db->query("SELECT heading, btxt FROM home_text WHERE id='4'")->fetch();
$old = $db->query("SELECT cemail, cmobile, clocation FROM general_setting WHERE id='1'")->fetch();
?>
<div class="col-md-6 col-sm-4 col-xs12">
<h4><?php echo $txt[0]; ?></h4>
<p><?php echo $txt[1]; ?></p>
</div>
                   
<div class="col-md-3 col-sm-4 col-xs-12">
<h4>Contact us</h4>
<address>
<i class="fa fa-phone"></i>  <?php echo $old[1]; ?> <br>
<i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $old[0]; ?>"><?php echo $old[0]; ?></a><br>
<i class="fa fa-map-marker"> </i>  <?php echo $old[2]; ?><br>
</address>
</div>


                </div>



      </div>
    </div>

            <div class="page-footer">
            <div class="container"> <?php echo date("Y"); ?> &copy; <a href="#"><?php echo $basetitle; ?></a>. All Right Reserved
            </div>
        </div>
  </footer>

<script type="text/javascript" src="<?php echo $fronturl; ?>/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $fronturl; ?>/assets/js/fakeLoader.js"></script>
<script type="text/javascript" src="<?php echo $fronturl; ?>/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $fronturl; ?>/assets/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo $fronturl; ?>/assets/js/main.js"></script>


<script type="text/javascript">
$("#fakeLoader").fakeLoader({
timeToHide:1200, //Time in milliseconds for fakeLoader disappear
zIndex:"999",//Default zIndex
spinner:"spinner2",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
bgColor:"#<?php echo $basecolor; ?>", //Hex, RGB or RGBA colors
imagePath:"<?php echo $fronturl; ?>/assets/images/logo.png" //If you want can you insert your custom image

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

</body>
</html>