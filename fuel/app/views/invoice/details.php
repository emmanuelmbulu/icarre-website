<?php

use Fuel\Core\Lang;
use Fuel\Core\Router;

Lang::load("invoice_details.json", null, $lang);
?>
<div class="systems-page error-page section-padding" style="text-align: left;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <?php if(isset($status)) { if("approved" == strtolower($status)) { ?>
                    <div class="alert alert-success" role="alert" style="text-align: center">
                        <span style="color: #00c146">
                            <i class="fa-solid fa-circle-check fa-4x fa-beat" style="--fa-animation-duration: 0.5s;"></i>
                        </span>
                        <br><br>
                        <h4 class="alert-heading"><?= Lang::get("callback.approved.title", [], null, $lang) ?></h4>
                        <hr>
                        <p class="mb-0">
                            <?= Lang::get("callback.approved.message", [], null, $lang) ?>
                            <br>
                            <a href="<?= $receipt ?>"><?= Lang::get("callback.approved.link", [], null, $lang) ?></a>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger" role="alert" style="text-align: center">
                        <span style="color: red">
                            <i class="fa-solid fa-circle-xmark fa-4x fa-flip" style="--fa-animation-duration: 3s; color: var(--fa-navy);"></i>
                        </span>
                        <br><br>
                        <h4 class="alert-heading"><?= Lang::get("callback.cancelled.title", [], null, $lang) ?></h4>
                        <hr>
                        <p class="mb-0"><?= Lang::get("callback.cancelled.message", [], null, $lang) ?></p>
                    </div>
                <?php }} if(isset($error)) { ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <span class="flex-shrink-0" style="color: red; margin-right: 1rem;">
                            <i class="fa-solid fa-circle-info fa-beat-fade fa-3x" style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075; color: var(--fa-navy);" ></i>
                        </span>
                        <div><?= $error ?></div>
                    </div>
                <?php } ?>                

                <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text mb-3" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                    <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                        <h2><?= Lang::get("reference", ["reference" => $invoice->reference], null, $lang) ?></h2>
                    </span>
                </div>
                <div class="form-container mt-2">
                    <span id="hs_cos_wrapper_my_login" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_member_login" data-hs-cos-general-type="widget" data-hs-cos-type="member_login">
                        <form method="post" id="hs-membership-form" onsubmit="onFormSubmit()" data-hs-do-not-collect="">
                            <input type="hidden" name="ref" value="<?= $invoice->id ?>">
                            <?php 
                                $details = Lang::get("details", [], null, $lang);
                                $client_details = Lang::get("client", [], null, $lang);
                                $date_format = "Y-m-d H:i:s";
                                if($lang == "fr") {
                                    $date_format = "d-m-Y h:i:s";
                                }
                                $total = $invoice->get_ttc();
                            ?>
                            <div class="row" id="details">
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header"><?= $details["title"] ?></h5>
                                        <div class="card-body">
                                            <p>
                                                <?= $details["reference"] ?> <strong><?= $invoice->reference ?></strong><br>
                                                <?= $details["date"] ?> <strong><?= date($date_format, strtotime($invoice->created_at)) ?></strong><br>
                                                <?= $details["total"] ?> <strong><?= Lang::get("amount", ["value" => $total, "currency" => $invoice->currency], null, $lang) ?></strong><br>
                                                <?= $details["paid"] ?> <strong><?= Lang::get("amount", ["value" => $invoice->amount_paid, "currency" => $invoice->currency], null, $lang) ?></strong><br>
                                                <?= $details["status"]["label"] ?> <strong><?= $invoice->is_paid ? $details["status"]["paid"] : $details["status"]["unpaid"] ?></strong><br>
                                                <a href="<?= Router::get("invoice-pdf", ["ref" => $invoice->id]) ?>" target="_blank" style="color: red">
                                                    <i class="fa-solid fa-file-pdf fa-fw fa-lg" style="color: var(--fa-navy);"></i> <?= $details["download"] ?>
                                                </a>
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

                            <div id="items" class="row bd-example">
                                <table class="table table-hover table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th><?= Lang::get("items.label", [], null, $lang) ?></th>
                                            <th><?= Lang::get("items.quantity", [], null, $lang) ?></th>
                                            <th><?= Lang::get("items.price", [], null, $lang) ?></th>
                                            <th><?= Lang::get("items.total", [], null, $lang) ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach ($items as $item) { $i++; ?>
                                            <tr>
                                                <th scope="row"><?= $i ?></th>
                                                <td><?= $item->description ?></td>
                                                <td><?= $item->quantity ?></td>
                                                <td style="text-align: right"><?= $item->price ?></td>
                                                <td style="text-align: right"><?= $item->total ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <th scope="row" style="text-align: right" colspan="4"><?= Lang::get("add.ht", [], null, $lang) ?></th>
                                            <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $invoice->amount, "currency" => $invoice->currency], null, $lang) ?></th>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="text-align: right" colspan="4"><?= Lang::get("add.vat", ["value" => $invoice->tva], null, $lang) ?></th>
                                            <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $invoice->get_vat(), "currency" => $invoice->currency], null, $lang) ?></th>
                                        </tr>
                                        <tr>
                                            <th scope="row" style="text-align: right" colspan="4"><?= Lang::get("add.ttc", [], null, $lang) ?></th>
                                            <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $total, "currency" => $invoice->currency], null, $lang) ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row bd-example">
                                <table id="payments" class="table table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th><?= Lang::get("payments.date", [], null, $lang) ?></th>
                                            <th><?= Lang::get("payments.reference", [], null, $lang) ?></th>
                                            <th><?= Lang::get("payments.status", [], null, $lang) ?></th>
                                            <th><?= Lang::get("payments.amount", [], null, $lang) ?></th>
                                            <th><?= Lang::get("payments.channel", [], null, $lang) ?></th>
                                            <th><?= Lang::get("payments.receipt", [], null, $lang) ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach ($payments as $item) { $i++; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= date($date_format, strtotime($item->date)) ?></td>
                                                <td><?= $item->reference ?></td>
                                                <td><?= $item->status == "approved" ? Lang::get("payments.approved", [], null, $lang) : Lang::get("payments.cancelled", [], null, $lang) ?></td>
                                                
                                                <td><?= Lang::get("amount", ["value" => $item->amount, "currency" => $invoice->currency], null, $lang) ?></td>
                                                <td><?= $item->channel ?></td>
                                                <td>
                                                    <?php if($item->status == "approved") { ?>
                                                        <a href="<?= $item->receipt ?>" target="blank" style="color: red"><i class="fa-solid fa-file-pdf fa-fw fa-lg" style="color: var(--fa-navy);"></i></a>
                                                    <?php } else echo("-"); ?>
                                            </tr>
                                        <?php } if(count($payments) == 0) { ?>
                                            <tr>
                                                <td colspan="7">
                                                    <p><?= Lang::get("payments.empty", [], null, $lang) ?></p>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>                            

                            <?php if(!$invoice->is_paid) { $input = Lang::get("input", [], null, $lang); ?>
                                <div class="row bd-example">
                                    <div class="col-12">
                                        <table id="payments" class="table table-sm">
                                            <thead class="table-light">
                                                <tr>
                                                    <th><?= $input["title"] ?></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating mb-3">
                                            <input type="number" min="1" max="<?= $total - $invoice->amount_paid ?>" class="form-control" name="amount" id="amount" placeholder="<?= $input["placeholder"] ?>">
                                            <label for="amount"><?= Lang::get("input.label", ["currency" => $invoice->currency], null, $lang) ?></label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-hover-secondary btn-primary" type="submit"><?= $input["button"] ?></button>
                                    </div>
                                </div>
                            <?php } ?>
                        </form>
                        <script type="text/javascript">
                            function onFormSubmit() {
                                // document.querySelector('.hs-membership-loader').classList.add('active');
                            }

                            document.onkeydown = function(e) {
                                if (['ArrowUp','ArrowDown'].includes(e.code)) {
                                    var children = [].slice.call(document.querySelectorAll('#hs-membership-form input:not([type="hidden"]):not([type="checkbox"]):not([disabled])'));
                                    for (i = 0; i < children.length; i++) {
                                        var input = children[i];
                                        if (input === document.activeElement) {
                                            if (e.code =='ArrowDown' && children[i+1] !== undefined) {
                                                children[i+1].focus();
                                                break;
                                            } else if (e.code=='ArrowUp' && children[i-1]!==undefined) {
                                                children[i-1].focus();
                                                break;
                                            }
                                        } else if (i + 1 === children.length) {
                                            children[0].focus();
                                        }
                                    }
                                } else if ('Enter' === e.code) {
                                    e.preventDefault();
                                    var children = [].slice.call(document.querySelectorAll('#hs-membership-form input:not([type="hidden"]):not([type="checkbox"]):not([disabled])'));
                                    for (i = 0; i < children.length; i++) {
                                        var input=children[i];
                                        if (input ===  document.activeElement && children[i+1] !== undefined) {
                                            children[i+1].focus();
                                            break;
                                        } else if (input ===  document.activeElement && i + 1 === children.length) {
                                            //          document.querySelector('.hs-membership-loader').classList.add('active');
                                            document.getElementById('hs-membership-form').submit();
                                        } else if (i + 1 === children.length) {
                                            children[0].focus();
                                        }
                                    }
                                }
                            }
                        </script>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>