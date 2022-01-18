<?php

use Fuel\Core\Asset;

?>

<!doctype html><html lang="fr-fr"><head>
        <meta charset="utf-8">
        <title><?= isset($title) ? "iCarré - $title" : "iCarré - Des idées intelligentes" ?></title>
        <link rel="shortcut icon" href="<?= Asset::get_file("our-logo-to-use-as-icon.png", "img") ?>">
        <meta name="description" content="">


        <script src="https://kit.fontawesome.com/f2711dea4c.js" crossorigin="anonymous"></script>


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
                setTimeout(function () {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/_hcms/perf', true /*async*/);
                    xhr.setRequestHeader("Content-type", "application/json");
                    xhr.onreadystatechange = function () {
                        // do nothing.
                    };
                    var connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
                    function populateNetworkInfo(name, connection, info) {
                        if (name in connection) {
                            info[name] = connection[name];
                        }
                    }
                    var networkInfo = {};
                    if (connection) {
                        ['type', 'effectiveType', 'downlink', 'rtt'].forEach(function(name) {
                            populateNetworkInfo(name, connection, networkInfo);
                        });
                    }
                    var perfData = {
                        url: location.href,
                        portal: 19899805,
                        content: 48845610400,
                        group: -1,
                        connection: networkInfo,
                        timing: performance.timing
                    };
                    xhr.send(JSON.stringify(perfData));
                }, 3000);  // Execute this 3 seconds after onload.

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

    <script src="48248452365/1623747430870/terbay/js/plugins/aos.min.js"></script>

    <script>
        if (typeof hsVars !== 'undefined') { hsVars['language'] = 'en-us'; }
    </script>

    <?= Asset::js([
        "project.js",
        "search-input.js"
    ]) ?>

    <script data-hs-allowed="true">
        var options = {
            portalId: '19899805',
            formId: '622b2d5b-50ef-4f60-92d9-6287d1cac60f',
            formInstanceId: '276',
            pageId: '48845610400',
            region: 'na1',
            pageName: "Terbay - Construction HubSpot Theme",            
            inlineMessage: "Thanks for submitting the form.",            
            rawInlineMessage: "Thanks for submitting the form.",
            hsFormKey: "9c9ffed393a31a89785aab28f9152e1d",
            css: '',
            target: '#hs_form_target_site_mail',
            contentType: "standard-page",
            formsBaseUrl: '/_hcms/forms/',
            formData: {
                cssClass: 'hs-form stacked hs-custom-form'
            }
        };

        options.getExtraMetaDataBeforeSubmit = function() {
            var metadata = {};
            

            if (hbspt.targetedContentMetadata) {
                var count = hbspt.targetedContentMetadata.length;
                var targetedContentData = [];
                for (var i = 0; i < count; i++) {
                    var tc = hbspt.targetedContentMetadata[i];
                     if ( tc.length !== 3) {
                        continue;
                     }
                     targetedContentData.push({
                        definitionId: tc[0],
                        criterionId: tc[1],
                        smartTypeId: tc[2]
                     });
                }
                metadata["targetedContentMetadata"] = JSON.stringify(targetedContentData);
            }

            return metadata;
        };

        hbspt.forms.create(options);
    </script>


    <script type="text/javascript">
        var hsVars = {
            ticks: 1641297694132,
            page_id: 48845610400,
            
            content_group_id: 0,
            portal_id: 19899805,
            app_hs_base_url: "https://app.hubspot.com",
            cp_hs_base_url: "https://cp.hubspot.com",
            language: "en-us",
            analytics_page_type: "standard-page",
            analytics_page_id: "48845610400",
            category_id: 1,
            folder_id: 0,
            is_hubspot_user: false
        }
    </script>
    </body>
</html>