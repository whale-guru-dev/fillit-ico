<?php

//--------------------------------
// @author: Băcilă Andrei        |
//            (an4rei)           |
// @IDE: phpStorm                |
// @skype: freerunningparkour    |
//--------------------------------
/*

                                 ,--,
                               ,--.'|
                            ,--,  | :                   ,--,
                   ,---, ,---.'|  : '  __  ,-.        ,--.'|
               ,-+-. /  |;   : |  | ;,' ,'/ /|        |  |,
   ,--.--.    ,--.'|'   ||   | : _' |'  | |' | ,---.  `--'_
  /       \  |   |  ,"' |:   : |.'  ||  |   ,'/     \ ,' ,'|
 .--.  .-. | |   | /  | ||   ' '  ; :'  :  / /    /  |'  | |
  \__\/: . . |   | |  | |\   \  .'. ||  | ' .    ' / ||  | :
  ," .--.; | |   | |  |/  `---`:  | ';  : | '   ;   /|'  : |__
 /  /  ,.  | |   | |--'        '  ; ||  , ; '   |  / ||  | '.'|
;  :   .'   \|   |/            |  : ; ---'  |   :    |;  :    ;
|  ,     .-./'---'             '  ,/         \   \  / |  ,   /
 `--`---'                      '--'           `----'   ---`-'
*/




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

        <h3 class="page-title uppercase bold"> Send EMAIL








<a href="<?php echo $adminurl; ?>/" class="btn btn-success btn-md">

<i class="fa fa-list"></i>  Back

</a>

</span>

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

                                $iidd = $_GET["id"];
                                $old = $db->query("SELECT mobile, firstname, lastname, email FROM users WHERE id='".$iidd."'")->fetch();
                                $namex=$old[1].' '.$old[2];
                                if($_POST){



                                if(empty($_POST['smscontent'])){
                                    $error=1;
                                }else{
                                    $error=0;
                                }



                                    if ($error == 0){

                                     $canci = abiremail($old[3],$_POST['title'],$namex,$_POST['smscontent']);




                                            notification("EMAIL sent successfully !", "", "success", false, "btn-success", "OKAY");





                                    } else {


                                            notification("There was a problem when sending the EMAIL!", "Please Check..", "error", false, "btn-success", "OKAY");



                                    }





                                }//post











                                ?>



                                <div class="alert alert-info" style="text-transform: uppercase;">

                                    You are sending a EMAIL to address <?php echo $old[3]; ?>.<br>




                                </div>
                                First Name: <?php echo $old[1]; ?><br>
                                Last Name: <?php echo $old[2]; ?><br>
                                Phone: <?php echo $old[0]; ?>
                                <br><br><br>















                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Subject</strong></label>

                                    <div class="col-md-12">

                                        <input  type="text" placeholder="From Fillit Crowd team" class="form-control" name="title">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-md-12"><strong style="text-transform: uppercase;">Content</strong></label>

                                    <div class="col-md-12">

                                        <textarea  placeholder="Hello!" class="form-control" rows="3" name="smscontent"></textarea>

                                    </div>

                                </div>

























                                <br>

                                <br>

                                <br>



                                <div class="row">

                                    <div class="col-md-12">

                                        <button type="submit" class="btn blue btn-block btn-lg">SEND EMAIL</button>

                                    </div>

                                </div>





                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div><!---ROW-->









    </div>

</div>

<?php

include ('include/footer.php');

?>

</body>

</html>