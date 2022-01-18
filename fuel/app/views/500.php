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

<div class="error-page section-padding" data-error="500">
    <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
            <h1>Something isn't quite right</h1>
            <p>Sorry, an internal server error occurred. But have no fear, we're on the case!</p>
        </span>
    </div>
</div>