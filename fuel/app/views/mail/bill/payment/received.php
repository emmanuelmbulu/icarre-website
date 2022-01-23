<?php

use Fuel\Core\Lang;

Lang::load("mail_bill_payment_received.json", null, $lang);

$date_format = "Y-m-d h:i:s";
if($lang == "fr") $date_format = "d/m/Y h:i:s";

$bill = Model_Bill::forge($bill->to_array());
$payment = $bill->get_lastPayment();
$items = $bill->get_items();
$client = $bill->get_client();
?>

<div class="col-12 p-3 bg-info">
    <h4 class="text-center"><?= Lang::get("title", ["value"=>$payment->amount, "currency"=>$bill->currency], null, $lang) ?></h4>
</div>
<div class="col-12 p-3">
    <p><?= Lang::get("paragraph", ["reference" => $bill->reference], null, $lang) ?></p>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= Lang::get("payment.title", [], null, $lang) ?></h5>
                    <p class="card-text">
                        <?= Lang::get("payment.reference", [], null, $lang) ?> <strong><?= $payment->reference ?></strong>
                        <br>
                        <?= Lang::get("payment.amount", [], null, $lang) ?> <strong>
                            <?= Lang::get("amount", ["value" => $payment->amount, "currency" => $bill->currency], null, $lang) ?>
                        </strong>
                        <br>
                        <?= Lang::get("payment.date", [], null, $lang) ?> <strong>
                            <?= date($date_format, strtotime($payment->date)) ?>
                        </strong>
                        <br>
                        <?= Lang::get("payment.channel", [], null, $lang) ?> <strong><?= $payment->channel ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
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
                    <h5 class="card-title"><?= Lang::get("client.title", [], null, $lang) ?></h5>
                    <p class="card-text">
                        <?= $client->fullname ?><br>
                        <?= $client->address ?><br>
                        <?= Lang::get("client.email", [], null, $lang) ?> <a href="<?= 'mailto:'.$client->email ?>">
                            <strong><?= $client->email ?></strong>
                        </a><br>
                        <?= Lang::get("client.phone", [], null, $lang) ?> <a href="<?= 'tel:'.$client->phone ?>">
                            <strong><?= $client->phone ?></strong>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>