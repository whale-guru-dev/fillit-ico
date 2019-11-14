<?php include 'header.php';

$date = $db->query("SELECT SUM(mallu) as xo FROM users")->fetchAll();
//print_r($date);
?>


    
<style>
    .tp-leftarrow{
        display:none;
    }
    .tp-rightarrow{
        display:none;
    }
</style>
    <section id="slider">
        <div id="rev_slider_484_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery" style="background-color:transparent;padding:0px;">
            <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
            <div id="rev_slider_484_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
                <ul>
                    <!-- SLIDE  -->
                    <li data-index="rs-2800" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="assets/img/5.2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="assets/img/5'.jpg" alt="" data-bgposition="center center" data-bgfit="cover" class="rev-slidebg">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-shape tp-shapewrapper "  data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"from":"opacity:0;","speed":500,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"speed":5000,"to":"opacity:0;","ease":"Power4.easeInOut"}]'  style="z-index: 5;background-color:rgba(0, 0, 0, 0.30);border-color:rgba(0, 0, 0, 0);border-width:0px;"></div>

                        <div class="tp-caption rev-btn  tp-resizeme" id="slide-2800-layer-5" data-x="['left','left','center','center']" data-hoffset="['500','480','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['340','340','224','207']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"scrollbelow","offset":"px","delay":""}]' data-responsive_offset="on" data-frames='[{"from":"x:50px;opacity:0;","speed":2500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"},{"frame":"hover","speed":"150","ease":"Power2.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(0, 0, 0, 1.00);bg:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 0);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]" style="z-index: 11; white-space: nowrap; font-size: 18px; line-height: 46px; font-weight: 700; color: rgba(255, 255, 255, 1.00);font-family:Arial, Helvetica, sans-serif;background-color:rgba(0, 0, 0, 0);border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;border-radius:4px 4px 4px 4px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;letter-spacing:5px;cursor:pointer;">Join Presales
                        </div>
                    </li>

                </ul>

                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </section>

    <!-- Section Content -->
    <section id="investor" class="g-py-30 g-py-30--md g-pt-60--md g-pt-60">
        <div class="container text-center u-bg-overlay__inner">
            <div class="text-uppercase text-center u-heading-v2-3--bottom g-brd-primary g-mb-20">
                <h2 class="u-heading-v2__title g-font-weight-200 mb-0">Fill your pocket with FILLIT</h2>
            </div>
            <div class="col-lg-8 offset-lg-2 timer-area">

                <h3 class="text-center top-heading">First presale period ends in</h3>

                <div class="clock"></div>
                <div class="message"></div>
            </div>
            <div class="row">
                <div class="col-sm-12 g-py-30 g-py-30--md" data-animation="fadeInRight" data-animation-duration="1750">
                    <ul class="token-info text-center ">
                        <li>
                            <h2 class="h1">Total Tokens Bought</h2>
                        </li>
                        <li>
                            <h2><?php echo number_format($date[0]['xo']+3000000, 0, '.', ','); ?></h2>
                        </li>
                        <li><small>1 FILL = 0.08 EUR</small>
                        </li>
                    </ul>

                    <a href="https://www.fillit.eu/ico/account/Register" class="btn btn-md u-btn-outline-red u-btn-hover-v2-2 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mb-15">
                        Buy Tokens <i class="fa fa-hand-o-up g-ml-3"></i>
                    </a>


                    <p class="g-mb-30">Bonuses will depend on the volume of ICOs you buy. The scale is progressive. The more ICO you buy in a transaction the higher the bonus amount you will receive.
                    </p>

                </div>
            </div>
        </div>

    </section>
    <!-- End Section Content -->



    <section class="bg-image-area g-py-40 g-py-80--md" style="background-image: url('assets/img/card.jpg');">

        <div class="container text-center g-py-50--md g-py-20">
            <h2 class="h2 text-uppercase g-font-weight-300">Visit our main website
            </h2>
            <p class="lead g-px-100--md g-mb-20">
                www.fillit.eu</p>

            <a href="https://www.fillit.eu/index.php" class="btn btn-md u-btn-red u-btn-hover-v1-4 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50 g-mr-10 g-mb-15">
                <i class="fa fa-check-circle g-mr-3"></i> Visit
            </a>

        </div>
    </section>


    <!-- Section Content -->
    <section id="whyWe">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-md-6 d-flex g-theme-bg-gray-light-v4 g-py-30 g-py-80--md g-px-30">
                    <div class="align-self-center" data-animation="fadeInLeft" data-animation-duration="1750">
                        <div class="text-uppercase u-heading-v2-3--bottom g-brd-primary g-mb-20">
                            <h3 class="g-font-weight-300 g-font-size-30 g-color-primary g-mb-20"><span class="sp-font">FILLIT</span></h3>
                            <h2 class="u-heading-v2__title g-font-weight-200 mb-0">TODAY AND TOMORROW</h2>
                        </div>

                        <p class="g-mb-20">It connects the present and the future
                            FILLIT is a modern art, an easy and convenient service, available from any device with a fully functional Android and / or iOS version. Users have a FILLIT multi-currency FIAT wallet and a private key that is kept to protect their funds. The FILLIT wallet can be loaded instantly with cruptocurrencies.

                        </p>

                        <p class="g-mb-20">With the innovations of the FILLIT Crypto / Debit Visa Card, CryptoBanking becomes available to anyone, with features such as enhanced security and simplicity of use that make it flawless. Users can upload their card from their wallet and choose between different cryptocurrencies (BTC, ETH, ERC20, etc.) to make their payments.</p>
                        <p class="g-mb-20">FILLIT seeks credibility and durability. For this reason, it rewards the FILLIT ICO owners after each payment made by FILLIT Crypto / Debit Visa Card users as a whole.
                        </p>
                        <p class="g-mb-20">FILLIT now owns its own ICO (FILLIT ICO), which is due to start in November of 2017, with an initial sales value of EU €0.04 per FILLIT ICO.You can send us your orders to <em style="color: #e74c3c;">co@fillitcrowd.eu</em>
                        </p>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-brd-bottom g-theme-brd-gray-dark-v4 g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-magic-wand g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">Branding and identity</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">Here is the legendary innovation in ICO Investment through simplicity usage of cryptocurrencies

                                </p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-brd-bottom g-theme-brd-gray-dark-v4 g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-globe-alt g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">FILLIT Worldwide</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">FILLIT is the synonym for worldwide trading and offers flexibility, freedom, speed and economy.</p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>

                    <div class="g-parent g-theme-bg-gray-dark-v1 g-theme-bg-gray-dark-v2--hover g-overflow-x-hidden g-transition-0_2 g-transition--ease-in">
                        <!-- Icon Blocks -->
                        <article class="media d-block d-md-flex text-center text-md-left g-py-30 g-py-70--md g-pl-30 g-pl-60--md g-pr-30" data-animation="fadeInRight" data-animation-duration="1750">
                            <div class="d-md-flex align-self-center g-mb-30 g-mb-0--md g-mr-30--md">
                            <span class="u-icon-v2 u-icon-size--2xl g-color-primary-dark-v1 g-brd-4 g-theme-brd-gray-dark-v3 g-brd-primary-dark--parent-hover g-rounded-50x">
                      <i class="icon-line icon-target g-font-size-35"></i>
                    </span>
                            </div>

                            <div class="media-body align-self-center">
                                <h3 class="h6 text-uppercase g-font-weight-300 g-font-secondary g-color-white">FILLIT Goal</h3>
                                <p class="g-color-white-opacity-0_5 mb-0">FILLIT accurately accomplishes every goal and grows steadily and dynamically.</p>
                            </div>
                        </article>
                        <!-- End Icon Blocks -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section Content -->

    <section class="js-bg-video g-flex-centered g-height-500 g-color-white u-bg-overlay g-bg-black-opacity-0_6--after g-py-20" style="background-image: url(&quot;assets/img-temp/1920x1080/img1.jpg&quot;); position: relative;" data-hs-bgv-path="assets/media-temp/video-bg/video-bg" data-hs-bgv-loop="1">
        <video class="hs-html5 hs-bg-video" poster="" autoplay="" muted="" loop="">
            <source src="assets/media-temp/video-bg/video-bg.mp4" type="video/mp4"></source>
            <source src="assets/media-temp/video-bg/video-bg.webm" type="video/webm"></source>
            <source src="assets/media-temp/video-bg/video-bg.ogv" type="video/ogg"></source>Your browser doesn't support HTML5 video.
        </video>
        <div class="container u-bg-overlay__inner">
            <div class="row">
                <div class="col-md-6 offset-md-6 align-self-center g-py-20">
                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0">FOR THOSE WHO DIDN’T KNOW ABOUT ICO’S</h2>
                    </div>
                    <p class="lead mb-0 g-line-height-2">Now that concepts such as Ewallet, cryptocurrency, ICO, blockchain, DLN (Decentralization Mechanism) have been embedded in your mind, it is becoming apparent that a new Online Investment World is unfolding in front of you! Be sure that the most fair and transparent way of investing is ICO and particularly FILLIT ICO! FILLIT in complete consciousness, offers access to all information regarding structure, rates, commissions, etc., as long as you refer to Whitepaper (link). We will be glad to give you even more information by email.</p>
                    <p class="lead mb-0 g-line-height-2">Take advantage of the information from the emerging industry of FILLIT ICO and win what you have avoided to date!</p>
                </div>

            </div>
        </div>
    </section>




    <section class="promo-area g-flex-centered g-bg-primary g-color-white-opacity-0_9 g-py-30 ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center g-py-20">
                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-white g-mb-20" data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="1000">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0 ">FOR DIGITAL GENERATION, FOR THE DEVELOPMENT OF BLOCKCHAIN</h2>
                    </div>
                    <div data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="1000">
                        <p class="lead mb-0 g-line-height-2">
                            Improved spending conditions, fast money sending abroad and other innovative services!</p>
                        <p class="lead mb-0 g-line-height-2">If you are an entrepreneur and often make bulk payments, then Fillit and you are on the same route!</p>
                        <p class="lead mb-0 g-line-height-2">Thanks to the strong base for developing multi-currency products, bridge the gap between Crypto and Fiat's coins in daily life following the principle of decentralization.</p>
                        <p class="lead mb-0 g-line-height-2">Multiple payment settings are especially useful for you as they help you make payments to multiple recipients at the same time saving time, money and other unnecessary costs.</p>
                    </div>
                </div>

                <div class="col-md-6 align-self-center">
                    <img class="w-100 img-fluid img-thumbnail" src="assets/img/blackchain.jpg" alt="Iamge Description" data-animation="fadeInUp" data-animation-delay="150" data-animation-duration="1000">
                </div>
            </div>
        </div>
    </section>

    <section class="promo-area g-flex-centered g-bg-primary g-color-white-opacity-0_9 g-py-30">
        <div class="container">
            <div class="row direction-mb">
                <div class="col-md-6 align-self-center g-py-20  float-sm">

                    <div class="text-uppercase g-color-white u-heading-v2-3--bottom g-brd-white g-mb-20" data-animation="fadeInUp" data-animation-delay="100" data-animation-duration="2000">
                        <h2 class="h4 u-heading-v2__title g-color-white g-font-weight-200 mb-0">DECENTRALIZATION AND BLOCKCHAIN</h2>
                    </div>
                    <div data-animation="fadeInUp" data-animation-delay="150" data-animation-duration="1000">
                        <p class="lead mb-0 g-line-height-2">The decentralized mechanism, developed by Fillit to make flexible and faster payments, provides customers with sufficient liquidity and minimization of any risk, by using a decentralized liquidity (DLN) network. Because of DLN, network participants interact securely with each other and at the same time make payments with any blockchain element and any currency in the fastest, cheaper and more transparent way.</p>
                        <p class="lead mb-0 g-line-height-2">FILLIT ICO came to redefine the concepts of transparency, transaction speed, currency conversion, capital transfer!</p>
                    </div>
                </div>

                <div class="col-md-6 align-self-center g-py-20">
                    <img class="w-100 img-fluid img-thumbnail" src="assets/img/decent.jpg" alt="Iamge Description" data-animation="fadeInUp" data-animation-delay="250" data-animation-duration="1000">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Info #01 -->
    <section class="text-center g-py-60--md g-py-70 what-ico-area">
        <div class="container">
            <div class="u-heading-v2-5--bottom g-brd-primary g-mb-30">
                <h2 class="u-heading-v2__title text-uppercase g-font-weight-300 mb-0">FILLIT ICO – WHAT IS IT</h2>
            </div>

            <p class="lead g-px-60--md g-mb-40">
                <span class="g-color-primary">FILLIT ICO</span> is a tantalizing proposal by Fillit in order to secure the funds needed to further develop and expand its work. The FILLIT ICO market is a safe way of increasing the funds of potential investors and at the same time a carefully documented way of financing and expanding an existing product and service. Each sale of FILLIT ICO is governed by the Terms and Conditions and constitutes a separate document describing the terms of the agreement between the investors and the holders of FILLIT ICO.

                <img class="img-fluid" src="assets/img/maps/map1.png" alt="Image description">
        </div>
    </section>
    <!-- End Hero Info #01 -->



    <!-- Subscribe   -->
    <form autocomplete="off" action="https://fillitcrowd.us17.list-manage.com/subscribe/post?u=2d46739889581169f0d197a8c&amp;id=f7e1276bb0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"  target="_blank" novalidate>

        <section class="g-bg-primary-dark-v1 g-color-white g-pa-40 subscribe-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 align-self-center">

                        <h2 class="h4 text-uppercase g-font-weight-300 g-mb-20 g-mb-0--lg">Subscribe to our weekly
                            <strong class="g-color-white">Newsletter</strong></h2>
                    </div>

                    <div class="col-lg-5 align-self-center">
                        <div class="input-group">
                            <div class="input-group-addon g-color-white g-bg-transparent g-brd-white rounded-0">
                                <i class="fa fa-envelope"></i>
                            </div>

                            <input name="EMAIL" class="form-control pl-0 u-form-control g-brd-left-none g-placeholder-white g-color-white g-bg-transparent g-bg-transparent--focus g-brd-white rounded-0 g-mr-15" placeholder="Your e-mail" type="text">
                            <div class="input-group-btn">
                                <input type="submit" class="btn btn-md u-btn-white u-btn-hover-v1-4 g-font-weight-300 g-letter-spacing-0_5 text-uppercase g-brd-2 g-rounded-50" value="Submit" >
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!-- Subscribe End  -->


    <!-- Hero Info #11 -->
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
        <!-- Parallax Image -->
        <div class="divimage dzsparallaxer--target w-100 g-bg-repeat" style="height: 160%; background-image: url('assets/img/bg/pattern4.png'); transform: translate3d(0px, -306px, 0px);"></div>
        <!-- End Parallax Image -->

        <div class="container g-py-150--md g-py-80">
            <div class="row">
                <div class="col-md-6 align-self-center g-mb-60 g-mb-0--md">

                    <div class="text-uppercase g-color-balck u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h1 text-uppercase g-color-black g-font-weight-300 g-mb-0">PROFIT SHARE</h2>
                    </div>
                    <p class="lead g-mb-30 g-color-black">30% of corporate profits are distributed to Tokens holders. Each owner receives a profit share depending on the number of Tokens purchased. Payments are made in the FILLIT wallet.</p>
                </div>
                <div class="col-md-6 align-self-center g-mb-60 g-mb-0--md">
                    <div class="text-uppercase g-color-balck u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="h1 text-uppercase g-color-black g-font-weight-300 g-mb-0">FINANCIAL REPORTING</h2>
                    </div>
                    <p class="lead g-mb-30 g-color-black">Access to reports is determined by the number of originally purchased Tokens. Participants who hold Tokens worth more than € 30,000 have access to real-time FILLIT statistics while annual reports are available to other Token holders.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Info #11 -->

    <div class="tecno-area g-bg-lighgray-radialgradient-ellipse g-py-30--md g-py-30">
        <!-- Nav tabs -->


        <div class="container u-heading-v2-5--bottom g-brd-primary g-mb-30  text-center g-py-50--md g-py-20">
            <h2 class="u-heading-v2__title text-uppercase g-font-weight-300 mb-0">FILLIT TECHNOLOGIES</h2>
        </div>
        <div class="container">
            <ul class="nav u-nav-v8-2" role="tablist" data-target="nav-8-2-default-hor-left" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-darkgray">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#nav-8-2-default-hor-left--1" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-users"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">MULTIPLE BOND ACCOUNT </strong>
                        <em class="u-nav-v8__description">FOR BANK TRANSPORT</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--2" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-credit-card-alt"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">FILLIT PREPAID</strong>
                        <em class="u-nav-v8__description">PLASTIC DEBIT VISA CARD</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--3" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-cc-visa"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">VIRTUAL PREPAID</strong>
                        <em class="u-nav-v8__description">VISA FILLIT CARD</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--4" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-file-text"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">PAYMENT</strong>
                        <em class="u-nav-v8__description">VOLUME</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--5" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-credit-card"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">PAYMENTS ON</strong>
                        <em class="u-nav-v8__description">ANY CARD</em>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-8-2-default-hor-left--6" role="tab">
                    <span class="u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white">
      <i class="fa fa-superpowers"></i>
    </span>
                        <strong class="text-uppercase u-nav-v8__title">AFFILIATE</strong>
                        <em class="u-nav-v8__description">PROGRAM</em>
                    </a>
                </li>
            </ul>
            <!-- End Nav tabs -->

            <!-- Tab panes -->
            <div id="nav-8-2-default-hor-left" class="tab-content g-pt-20">
                <div class="tab-pane fade show active" id="nav-8-2-default-hor-left--1" role="tabpanel">

                    <p>It allows you to accept bank transfers without the need to open a bank account</p>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Fully indirect opening of accounts of multiple currencies

                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> 0% commission for bank transfers
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> A complete alternative to the traditional current bank account
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> High trading limits
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> There are no installation fees and monthly maintenance fees are only € 1.00
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Full electronic application process and approval of this is done within 48 hours
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--2" role="tabpanel">
                    <p>This is a Fillit prepaid Visa debit card, offering an unlimited payment experience</p>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Currencies USD, EUR, GBR

                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Daily take-off limit at ATM 2000 euro or equivalent 7 days a week
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Direct credit from the Fillit account
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Load through bank transfer
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Just € 2.25 per withdrawal at ATM
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> The most cost effective and efficient multi-payment direct payment solution
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Delivery in 10 business days
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--3" role="tabpanel">
                    <p>A unique multi-currency payment option that allows users to make online purchases without risk</p>

                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Instant issuance

                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Rechargeable and valid for 3 years
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Maximum balance of 150,000 euros
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Transactions in multiple currencies
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Secure online payments with 3D security
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Cost-effective direct payment solution
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Direct funding from the Fillit payment account
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--4" role="tabpanel">
                    <p>A convenient solution that helps you save time</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> 0.25€ transfer fee to other Fillit accounts worldwide
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> High trading limits
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Transfers of multiple currencies
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Payments to bank accounts
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Payments to Fillit prepaid cards
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Daily support
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> User-friendly with a simple environment
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> An easy way for everyone to pay wages and payments to connected companies
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Uploading a contact list to xls or csv
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--5" role="tabpanel">
                    <p>A useful choice for the crypto-community that allows you to pay in cryptocurrency to any VISA / MASTERCARD card worldwide.</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> No registration required
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Transaction limit up to € 2.000 to 5 transactions per day
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> You do not need to install any other software
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Immediate processing and settlement within 1-3 days
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-8-2-default-hor-left--6" role="tabpanel">
                    <p>It is a tool that allows affiliates to make profits by promoting Fillit. This program may be of interest to web site owners or blogs, affiliates, and those who spend a lot of time on social networks, forums, chats etc</p>


                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-unstyled g-color-gray-dark-v4 g-mb-30 g-mb-0--sm">
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Available for both individual and corporate partners
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> You can earn 15% of service revenues for each client you attract
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> You can earn 20% of service revenue for corporate accounts
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Get paid for any money-making activity by exchanging information about FILLIT
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Ready content to share with your own affiliate link
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Money earned is automatically deposited in your balance on the 5th of each month
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Profits can be transferred to a bank account or FILLIT wallet
                                </li>
                                <li class="d-flex g-mb-10">
                                    <i class="icon-check g-color-primary g-mt-5 g-mr-10"></i> Customized conditions for high volume traders and presenters
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Tab panes -->

    </div>

    <!-- Partner -->
    <section class="clients-area g-pt-30 g-pt-80--md">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-uppercase text-center u-heading-v2-3--bottom g-brd-primary g-mb-20">
                        <h2 class="u-heading-v2__title g-font-weight-200 mb-0">OUR PARTNERS</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="carousel3" class="js-carousel" data-autoplay="1" data-slides-show="1">
        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

            <!-- Testimonials Advanced -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <a href = "https://www.wavecrest.gi/">
                        <img class="mx-auto g-width-200" src="assets/img/wavecrest.jpg" alt="Image Description">
                        </a>
                        <blockquote class="lead g-line-height-1_8 g-mb-25">" Thank you so much for our excellent collaboration so far. You are the people who can rely on them and we really believe that this relationship between us will not cease to exist. Thank you again for your services and your interest in us. "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
            <!-- End Partner Advanced -->
        </div>

        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

            <!-- Partner Advanced -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <br>
                        <a href = "https://www.infobip.com/">
                        <img class="mx-auto g-width-200" src="https://www.infobip.com/assets/img/infobip-logo-white.svg" alt="Image Description">
                        </a>
                        <br>
                        <blockquote class="lead g-line-height-1_8 g-mb-25">"We had provided FILLIT with new, innovative solutions to increase account security and the ability to verify clients during service registration.
For us, security is a top priority and our reliable partnership with Infobip, the world’s top A2P SMS provide, minimizes the risk of account fraud."</blockquote>
                        <br>        
                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                        <br>
                    </div>
                </div>
            </div>
            <!-- End Partner Advanced -->
        </div>

   
        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <img class="mx-auto g-width-200" src="assets/img/caf solutions.png" alt="Image Description">


                        <blockquote class="lead g-line-height-1_8 g-mb-25">" With great happiness, we appreciate the excitement you have shown for our company. We thank you all for your active participation and successful effort. "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
           
        </div>
 
        <div class="js-slide g-brd-around g-brd-gray-light-v3--hover g-transition-0_2 rounded g-pa-20 g-mx-10">

           
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <a href="http://www.glbdigital.eu/">
                        <img class="mx-auto g-width-200" src="assets/img/global.png" alt="Image Description">
                        </a>
                        <br>
                        <blockquote class="lead g-line-height-1_8 g-mb-25">" The GLOBAL DIGITAL Team is a well-organized team of successful managers / consultants in the Cryptocurrencies and Crypto-Economy, ready to share their expertise knowledge and experience with you! "</blockquote>

                        <div class="js-rating align-self-center g-color-yellow" data-rating="5" data-spacing="5" data-backward-icons-classes="fa fa-star"></div>
                    </div>
                </div>
            </div>
            
        </div>
    
    </div>



    <!-- Partner END -->


<?php include 'footer.php';?>