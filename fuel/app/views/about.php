<?php

use Fuel\Core\Asset;
use Fuel\Core\Config;
use Fuel\Core\Fieldset;
use Fuel\Core\Form;
use Fuel\Core\Lang;
use Fuel\Core\Router;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("about.json", null, $lang);

?>
<div class="page-banner-area">
    <div id="hs_cos_wrapper_breadcrumb" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section breadcrumb-bg " style="background-image: url(//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/bg/breadcrumb-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-breadcrumb-area">
                            <h1 class="title"><?= Lang::get("title", [], null, $lang) ?></h1>
                            <ul class="breadcrumb-list">
                                <li><a href="<?= Uri::base(false)."/$lang" ?>"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <!--li><a href="#"><?= Lang::get("aboutinvest", [], null, $lang) ?></a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid-wrapper row-depth-1 row-number-2 dnd-section">
    <div class="row-fluid ">
        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
            <div id="hs_cos_wrapper_dnd_area-module-2" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="section section-padding ">
                    <div class="container">
                        <!-- About Image/Content Start -->
                        <div class="about-image-content-area">
                            <div class="row align-items-center mb-n6">
                                <div class="col-lg-6 order-lg-1 order-2 mb-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                    <!-- About Content Start -->
                                    <div class="about-content-area">
                                        <h2 class="title"><?= Lang::get("description.title", [], null, $lang) ?></h2>
                                        <p class="mb-5 mb-md-8 mt-4" style="line-height: 23px;"><?= Lang::get("description.paragraph", [], null, $lang) ?></p>
                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Router::get("kyc", ["lang" => $lang]) ?>"><?= Lang::get("description.button", [], null, $lang) ?></a>
                                    </div>
                                    <!-- About Content End -->
                                </div>
                                <div class="col-lg-6 order-lg-2 order-1 mb-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                    <div class="about-image">
                                        <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-4.jpg" alt="about image" loading="lazy" style="max-width: 100%; height: auto;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- About Image/Content End -->

                        <!-- About Timeline Start -->
                        <div class="about-timeline-spacing-top border-top">
                            <div class="row row-cols-lg-3 row-cols-1 mb-n6">
                                <?php 
                                $domains = Lang::get("domains", [], null, $lang);
                                foreach ($domains as $item) {
                                ?>
                                    <div class="col mb-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                        <!-- Feature Box Wrapper Start -->
                                        <div class="feature-box-wrapper">
                                            <div class="feature-box-icon">
                                                <img src="<?= $item["img"] ?>" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                            </div>
                                            <div class="feature-content">
                                                <h4 class="title"><?= $item["title"] ?></h4>
                                                <p><?= $item["paragraph"] ?></p>
                                            </div>
                                        </div>
                                        <!-- Feature Box Wrapper End -->
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- About Timeline End -->
                    </div>
                </div>
            </div>
        </div><!--end widget-span -->
    </div><!--end row-->
</div>

<div class="row-fluid-wrapper row-depth-1 row-number-5 dnd-section">
    <div class="row-fluid ">
        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
            <div id="hs_cos_wrapper_dnd_area-module-5" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="section funfact-bg " style="<?= 'background-image: url(\''.Asset::get_file('satisfaction.jpg', 'img').'\')' ?>">
                    <div class="container">
                        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-1 mb-n10">
                            <?php
                                $satisfactions = Lang::get("satisfactions", [], null, $lang);
                                foreach ($satisfactions as $item) { ?>
                                    <!-- FunFact Area Start -->
                                    <div class="col mb-10">
                                        <!-- Single FunFact Start -->
                                        <div class="funfact-wrap aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                            <div class="funfact-icon">
                                                <img src="<?= $item["img"] ?>" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                            </div>
                                            <span class="odometer odometer-auto-theme" data-count-to="<?= $item["stats"] ?>"></span>
                                            <h6 class="title"><?= $item["title"] ?></h6>
                                        </div>
                                        <!-- Single FunFact End -->
                                    </div>
                                    <!-- FunFact Area End -->
                            <?php    } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end widget-span -->
    </div>
    <!--end row-->
</div>
<!--end row-wrapper -->