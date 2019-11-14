<?php
Include('include-global.php');
$pagename = "Dashboard";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Refferals for FILLITCROWD";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">

<?php
Include('include-navbar-user.php');

$counta = $db->query("SELECT ref_id FROM users WHERE email='".$_SESSION['username']."' ")->fetch();

$count = $db->query("SELECT email,mallu,id FROM users WHERE ref_by='".$counta[0]."' ",PDO::FETCH_ASSOC)->fetchAll();
?>


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-list"></i> Referral System </div>
    </div>

    <div class="portlet-body">
        <center>
      <h1><label for="#link">Share this link</label></h1>
            <p>For every purchase that your referral does you will get 10% bonus.</p>
            <input style="width: 280px;
    background-color: #3598dc;
    border-radius: 25px;
    border: 1px #3598dc;
    color: white;
    height: 52px;
    padding: 18px;
    font-size: 20px;
;" id="#link" type="text" class="" value="www.fillit.eu/ico/r/<?php echo $counta[0]; ?>" readonly="readonly"><br>
           <H1>Referral Banner</H1> <br>
            <img src="../assets/images/logo.png" style="width:40%;"><br>
          <h2>Embeddable code</h2>  <br>
            <textarea readonly="readonly" rows="6" style="width:30%;"><a href="https://www.fillit.eu/ico/r/<?php echo $counta[0]; ?>"><img src="https://www.fillit.eu/ico/assets/images/logo.png" style="width:40%;"></a></textarea>
        <div class="panel-group accordion" id="accordion1">
            <hr>
            <h2>Your referrals so far</h2>
            <div class="table-scrollable">
                <table class="table table-bordered table-hover">
                    <tbody>
                    <?php


                    ?>

                    <tr>
                        <td><strong style="font-size: 1.5em;" >E-mail</strong> </td>
                        <td> <strong style="font-size: 1.5em;">Coins Received</strong></td>
                    </tr>
                    <?php foreach($count as $om){
                        $coinx = $db->query("SELECT many FROM trx WHERE who='".$om['id']."' ",PDO::FETCH_ASSOC)->fetchAll();

        //print_r($coinx);
        $total='';
        foreach($coinx as $intrare){
            $total+=$intrare['many'];

        }
                        ?>

                    <tr class="">
                        <td><strong style="font-size: 1.5em;" ><?php echo $om['email'] ?></strong> </td>
                        <td> <strong style="font-size: 1.5em;"><?php echo (10/100 * $total); ?></strong></td>
                    </tr>
                    <?php } ?>







                    </tbody>
                </table>
            </div>
        </center>
        </div>
    </div>
</div>

<?php
include('include-footer.php');
?>
</body>
</html>
