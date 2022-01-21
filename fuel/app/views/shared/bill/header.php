<?php

use Fuel\Core\Lang;
use Fuel\Core\Router;

Lang::load("bill_header.json", null, $lang);
?>

<div class="page-banner-area">
    <div id="hs_cos_wrapper_breadcrumb" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section breadcrumb-bg " style="background-image: url(//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/bg/breadcrumb-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-breadcrumb-area">
                            <h1 class="title"><?= $title ?></h1>
                            <ul class="breadcrumb-list">
                                <li><a href="<?= Router::get("index", ["lang" => $lang]) ?>"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <li><a href="#"><?= Lang::get("default", [], null, $lang) ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>