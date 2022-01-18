<?php

use Fuel\Core\Config;
use Fuel\Core\Lang;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("404.json", null, $lang);

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
                                <li><a href="<?= Uri::base(false).$lang.'/home' ?>"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <!--li><a href="#"><?= Lang::get("aboutinvest", [], null, $lang) ?></a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    <div class="error-page section-padding" data-error="404">
        <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
            <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                <h2 class="title"><span>404</span></h2>
                <h3><?= Lang::get("subtitle", [], null, $lang) ?></h3>
                <p><?= Lang::get("paragraph", [], null, $lang) ?></p>
            </span>
        </div>
        <div id="hs_cos_wrapper_button" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
            <div class="link-btn-wrap">
                <a class="btn btn-hover-secondary btn-primary" href="<?= Uri::base(false).$lang.'/home' ?>"><?= Lang::get("action", [], null, $lang) ?></a>
            </div>
        </div>
    </div>
</section>