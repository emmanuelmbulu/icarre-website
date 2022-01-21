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
    "amount" => $invoice->amount,
    "currency" => $invoice->currency,
    "acid" => $acid,
    "Reference" => $invoice->id,
    "emailID" => $emailId,
    "successurl" => $successurl,
    "cancelurl" => $cancelurl
];
?>

<div class="error-page section-padding" data-error="404">
    <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
            <h3><?= Lang::get("subtitle", ["reference" => $invoice->reference, "amount" => $invoice->amount, "currency" => $invoice->currency], null, $lang) ?></h3>
            <p><?= Lang::get("paragraph", [], null, $lang) ?></p>
        </span>
    </div>
    <div id="hs_cos_wrapper_button" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="link-btn-wrap">
            <?= Form::open(array("method" => "post", "action" => "https://epaycongo.com/payment")) ?>
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