<?php
use Fuel\Core\Asset;
use Fuel\Core\Lang;
use Fuel\Core\Router;
use Fuel\Core\Uri;

Lang::load("main_menu.json", null, $lang);
?>
<div class="header-bottom section header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <!-- Header Logo Start -->
            <div class="col-lg-3 col-6">
                <div class="header-logo">
                    <div id="hs_cos_wrapper_site_logo" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-logo" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                        <span id="hs_cos_wrapper_site_logo_hs_logo_widget" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_logo" data-hs-cos-general-type="widget" data-hs-cos-type="logo">
                            <a href="<?= Uri::base(false)."$lang/home" ?>" id="hs-link-site_logo_hs_logo_widget" style="border-width:0px;border:0px;">
                                <?= Asset::img('logo_large.png', [
                                    "class" => "hs-image-widget",
                                    "style" => "width:177px;border-width:0px;border:0px;",
                                    "width" => "177",
                                    "alt"   => "iCarré Logo",
                                    "title" => "iCarré Logo"
                                    ]) ?>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- Header Logo End -->

            <!-- Header Menu Start -->
            <div class="col-lg-9 col-6">
                <!-- Main Menu Start -->
                <div class="main-menu d-none d-lg-flex">
                    <div id="hs_cos_wrapper_navigation-primary" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation sub-menu hs-menu-children-wrapper level-1" aria-hidden="false">
                                <li class="no-has-children menu-item"><a class="<?= $active == "index" ? 'menu-link active active-item' : 'navs-link' ?>" href="<?= Uri::base(false)."$lang/home" ?>" aria-current="page"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <li class="no-has-children menu-item"><a class="<?= $active == "about" ? 'menu-link active active-item' : 'navs-link' ?>" href="<?= Router::get("about", ["lang" => $lang]) ?>" aria-current="page"><?= Lang::get("about", [], null, $lang) ?></a></li>
                                <!--li class="has-children menu-item">
                                    <a class="navs-link" href="?hsLang=en-us">Template</a>
                                    <ul class="navigation sub-menu hs-menu-children-wrapper level-2" aria-hidden="true">
                                        <li class="no-has-children menu-item"><a class="menu-link active active-item" href="//19899805.hs-sites.com/en-us/terbay/home" aria-current="page">Home</a></li>
                                        <li class="no-has-children menu-item"><a class="navs-link" href="//19899805.hs-sites.com/en-us/terbay/about?hsLang=en-us">About Us</a></li>
                                        <li class="no-has-children menu-item"><a class="navs-link" href="//19899805.hs-sites.com/en-us/terbay/project?hsLang=en-us">Project</a></li>
                                    </ul>
                                </li>
                                <li class="no-has-children menu-item"><a class="navs-link" href="https://htmldemo.hasthemes.com/terbay_hubspot_documentation/">Documentation</a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Main Menu End -->

                <!-- Main Menu Riht Side Start -->
                <div class="main-menu-right-side d-flex d-lg-none">
                    <!-- Header Search Start -->
                    <div class="header-search mr-4">
                        <a class="header-search-icon" href="#"><i class="fa fa-search"></i></a>
                    </div>
                    <!-- Header Search End -->

                    <!-- Mobile Menu Bar Start -->
                    <div class="mobile-menu-bar-wrapper">
                        <a href="#" class="mobile-menu-bar"><i class="fa fa-bars"></i></a>
                    </div>
                    <!-- Mobile Menu Bar End -->
                </div>
                <!-- Main Menu Riht Side End -->
            </div>
            <!-- Header Menu End -->
        </div>
    </div>
</div>