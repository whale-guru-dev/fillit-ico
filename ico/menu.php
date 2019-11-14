<?php
Include('include-global.php');

$iidd = $_GET['id'];
$menudata = $db->query("SELECT name, btext FROM menus WHERE id='".$iidd."'")->fetch();
$pagename = "$menudata[0]";
$title = "$pagename - $basetitle";
Include('include-header.php');
?>
</header><!--/#home-->



  <section style="margin-top: 40px;">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-12">
            <h2 class="uppercase bold bottom-line"><?php echo $menudata[0]; ?></h2>
				<?php echo $menudata[1]; ?>
          </div>
        </div> 
      </div>
    </div>
  </section>


<?php 
include('include-footer.php');
?>
</body>
</html>