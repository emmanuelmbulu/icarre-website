<?php

use Fuel\Core\Lang;
use Fuel\Core\Router;

Lang::load("mail_bill_created.json", null, $lang);

$date_format = "Y-m-d h:i:s";
if($lang == "fr") $date_format = "d/m/Y h:i:s";
$id_bill = $bill->id;
$bill = Model_Bill::forge($bill->to_array());
$bill->id = $id_bill;
$payment = $bill->get_lastPayment();
$items = $bill->get_items();
$client = $bill->get_client();
?>
<div class="col-12 p-3 bg-primary text-white">
    <h4 class="text-center"><?= Lang::get("title", ["reference"=>$bill->reference], null, $lang) ?></h4>
</div>
<div class="col-12 p-3">
    <p>
        <?= Lang::get("paragraph", ["fullname" => $client->fullname, "amount" => $bill->get_ttc(), "currency" => $bill->currency], null, $lang) ?>
        <br>
        <a href='<?= Router::get("details-bill", ["lang" => $lang, "ref" => $bill->id]) ?>' target="__blank">
            <?= Lang::get("action.link", [], null, $lang) ?>
        </a>
    </p>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= Lang::get("invoice.title", [], null, $lang) ?></h5>
                    <p class="card-text">
                        <?= Lang::get("invoice.reference", [], null, $lang) ?> <strong><?= $bill->reference ?></strong>
                        <br>
                        <?= Lang::get("invoice.date", [], null, $lang) ?> <strong>
                            <?= date($date_format, strtotime($bill->created_at)) ?>
                        </strong>
                        <br>
                        <?= Lang::get("invoice.total", [], null, $lang) ?> <strong>
                            <?= Lang::get("amount", ["value" => $bill->get_ttc(), "currency" => $bill->currency], null, $lang) ?>
                        </strong>
                        <br>
                        <?= Lang::get("invoice.paid", [], null, $lang) ?> <strong>
                            <?= Lang::get("amount", ["value" => $bill->amount_paid, "currency" => $bill->currency], null, $lang) ?>
                        </strong>
                        <br>
                        <?= Lang::get("invoice.status.label", [], null, $lang) ?> <strong>
                            <?= $bill->is_paid ? Lang::get("invoice.status.paid", [], null, $lang) 
                            : Lang::get("invoice.status.unpaid", [], null, $lang) ?>
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                                <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $bill->amount, "currency" => $bill->currency], null, $lang) ?></th>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right" colspan="4"><?= Lang::get("add.vat", ["value" => $bill->tva], null, $lang) ?></th>
                                <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $bill->get_vat(), "currency" => $bill->currency], null, $lang) ?></th>
                            </tr>
                            <tr>
                                <th scope="row" style="text-align: right" colspan="4"><?= Lang::get("add.ttc", [], null, $lang) ?></th>
                                <th scope="row" style="text-align: right"><?= Lang::get("amount", ["value" => $bill->get_ttc(), "currency" => $bill->currency], null, $lang) ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body">
                    <p><?= Lang::get("action.notice", [], null, $lang) ?></p>
                    <a class="btn btn-primary" href='<?= Router::get("details-bill", ["lang" => $lang, "ref" => $bill->id]) ?>' target="__blank">
                        <?= Lang::get("action.button", [], null, $lang) ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>