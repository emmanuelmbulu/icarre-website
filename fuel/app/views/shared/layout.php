<?php

use Fuel\Core\Asset;

?>

<!doctype html><html lang="fr-fr"><head>
        <meta charset="utf-8">
        <title><?= isset($title) ? "iCarré - $title" : "iCarré - Des idées intelligentes" ?></title>
        <link rel="shortcut icon" href="<?= Asset::get_file("our-logo-to-use-as-icon.png", "img") ?>">
        <meta name="description" content="">
        <meta property="og:description" content="">
        <meta property="og:title" content="iCarré - Des idées intelligentes">
        <meta name="twitter:description" content="">
        <meta name="twitter:title" content="iCarré - Des idées intelligentes">

        <?= Asset::css([
            "plugin.css",
            "main.css",
            "language-switcher.css",
            "search-input.css",
            ""
        ]) ?>

        <link rel="canonical" href="https://icarre-rdc.com">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url" content="https://icarre-rdc.com/fr">
        <meta name="twitter:card" content="summary">
        <meta http-equiv="content-language" content="fr-fr">
        <link rel="alternate" hreflang="en-us" href="//icarre-rdc.com/en">
        <link rel="alternate" hreflang="fr-fr" href="//icarre-rdc.com/fr">
        <meta name="generator" content="iCarré">

        <style>
            a.cta_button{-moz-box-sizing:content-box !important;-webkit-box-sizing:content-box !important;box-sizing:content-box !important;vertical-align:middle}.hs-breadcrumb-menu{list-style-type:none;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px}.hs-breadcrumb-menu-item{float:left;padding:10px 0px 10px 10px}.hs-breadcrumb-menu-divider:before{content:'›';padding-left:10px}.hs-featured-image-link{border:0}.hs-featured-image{float:right;margin:0 0 20px 20px;max-width:50%}@media (max-width: 568px){.hs-featured-image{float:none;margin:0;width:100%;max-width:100%}}.hs-screen-reader-text{clip:rect(1px, 1px, 1px, 1px);height:1px;overflow:hidden;position:absolute !important;width:1px}
        </style>
        <script src="https://kit.fontawesome.com/ce6806c18f.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div class="body-wrapper hs-content-id-48845610400 hs-site-page page ">      
        <div data-global-resource-path="terbay/templates/partials/header.html">
            <?= $header ?>
        </div>
        <main id="main-content" class="body-container-wrapper">
            <?= $content ?>
        </main>
        <div data-global-resource-path="terbay/templates/partials/footer.html">
            <?= $footer ?>
        </div>
    </div>

    <!-- Scroll Top Start -->
    <div class="scroll-top" id="scroll-top" data-target="html">
        <i class="arrow-top fa fa-long-arrow-up"></i>
        <i class="arrow-bottom fa fa-long-arrow-up"></i>
    </div>
    <!-- Scroll Top End -->

    <script>
        (function () {
            window.addEventListener('load', function () {
                (function () {
                   document.querySelectorAll(".odometer").forEach(item => {
                       item.innerHTML = item.dataset.countTo;
                   }); 
                })();

                let swiperTestimonies = new Swiper(".swiper-testimonies", {
                    pagination: {
                        el: ".swiper-pagination",
                    },
                    spaceBetween: 30,
                    slidesPerView: 2,
                    /*autoplay: {
                        delay: 5000,
                        disableOnInteraction: true,
                    },*/
                });
            });
        })();
    </script>

    <?= Asset::js([
        "bootstrap.bundle.js",
        "jquery-3.5.1.js",
        "jquery-migrate-3.3.0.js",
        "modernizr-3.11.2.js",
        "splitting.js",
        "swiper-bundle.js",
        "aos.js",
        "nice-select.js",
        "jquery-ajaxchimp.js",
        "jquery-ui.js",
        "mansory.js",
        "odometer.js",
        "main.js"
    ]) ?>

    <script>
        if (typeof hsVars !== 'undefined') { hsVars['language'] = 'en-us'; }
    </script>

    <?= Asset::js([
        "project.js",
        "search-input.js"
    ]) ?>
    </body>
</html>