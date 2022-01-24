<?php

use Fuel\Core\Config;
use Fuel\Core\Form;
use Fuel\Core\Lang;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("payment_redirect.json", null, $lang);

$acid="137";
$key = "e2d106123f2a8bb515f17ae8f2fd0343a977c597";
$token = "eb1c3f778b1de40075f00a42f9465930a8cab0e5";
$sign = md5($token . $key);                    
$signature = $sign;

$datetrans = date('Y-m-d H:i:s');
$emailId = "emmanuel.mbulu@icarre-rdc.com";
$successurl="#";
$cancelurl="#";

$data = [
    "signature" => $signature,
    "amount" => $payment->amount,
    "currency" => $payment->currency,
    "acid" => $acid,
    "Reference" => $payment->id,
    "emailID" => $emailId,
    "successurl" => $successurl,
    "cancelurl" => $cancelurl
];
?>
<div class="page-banner-area">
    <div id="hs_cos_wrapper_breadcrumb" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section breadcrumb-bg " style="background-image: url(//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/bg/breadcrumb-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-breadcrumb-area">
                            <h1 class="title"><?= Lang::get("title", ["reference" => $payment->reference], null, $lang) ?></h1>
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
                <h3><?= Lang::get("subtitle", ["reference" => $payment->reference, "amount" => $payment->amount, "currency" => $payment->currency], null, $lang) ?></h3>
                <p><?= Lang::get("paragraph", [], null, $lang) ?></p>
            </span>
        </div>
        <div id="hs_cos_wrapper_button" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
            <div class="link-btn-wrap">
                <?= Form::open(array("id"=> "form-redirect", "method" => "post", "action" => "https://epaycongo.com/payment")) ?>
                <?php
                    foreach ($data as $key => $value) {
                        echo Form::hidden($key, $value);
                    }
                ?>
                <?= Form::submit("submit", Lang::get("action", [], null, $lang), ["class" => "btn btn-hover-secondary btn-primary"]) ?>
                <?= Form::close() ?>
            </div>
        </div>
    </div>
</section>
<script>
    (function(){
        window.addEventListener("load", function(){
            setTimeout(function () {
                let form = document.querySelector("#form-redirect");
                form.submit();
            }, 5000);  // Execute this 5 seconds after onload.
        })
    })();
</script>