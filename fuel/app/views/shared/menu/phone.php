<?php

use Fuel\Core\Asset;
use Fuel\Core\Config;
use Fuel\Core\Lang;
use Fuel\Core\Router;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");
$address = Config::get("address");

Lang::load("main_menu.json", null, $lang);
?>
<div class="mobile-menu-wrapper">
    <div class="body-overlay"></div>
    
    <!-- Mobile Menu Inner Start -->
    <div class="mobile-menu-inner">
        <!-- Button Close Start -->
        <div class="btn-close-bar">
            <i class="fa fa-times"></i>
        </div>
        <!-- Button Close End -->

        <!-- mobile menu start -->
        <div class="mobile-navigation">
            <nav class="mobile-menu">
                <div id="hs_cos_wrapper_navigation-primary" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                        <ul class="dropdown level-1" aria-hidden="false">
                            <!--li class="has-children">
                                <a class="navs-link" href="?hsLang=en-us">Template</a>
                                <ul class="dropdown level-2" aria-hidden="true" style="display: none;">
                                    <li class="no-has-children"><a class="menu-link active active-item" href="//19899805.hs-sites.com/en-us/terbay/home" aria-current="page">Home</a></li>
                                    <li class="no-has-children"><a class="navs-link" href="//19899805.hs-sites.com/en-us/terbay/about?hsLang=en-us">About Us</a></li>
                                    <li class="no-has-children"><a class="navs-link" href="//19899805.hs-sites.com/en-us/terbay/project?hsLang=en-us">Project</a></li>
                                </ul>
                                <div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>
                            </li-->
                            
                            <li class="no-has-children"><a class="<?= $active == "index" ? 'menu-link active active-item' : 'navs-link' ?>" href="<?= Router::get("index", ["lang" => $lang]) ?>" aria-current="page"><?= Lang::get("home") ?></a></li>
                            <li class="no-has-children"><a class="<?= $active == "about" ? 'menu-link active active-item' : 'navs-link' ?>" href="<?= Router::get("about", ["lang" => $lang]) ?>" aria-current="page"><?= Lang::get("about") ?></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- mobile menu end -->

        <!-- Contact Links/Social Links Start -->
        <div class="mt-auto">
            <!-- Contact Link Start -->
            <div id="hs_cos_wrapper_module_162264070644716" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <ul class="contact-links">
                    <li><a href="<?= 'tel:'.$tel ?>"><i class="fa fa-phone fa-2xl"></i> <span><?= $tel ?></span></a></li>
                    <li><a href="<?= 'mailto:'.$mail ?>"><i class="fa fa-envelope-o fa-2xl"></i> <span><?= $mail ?></span></a></li>
                    <!--li><i class="fa fa-clock-o"></i> <span>Monday - Sunday 9.00 - 18.00</span> </li-->
                </ul>
            </div>
            <!-- Contact Link End -->
            
            <!-- Social Widget Start -->
            <div id="hs_cos_wrapper_module_16226538086882" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <ul class="widget-social justify-content-start">
                    <li><a href="https://www.facebook.com/"><i class="fa fa-facebook-f"></i></a></li>
                    <li><a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <!-- Social Widget End -->

        </div>
        <!-- Contact Links/Social Links End -->
    </div>
    <!-- Mobile Menu Inner End -->
</div>