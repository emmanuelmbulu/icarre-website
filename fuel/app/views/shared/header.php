<?php

use Fuel\Core\Config;
use Fuel\Core\Router;

Config::load("icarre-data-config.json");
    $tel = Config::get("tel");
    $mail = Config::get("mail");
    $language = Config::get($lang);
?>
<header class="header section">
    <!-- Header Top Start -->
    <div class="header-top bg-secondary">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top Link/Search Start -->
                <div class="col-lg-8 col-md-12">
                    <div id="hs_cos_wrapper_module_16237504766303" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                        <ul class="header-top-links">
                            <li><a href="<?= 'tel:'.$tel ?>"><i class="fa fa-phone fa-xl"></i> <span><?= $tel ?></span></a></li>
                            <li><a href="<?= 'tel:+243854817354' ?>"><i class="fa fa-phone fa-xl"></i> <span>+243854817354</span></a></li>
                            <li><a href="<?= 'mailto:'.$mail ?>"><i class="fa fa-envelope-o fa-xl"></i> <span><?= $mail ?></span></a></li>
                            <!--li><i class="fa fa-clock-o"></i> <span>Ouvert de lundi à vendredi, de 8:30 à 16:00</span> </li-->
                        </ul>
                    </div>
                </div>
                <!-- Header Top Link/Search End -->

                <!-- Header Top Action Bar Start -->
                <div class="col-lg-4 col-md-12 text-md-right header-top-action">
                    <div class="header__language-switcher header--element">
                        <div id="hs_cos_wrapper_language-switcher" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-language_switcher" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                            <span id="hs_cos_wrapper_language-switcher_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_language_switcher" data-hs-cos-general-type="widget" data-hs-cos-type="language_switcher">
                                <div class="lang_switcher_class">
                                    <div class="globe_class" onclick="">
                                        <ul class="lang_list_class">
                                            <li><a class="lang_switcher_link" data-language="en" href="<?= Router::get($route_name, ['lang' => 'en']) ?>"><?= Config::get("en") ?></a></li>
                                            <li><a class="lang_switcher_link" data-language="fr" href="<?= Router::get($route_name, ['lang' => 'fr']) ?>"><?= Config::get("fr") ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="header__language-switcher--label-current"> <?= $language ?></div>
                    </div>
                    <button class="action-btn header-search-icon" type="submit"><i class="fa fa-search"></i></button>
                </div>
                <!-- Header Top Action Bar End -->
            </div>
        </div>
    </div>
    <!-- Header Top End -->

    <!-- Header Bottom or Main Menu Start -->
    <?= isset($mainMenu) ? $mainMenu : "<div class='alert alert-warning'>Something went wrong</div>" ?>
    <!-- Header Bottom or Main Menu End -->

    <!-- Mobile Menu Start -->
    <?= isset($phoneMenu) ? $phoneMenu : "<div class='alert alert-warning'>Something went wrong</div>" ?>
    <!-- Mobile Menu End -->

    <!-- Offcanvas Search Start -->
    <div class="offcanvas-search">
        <!-- Offcanvas Search Inner Start -->
        <div class="offcanvas-search-inner">
            <!-- Button Close Start -->
            <div class="btn-close-bar">
                <i class="fa fa-times"></i>
            </div>
            <!-- Button Close End -->

            <!-- Offcanvas Search Form Start -->
            <form class="offcanvas-search-form" action="#">
                <div id="hs_cos_wrapper_site_search" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                    <div class="hs-search-field"> 
                        <div class="hs-search-field__bar"> 
                            <input type="text" class="hs-search-field__input" name="term" autocomplete="off" aria-label="Search" placeholder="Search">
                            <input type="hidden" name="type" value="SITE_PAGE">
                            <input type="hidden" name="type" value="BLOG_POST">
                            <input type="hidden" name="type" value="LISTING_PAGE">
                        </div>
                        <ul class="hs-search-field__suggestions"></ul>
                    </div>
                </div>
            </form>
            <!-- Offcanvas Search Form End -->
        </div>
        <!-- Offcanvas Search Inner End -->
    </div>
    <!-- Offcanvas Search End -->
</header>