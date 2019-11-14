<?php
Include('include-global.php');
$pagename = "Deposit  Preview";
$title = "$pagename - $basetitle";
Include('include-header.php');
$subtitle = "Add Money To Your $basetitle Account";
?>
</head>
<body class="page-container-bg-solid page-header-menu-fixed page-boxed">
<?php
Include('include-navbar-user.php');
?>


<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-desktop"></i> EXCHANGE RATES </div>
    </div>

    <div class="portlet-body">

        <label for="cryptocoin">Coin</label>
        <select class="form-control" id="cryptocoin">
            <option value="--">Select Coin</option>
            <option value="BTC">Bitcoin</option>
            <option value="LTC">Litecoin</option>
            <option value="XRP">Ripple</option>
            <option value="BCC">Bitcoin cash</option>
            <option value="DASH">Dash</option>
            <option value="CURE">Curecoin</option>
            <option value="DOGE">Dogecoin</option>
            <option value="ETC">Ether classic</option>
            <option value="ETH">Ether</option>
            <option value="GLD">Goldcoin</option>
            <option value="XMR">Monero</option>
            <option value="ZEC">Zcash</option>
        </select>


<div style="text-align:center;">
<h1><span id="finalreza">Please select a coin</span> </h1><br>
<h3><span id="finalrez"></span> </h3></div>
</div>
</div>
<?php
include('include-footer.php');

?>


    <script>
        $(document).ready(function() {

            $('#cryptocoin').on('change', function() {
                var coinselected = $("#cryptocoin option:selected").val();

                document.getElementById("finalreza").innerHTML = 'Price for 1 '+ coinselected +' is';
                $('#finalrez').html('<img width=25px id="loader" src="assets/kloader.gif" />');
                $("#cryptocoin").attr('disabled', 'disabled');
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: {
                        'getrate2': 'yes',
                        'type': coinselected,
                        'val': 1
                    },
                    success: function (msg) {
                        document.getElementById("finalrez").innerHTML = msg;
                        $("#cryptocoin").removeAttr('disabled');
                    }
                });
            });
        });

    </script>

</body>
</html>