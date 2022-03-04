<?php

use Fuel\Core\Config;
use Fuel\Core\Form;
use Fuel\Core\Lang;
use Fuel\Core\Router;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("payment_redirect.json", null, $lang);

// MAGECONGO CONFIG
$acid="137";
$key = "e2d106123f2a8bb515f17ae8f2fd0343a977c597";
$token = "eb1c3f778b1de40075f00a42f9465930a8cab0e5";
$sign = md5($token . $key);                    
$signature = $sign;

$datetrans = date('Y-m-d H:i:s');
$emailId = "emmanuel.mbulu@icarre-rdc.com";
$successurl= Router::get("callback-invoice", ["lang" => $lang, "ref" => $ref]);
$cancelurl= $successurl;

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

// ECOBANK CONFIG
$ecobank = Config::get("ecobank");
session_start();
$sessionId  = session_id();
$df_param = 'org_id=' . $ecobank["test"]["dfOrg"];
$df_param .= '&amp;session_id=' . $ecobank["test"]["merchantId"];
$df_param .= $sessionId;
?>

<div class="error-page section-padding" data-error="404">
    <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
            <h3><?= Lang::get("subtitle", ["reference" => $invoice->reference, "amount" => $invoice->amount, "currency" => $invoice->currency], null, $lang) ?></h3>
            <p><?= Lang::get("paragraph", [], null, $lang) ?></p>
        </span>
    </div>
    <?php if($invoice->bank_purchaser == Dao_Bill::$BankPurchaser["MAGECONGO"]) { ?>
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
    <?php } else if($invoice->bank_purchaser == Dao_Bill::$BankPurchaser["ECOBANK"]) { ?>
    <div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section section-padding ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <?= Form::open(array("method" => "post", "action" => "https://testsecureacceptance.cybersource.com/silent/pay")) ?>
                        
                        <input type="hidden" name="profile_id" id="profile_id" value="<?= $ecobank['test']['profileId'] ?>">
                        <input type="hidden" name="access_key" id="access_key" value="<?= $ecobank['test']['accessKey'] ?>">
                        <input type="hidden" name="transaction_uuid" id="transaction_uuid" value="<?= $transaction->id ?>">
                        <input type="hidden" name="signed_date_time" id="signed_date_time" value="<?= gmdate('Y-m-d\TH:i:s\Z') ?>">
                        <input type="hidden" name="transaction_type" id="transaction_type" value="sale" >
                        <input type="hidden" name="reference_number" id="reference_number" value="<?= $transaction->reference ?>" >
                        <input type="hidden" name="auth_trans_ref_no" id="auth_trans_ref_no" value="">
                        <input type="hidden" name="amount" id="amount" value="<?= $transaction->amount ?>">
                        <input type="hidden" name="payment_method" id="payment_method" value="card">
                        <input type="hidden" name="currency" id="currency" value="<?= $transaction->currency ?>">
                        <input type="hidden" name="locale" id="locale" value="<?= $lang == 'en' ? 'en-us' : 'fr-fr' ?>" >
                        <input type="hidden" name="override_custom_receipt_page" id="override_custom_receipt_page" value="<?= Router::get("callback-invoice", ["lang" => $lang, "ref" => $transaction->id]) ?>">
                        <input type="hidden" name="device_fingerprint_id" id="device_fingerprint_id" value="<?= $sessionId ?>" />
                        <input type="hidden" name="merchant_descriptor" id="merchant_descriptor" value="iCarré">
                        <input type="hidden" name="customer_ip_address" id="customer_ip_address" value="<?= $transaction->ip_address ?>">
                        <input type="hidden" name="signed_field_names" id="signed_field_names" value="profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,payment_method,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_receipt_page">    
                        <input type="hidden" name="unsigned_field_names" id="unsigned_field_names" value="device_fingerprint_id,card_type,card_number,card_expiry_date,card_cvn,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code,customer_ip_address">
                        <input type="hidden" name="signature" id="signature" />
                        <input type="submit" style="display:none" id="submit">

                        <div class="row align-left">
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="bill_to_forename" name="bill_to_forename" placeholder="<?= Lang::get("ecobank.firstname.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_forename"><?= Lang::get("ecobank.firstname.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="bill_to_surname" name="bill_to_surname" placeholder="<?= Lang::get("ecobank.lastname.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_surname"><?= Lang::get("ecobank.lastname.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="bill_to_email" id="bill_to_email" placeholder="<?= Lang::get("ecobank.email.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_email"><?= Lang::get("ecobank.email.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="bill_to_phone" id="bill_to_phone" placeholder="<?= Lang::get("ecobank.phone.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_phone"><?= Lang::get("ecobank.phone.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-12 pb-2">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="<?= Lang::get("ecobank.address.placeholder", [], null, $lang) ?>" name="bill_to_address_line1" id="bill_to_address_line1"></textarea>
                                    <label for="bill_to_address_line1"><?= Lang::get("ecobank.address.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="bill_to_address_city" id="bill_to_address_city" placeholder="<?= Lang::get("ecobank.city.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_address_city"><?= Lang::get("ecobank.city.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="bill_to_address_state" id="bill_to_address_state" placeholder="<?= Lang::get("ecobank.state.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_address_state"><?= Lang::get("ecobank.state.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-9 pb-2">
                                <div class="form-floating mb-3">
                                    <input class="form-control" list="country-list" name="bill_to_address_country" id="bill_to_address_country" placeholder="<?= Lang::get("ecobank.country.placeholder", [], null, $lang) ?>">
                                    <datalist id="country-list">
                                    </datalist>
                                    <label for="bill_to_address_country" class="form-label"><?= Lang::get("ecobank.country.label", [], null, $lang) ?></label>
                                </div>
                                <script>
                                    (function () {
                                        window.addEventListener('load', function () {
                                            (function(){
                                                var xhr = new XMLHttpRequest();
                                                xhr.open('GET', 'https://restcountries.com/v3.1/all', true /*async*/);
                                                xhr.onreadystatechange = function () {
                                                    if (xhr.readyState === 4) {
                                                        const data  = xhr.response;
                                                        for(let i = 0; i < data.length; i++) {
                                                            const item = data[i];
                                                            let html = document.createElement("option");
                                                            html.value = item.name.official;
                                                            document.querySelector('#country-list').append(html);
                                                        }
                                                    }
                                                };
                                                xhr.responseType = "json";
                                                xhr.send();
                                            })();
                                        });
                                    })();
                                </script>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="bill_to_address_postal_code" id="bill_to_address_postal_code" placeholder="<?= Lang::get("ecobank.zipcode.placeholder", [], null, $lang) ?>">
                                    <label for="bill_to_address_postal_code"><?= Lang::get("ecobank.zipcode.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-12 pb-2">
                                <div class="form-check form-check-inline">
                                    <input checked class="form-check-input" type="radio" name="card_type" id="visa" value="visa">
                                    <label class="form-check-label" for="visa">VISA <i class="fab fa-cc-visa mx-1"></i></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="card_type" id="mc" value="mastercard">
                                    <label class="form-check-label" for="mc>">MASTERCARD <i class="fab fa-cc-mastercard mx-1"></i></label>
                                </div>
                            </div>
                            <div class="col-7 pb-2">
                                <div class="form-floating">
                                <input type="text" class="form-control" name="card_number" id="card_number" placeholder="<?= Lang::get("ecobank.card.number.placeholder", [], null, $lang) ?>">
                                    <label for="card_number"><?= Lang::get("ecobank.card.number.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-3 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="card_expiry_date" id="card_expiry_date" placeholder="<?= Lang::get("ecobank.card.date.placeholder", [], null, $lang) ?>">
                                    <label for="card_expiry_date"><?= Lang::get("ecobank.card.date.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-2 pb-2">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="card_cvn" id="card_cvn" placeholder="<?= Lang::get("ecobank.card.cvn.placeholder", [], null, $lang) ?>">
                                    <label for="card_cvn"><?= Lang::get("ecobank.card.cvn.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                        </div>
                        <button id="action" class="btn btn-hover-secondary btn-primary" type="button" onclick="signData()"><?= Lang::get("ecobank.action", [], null, $lang) ?></button>
                        
                        <?= Form::close() ?>
                        <script>
                            function signData() {
                                document.querySelector("#action").innerHTML = '<?= Lang::get("ecobank.process", [], null, $lang) ?>';

                                let paramList = document.querySelector("#signed_field_names").value;
                                let dataToSubmit = "";
                                for (let item of paramList.split(",")) {
                                    dataToSubmit += item + "=" + document.querySelector("#" + item).value;
                                }
                                console.log(dataToSubmit);
                                let xhr = new XMLHttpRequest();
                                xhr.open('POST', '<?= Router::get("sign-data-for-payment") ?>', true /*async*/);
                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState === 4) {
                                        const data  = xhr.response;
                                        if(data.code == 0) {
                                            document.querySelector("#signature").value = data.signature;
                                            document.querySelector("#submit").click;
                                        } else {                                            
                                            document.querySelector("#action").innerHTML = '<?= Lang::get("ecobank.process", [], null, $lang) ?>';
                                            alert("Error occured! Please retry!");
                                        }
                                    }
                                };
                                xhr.responseType = "json";
                                xhr.send();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>