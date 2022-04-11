<?php

use Fuel\Core\Lang;
use Fuel\Core\Router;

Lang::load("payment_callback.json", null, $lang);
?>
<div class="systems-page error-page section-padding" style="text-align: left;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="alert alert-danger" role="alert" style="text-align: center">
                    <span style="color: red">
                        <i class="fa-solid fa-circle-xmark fa-4x fa-flip" style="--fa-animation-duration: 3s; color: var(--fa-navy);"></i>
                    </span>
                    <br><br>
                    <h4 class="alert-heading"><?= Lang::get("declined.title", [], null, $lang) ?></h4>
                    <hr>
                    <p><?= Lang::get("declined.message", [], null, $lang) ?></p>
                    <p class="mb-0"><?= Lang::get("declined.reason", ["reason" => $error], null, $lang) ?></p>
                </div>
                
                <?php if($object == "invoice") { $client = $element->get_client(); ?>
                <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text mb-3" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                    <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                        <h2><?= Lang::get("bill.description", ["reference" => $element->reference, "amount" => $model->amount, "currency" => $model->currency], null, $lang) ?></h2>
                    </span>
                </div>
                <div class="form-container mt-2">
                    <span id="hs_cos_wrapper_my_login" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_member_login" data-hs-cos-general-type="widget" data-hs-cos-type="member_login">
                        <?php 
                            $details = Lang::get("bill.details", [], null, $lang);
                            $client_details = Lang::get("client", [], null, $lang);
                            $date_format = "Y-m-d H:i:s";
                            if($lang == "fr") {
                                $date_format = "d-m-Y h:i:s";
                            }
                            $total = $element->get_ttc();
                        ?>
                        <div class="row" id="details">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header"><?= $details["title"] ?></h5>
                                    <div class="card-body">
                                        <p>
                                            <?= $details["reference"] ?> <strong><?= $element->reference ?></strong><br>
                                            <?= $details["date"] ?> <strong><?= date($date_format, strtotime($element->created_at)) ?></strong><br>
                                            <?= $details["total"] ?> <strong><?= Lang::get("amount", ["value" => $total, "currency" => $element->currency], null, $lang) ?></strong><br>
                                            <?= $details["paid"] ?> <strong><?= Lang::get("amount", ["value" => $element->amount_paid, "currency" => $element->currency], null, $lang) ?></strong><br>
                                            <?= $details["status"]["label"] ?> <strong><?= $element->is_paid ? $details["status"]["paid"] : $details["status"]["unpaid"] ?></strong><br>
                                            <a href="<?= Router::get("invoice-pdf", ["ref" => $element->id]) ?>" target="_blank" style="color: red">
                                                <i class="fa-solid fa-file-pdf fa-fw fa-lg" style="color: var(--fa-navy);"></i> <?= $details["download"] ?>
                                            </a>
                                            <?php if(!$element->is_paid) { ?>
                                                <a href="<?= Router::get("details-bill", ["ref" => $element->id]) ?>" class="mt-3 btn btn-sm btn-primary"><?= Lang::get("bill.button", [], null, $lang) ?></a>
                                            <?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header"><?= $client_details["title"] ?></h5>
                                    <div class="card-body">
                                        <h6 class="card-title"><?= $client->fullname ?></h6>
                                        <p>
                                            <?= $client->address ?><br>
                                            <?= $client->country ?><br>
                                            <strong><?= $client_details["email"] ?></strong> <?= $client->email ?><br>
                                            <strong><?= $client_details["phone"] ?></strong> <?= $client->phone ?>
                                        </p>
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                    </span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>