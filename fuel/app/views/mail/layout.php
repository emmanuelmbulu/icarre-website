<?php

use Fuel\Core\Asset;
use Fuel\Core\Uri;

use Fuel\Core\Config;
use Fuel\Core\Lang;
use Fuel\Core\Router;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("mail_layout.json", null, $lang);

/*$date_format = "Y-m-d h:i:s";
if($lang == "fr") $date_format = "d/m/Y h:i:s";

$bill = Model_Bill::find(1);
$client = $bill->get_client();
$payment = $bill->get_lastPayment();
$items = $bill->get_items();*/
?>
<!doctype html>
<html lang="<?= $lang ?>">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>iCarré - Des idées intelligentes</title>
    </head>

    <body>
        <div class="container">
            <div class="row border border-2 shadow mt-3 mx-3 bg-body rounded bg-light bg-gradient">
                <?= $content ?>
            </div>
            <div class="row p-4 text-center">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="container">
                                <?= Asset::img(Uri::base("false")."assets/img/logo_large.png", [
                                    "class" => "img-fluid mb-2",
                                    "style" => "width:250px;border-width:0px;border:0px;",
                                    "width" => "250",
                                    "alt"   => "iCarré - Logo",
                                    "title" => "iCarré - Logo"
                                ]) ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="content footer">
                                <p>
                                    <?= date("Y") ?> iCarré - Des idées intelligentes | Intelligents Ideas - Congo DR.
                                    <br>
                                    <?= Lang::get("tel", [], null, $lang)." ".$tel ?>
                                    <br>
                                    <?= Lang::get("mail", [], null, $lang) ?> <a href="<?= 'mailto:'.$mail ?>"><?= $mail ?></a>
                                    <br>
                                    <?= Lang::get("website", [], null, $lang) ?> <a href="<?= Router::get("index", ["lang"=>$lang]) ?>" target="_blank" rel="noopener"><?= Router::get("index", ["lang"=>$lang]) ?></a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Optional JavaScript; choose one of the two! -->
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>