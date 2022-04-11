<?php

use Fuel\Core\Config;
use Fuel\Core\Form;
use Fuel\Core\Input;
use Fuel\Core\Lang;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("checkout.json", null, $lang);

?>

<div class="error-page section-padding" data-error="404">
    <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
            <h3><?= Lang::get("subtitle", ["reference" => $element->reference, "amount" => $element->amount, "currency" => $element->currency], null, $lang) ?></h3>
            <p><?= Lang::get("paragraph", [], null, $lang) ?></p>
        </span>
    </div>

    <div class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section section-padding pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 p-0">
                        <?= Form::open(array("method" => "post")) ?>
                        <?php if($element->type == "invoice") { ?>
                            <input type="hidden" name="bill_id" value="<?= $element->id ?>">
                        <?php } else if($element->type != "invoice") { ?>
                            <input type="hidden" name="investment_id" value="<?= $element->id ?>">
                        <?php } ?>
                        
                        <input type="hidden" name="amount" id="amount" value="<?= $element->amount ?>">

                        <div class="row align-left">
                            <div class="col-md-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" id="firstname" name="firstname" placeholder="<?= Lang::get("form.firstname.placeholder", [], null, $lang) ?>">
                                    <label for="firstname"><?= Lang::get("form.firstname.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" id="lastname" name="lastname" placeholder="<?= Lang::get("form.lastname.placeholder", [], null, $lang) ?>">
                                    <label for="lastname"><?= Lang::get("form.lastname.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="email" class="form-control" name="email" id="email" placeholder="<?= Lang::get("form.email.placeholder", [], null, $lang) ?>">
                                    <label for="email"><?= Lang::get("form.email.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" name="phone" id="phone" placeholder="<?= Lang::get("form.phone.placeholder", [], null, $lang) ?>">
                                    <label for="phone"><?= Lang::get("form.phone.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-12 pb-2">
                                <div class="form-floating mb-3">
                                    <textarea required class="form-control" placeholder="<?= Lang::get("form.address.placeholder", [], null, $lang) ?>" id="address_line" name="address_line"></textarea>
                                    <label for="address_line"><?= Lang::get("form.address.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" name="address_city" id="address_city" placeholder="<?= Lang::get("form.city.placeholder", [], null, $lang) ?>">
                                    <label for="address_city"><?= Lang::get("form.city.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-6 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" name="address_state" id="address_state" placeholder="<?= Lang::get("form.state.placeholder", [], null, $lang) ?>">
                                    <label for="address_state"><?= Lang::get("form.state.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-9 col-7 pb-2 pr-0">
                                <div class="form-floating mb-3">
                                    <input required class="form-control" list="country-list" name="address_country" id="address_country" placeholder="<?= Lang::get("form.country.placeholder", [], null, $lang) ?>">
                                    <datalist id="country-list">
                                    </datalist>
                                    <label for="address_country" class="form-label"><?= Lang::get("form.country.label", [], null, $lang) ?></label>
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
                            <div class="col-md-3 col-5 pb-2">
                                <div class="form-floating mb-3">
                                    <input required type="text" class="form-control" name="address_zipcode" id="address_zipcode" placeholder="<?= Lang::get("form.zipcode.placeholder", [], null, $lang) ?>">
                                    <label for="address_zipcode"><?= Lang::get("form.zipcode.label", [], null, $lang) ?></label>
                                </div>
                            </div>
                            <div class="col-md-12 pb-2 text-left">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" required id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <?= Lang::get("form.terms.before", [], null, $lang) ?> <a data-toggle="modal" data-target="#modalTerms" href="javascript:AfficherEngagement();" style="color: #68c272;" class="text-decoration-underline"><?= Lang::get("form.terms.link", [], null, $lang) ?></a> <?= Lang::get("form.terms.after", [], null, $lang) ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 text-left">
                                <input class="btn btn-hover-secondary btn-primary" type="submit" value='<?= Lang::get("action", [], null, $lang) ?>' >
                            </div>                       
                        </div>
                        <?= Form::close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTerms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= Lang::get("modal.title", [], null, $lang) ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:$('#modalTerms').modal('hide')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <?= Lang::get("modal.agreement.me", [], null, $lang) ?> <strong id="nom-complet">[THE FULLNAME YOU PROVIDE]</strong>,<br><br>
                    <?= Lang::get("modal.agreement.address", [], null, $lang) ?><br>
                    <strong id="adresse-domicile">[THE ADDRESS YOU PROVIDE]</strong><br><br>
                    <?= Lang::get("modal.agreement.contacts", [], null, $lang) ?><br>
                    <strong id="adresse-email">[THE EMAIL ADDRESS YOU PROVIDE]</strong> | Tel.: <strong id="telephone">[THE PHONE NUMBER PROVIDED]</strong><br><br>

                    <?php 
                    $datetime = date("d-m-Y à H:i:s");
                    if($lang != "fr") {
                        $datetime = date("m/d/Y at H:i:s");
                    }

                    if($element->type == "invoice") { 
                        echo Lang::get("modal.agreement.bill", ["reference"=>$element->reference, "datetime"=>$datetime, "amount"=>$element->amount, "currency"=>$element->currency], null, $lang);
                    } else if($element->type != "invoice") { 
                        echo Lang::get("modal.agreement.investment", ["datetime"=>$datetime, "amount"=>$element->amount, "currency"=>$element->currency], null, $lang);
                    } ?>
                    <br><br>
                    <?= Lang::get("modal.agreement.ip", ["ipaddress"=>Input::real_ip()], null, $lang) ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="javascript:$('#modalTerms').modal('hide')"><?= Lang::get("modal.button", [], null, $lang) ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    function AfficherEngagement() {
        const phone = document.querySelector("#phone").value;
        if(phone.length != 0) { 
            document.querySelector("#telephone").innerHTML = phone;
        }

        const email = document.querySelector("#email").value;
        if(email.length != 0) { 
            document.querySelector("#adresse-email").innerHTML = email;
        }

        let adresseComplete = document.querySelector("#address_line").value;
        if(adresseComplete.length != 0) {
            adresseComplete += "<br>";
        }
        adresseComplete += document.querySelector("#address_city").value;

        const etat = document.querySelector("#address_state").value;
        if(adresseComplete.length != 0 && etat.length != 0) {
            adresseComplete += ", " + etat;
        } else {
            adresseComplete += etat;
        }

        const country = document.querySelector("#address_country").value;
        if(adresseComplete.length != 0 && country.length != 0) {
            adresseComplete += ", " + country;
        } else {
            adresseComplete += country;
        }

        const postal = document.querySelector("#address_zipcode").value;
        if(adresseComplete.length != 0 && postal.length != 0) {
            adresseComplete += ", ZIP " + postal;
        } else if(postal.length != 0) {
            adresseComplete += "YOUR ADDRESS, ZIP " + postal;
        }
        if(adresseComplete.length != 0) {
            document.querySelector("#adresse-domicile").innerHTML = adresseComplete;
        }

        let nomComplet = document.querySelector("#firstname").value;
        if(nomComplet.length != 0) {
            nomComplet += " ";
        }
        nomComplet += document.querySelector("#lastname").value;
        if(nomComplet.length != 0) { 
            document.querySelector("#nom-complet").innerHTML = nomComplet;
        }

        $('#modalTerms').modal('toggle');
    }
</script>