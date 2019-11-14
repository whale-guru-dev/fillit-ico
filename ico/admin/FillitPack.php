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

        <h3 class="page-title uppercase bold"> View Deposit Packages

            <!--a href="<?php echo $adminurl; ?>/FillitPack" class="btn btn-primary btn-md pull-right">

                <i class="fa fa-plus"></i>   ADD NEW

            </a-->

        </h3>

        <hr>





        <div class="row">

            <div class="col-md-12">

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

                                <th> Name </th>

                                <th> Coins </th>

                                <th> Price </th>

                                <th> Bonus </th>

                                <th> Action </th>

                            </tr>



                            </thead><tbody>



                            <?php

                            $ddaa = $db->query("SELECT id, name, minamo, maxamo, val1, val2, status FROM deposit_packages ORDER BY id");

                            while ($data = $ddaa->fetch()){



                                echo "                                

<tr id='$data[0]'>



<td>$data[0]</td>

<td>$data[1]</td>

<td><b>$basecur $data[3]</b></td>

<td><b>EUR  $data[5]</td>

<td><b> $data[4]%</b></td>

<td>







<a href=\"$adminurl/EditFillitPack/$data[0]\"><button class=\"btn purple btn-sm\"> <i class=\"fa fa-edit\"></i> EDIT</button></a>





<!--button type=\"button\" class=\"btn btn-danger btn-sm delete_button\" 

data-toggle=\"modal\" data-target=\"#DelModal\"

data-id=\"data[0]\">

<i class=\"fa fa-times\"></i>  DELETE

</button-->



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

                    frm: "packs"

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