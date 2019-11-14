<?php include 'header.php';?>

<!-- Banners -->
<style>
    .dzsparallaxer:not(.mode-oneelement) {
        height: 400px!important;
    }
    .investor-btn {
        display: none!important;
    }
</style>
<section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall" data-options="{direction: 'reverse', settings_mode_oneelement_max_offset: '150'}">
    <!-- Parallax Image -->
    <div class="divimage dzsparallaxer--target w-100 g-bg-size-cover" style="height: 130%; background-image: url('assets/img/contact.jpg'); transform: translate3d(0px, -101.261px, 0px);"></div>
    <!-- End Parallax Image -->

    <div class="container text-centers g-z-index-1 g-py-200">
        <h1 class="g-color-white g-font-weight-700 g-font-size-60 g-mb-25">Πως μπορούμε να σας βοηθήσουμε; </h1>
    </div>
</section>
<!-- End Banners -->



<section class="container g-pt-100 g-pb-40">
    <div class="row justify-content-between">
        <div class="col-lg-7 g-mb-60">
            <div class="text-uppercase  u-heading-v2-3--bottom g-brd-primary g-mb-20">
                <h2 class="u-heading-v2__title g-font-weight-200 mb-0">Επικοινωνήστε</h2>
            </div>
            <hr class="g-my-40">

            <!-- Contact Form -->
            <form>
                <div class="g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Το όνομά σας <span class="g-color-red">*</span>
                    </label>
                    <input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus g-brd-gray-light-v4 rounded-3 g-py-13 g-px-15" type="text">
                </div>

                <div class="g-mb-20">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Το email σας <span class="g-color-red">*</span>
                    </label>
                    <input class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus g-brd-gray-light-v4 rounded-3 g-py-13 g-px-15" type="email">
                </div>

                <div class="g-mb-40">
                    <label class="g-color-gray-dark-v2 g-font-weight-600 g-font-size-13">Το μήνυμά σας <span class="g-color-red">*</span>
                    </label>
                    <textarea class="form-control g-color-gray-dark-v5 g-bg-white g-bg-white--focus g-brd-primary--focus g-brd-gray-light-v4 g-resize-none rounded-3 g-py-13 g-px-15" rows="7"></textarea>
                </div>

                <button class="btn btn-lg u-btn-primary g-font-weight-600 g-font-size-default rounded-3 text-uppercase g-py-15 g-px-30" type="submit" role="button">Αποστολή ερώτησης</button>
            </form>
            <!-- End Contact Form -->
        </div>

        <div class="col-lg-4 g-mb-60">
            <!-- Google Map -->
            <div id="GMapCustomized-light" class="js-g-map embed-responsive embed-responsive-21by9 g-height-300" data-type="custom" data-lat="42.686808" data-lng="23.324355" data-zoom="12" data-title="Agency" data-styles='[["", "", [{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]], ["", "labels", [{"visibility":"on"}]], ["water", "", [{"color":"#bac6cb"}]] ]' data-pin="true" data-pin-icon="assets/img/icons/pin/green.png">
            </div>
            <!-- End Google Map -->

            <hr class="g-my-40">

            <!-- Contact Info -->
            <h2 class="h3 mb-4">Contact info</h2>
            <div class="media mb-2">
                <i class="d-flex g-color-gray-dark-v5 mt-1 mr-3 icon-hotel-restaurant-235 u-line-icon-pro"></i>
                <div class="media-body">
                    <p class="g-color-gray-dark-v3 mb-2">Streamflow EOOD, 1142
                        <br>23 Vasil Levski Str. Fl.2, Ap.6,
                        <br>Sofia, Bulgaria</p>
                </div>
            </div>
            <div class="media mb-2">
                <i class="d-flex g-color-gray-dark-v5 mt-1 mr-3 icon-communication-062 u-line-icon-pro"></i>
                <div class="media-body">
                    <p class="g-color-gray-dark-v3 mb-2">Email: <a class="g-color-gray-dark-v4" href="#">support@fillitcrowd.com</a>
                    </p>
                </div>
            </div>

            <hr class="g-my-40">
        </div>
    </div>
</section>
<!-- Demo modal window -->
<div id="modal-type-onscroll" class="js-autonomous-popup text-left g-max-width-600 g-bg-white g-pa-20" style="display: none;" data-modal-type="onscroll" data-open-effect="flipInY" data-close-effect="flipOutY" data-breakpoint="1000" data-speed="500">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <i class="hs-icon hs-icon-close"></i>
    </button>
    <img class=" text-center" src="assets/img/logo.png" alt="Image Description">
    <hr>

    <h4 class="g-mb-20 g-font-size-22 text-uppercase">ΓΕΜΙΣΤΕ ΤΗΝ ΤΣΕΠΗ ΣΑΣ ΜΕ FILLIT</h4>
    <p></p>

    <a href="index.php#investor" target="_blank" class="btn btn-md u-btn-primary g-font-size-12 text-uppercase rounded g-py-11 g-px-30 token" role="button">ΑΓΟΡΑΣΤΕ TOKENS</a>
</div>
<?php include 'footer.php';?>