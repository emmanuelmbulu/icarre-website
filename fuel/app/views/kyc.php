<?php

use Fuel\Core\Asset;
use Fuel\Core\Config;
use Fuel\Core\Fieldset;
use Fuel\Core\Form;
use Fuel\Core\Lang;
use Fuel\Core\Router;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("kyc.json", null, $lang);

?>
<div class="page-banner-area">
    <div id="hs_cos_wrapper_breadcrumb" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
        <div class="section breadcrumb-bg " style="background-image: url(//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/bg/breadcrumb-bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cr-breadcrumb-area">
                            <h1 class="title"><?= Lang::get("title", [], null, $lang) ?></h1>
                            <ul class="breadcrumb-list">
                                <li><a href="<?= Router::get("index", ["lang" => $lang]) ?>"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <li><a href="<?= Router::get("about", ["lang" => $lang]) ?>"><?= Lang::get("about", [], null, $lang) ?></a></li>
                                <li><a href="#"><?= Lang::get("title", [], null, $lang) ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid-wrapper row-depth-1 row-number-2 dnd-section">
    <div class="row-fluid ">
        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
            <div id="hs_cos_wrapper_dnd_area-module-2" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                <div class="section section-padding ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <form method="POST" accept="">
                                    <div id="hs_cos_wrapper_subscription_preferences" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-email_subscriptions" data-hs-cos-general-type="widget" data-hs-cos-type="module"><span id="hs_cos_wrapper_subscription_preferences_email_subscriptions" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_email_subscriptions" data-hs-cos-general-type="widget" data-hs-cos-type="email_subscriptions">
                                        <div class="page-header">
                                            <h1><?= Lang::get("form.introduction.title", [], null, $lang) ?></h1>
                                            <p><?= Lang::get("form.introduction.paragraph", [], null, $lang) ?></p>
                                            <p><?= Lang::get("form.term.paragraph", [], null, $lang) ?> <a target="blank" href="<?= Router::get("download-terms", ["lang" => $lang]) ?>"><strong><?= Lang::get("form.term.link", [], null, $lang) ?></strong></a></p>
                                        </div>
                                        <div class="accordion mt-2" id="accordion-kyc">
                                            <?php
                                            $accordions = Lang::get("form.accordions", [], null, $lang);
                                            for ($j=0; $j < count($accordions) / 2; $j++) {
                                                $accordion = $accordions[$j]; ?>
                                                
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="<?= $accordion['name'].'-title' ?>">
                                                        <button class="accordion-button <?= $j != 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#'.$accordion['name'] ?>" aria-expanded="false" aria-controls="<?= $accordion['name'] ?>">
                                                            <?= $accordion["title"] ?>
                                                        </button>
                                                    </h2>
                                                    <div id="<?= $accordion['name'] ?>" class="accordion-collapse collapse <?= $j != 0 ? '' : 'show' ?>" aria-labelledby="<?= $accordion['name'].'-title' ?>">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <?php
                                                                if(array_key_exists("text", $accordion)) { ?>

                                                                    <div class="col-12 pb-2"> <?php
                                                                        $text = $accordion["text"];
                                                                        if($text["type"] == "simple") { ?>

                                                                            <p><?= $text["paragraph"] ?></p> <?php

                                                                        } ?>
                                                                    </div> <?php
                                                                }

                                                                $inputs = $accordion["inputs"];
                                                                for ($i = 0; $i < count($inputs); $i++) {
                                                                    $item = $inputs[$i];                                                                    
                                                                    if($item["type"] == "radio") { ?>

                                                                        <div class="col-12 pb-2"> <?php
                                                                            $compter = 0;
                                                                            foreach ($item["values"] as $value) {
                                                                                $compter++;
                                                                                ?>
                                                                                <div class="form-check form-check-inline">
                                                                                    <input <?= $compter == 1 ? "checked" : null ?> class="form-check-input" type="radio" name="<?= $item["name"] ?>" id="<?= $item["name"]."radio".$compter ?>" value="<?= $value["value"] ?>">
                                                                                    <label class="form-check-label" for="<?= $item["name"]."radio".$compter ?>"><?= $value["text"] ?></label>
                                                                                </div> <?php
                                                                            } ?>
                                                                        </div> <?php

                                                                    } else if($item["type"] == "text") { ?>

                                                                        <div class="col-6 pb-2">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" class="form-control" name="<?= $item["name"] ?>" id="<?= $item["name"] ?>" placeholder="<?= $item["placeholder"] ?>">
                                                                                <label for="<?= $item["name"] ?>"><?= $item["label"] ?></label>
                                                                            </div>
                                                                        </div> <?php

                                                                    } else if($item["type"] == "number") { ?>

                                                                        <div class="col-6 pb-2">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="number" min="<?= $item["min"] ?>" max="<?= $item["max"] ?>" class="form-control" name="<?= $item["name"] ?>" id="<?= $item["name"] ?>" placeholder="<?= $item["placeholder"] ?>">
                                                                                <label for="<?= $item["name"] ?>"><?= $item["label"] ?></label>
                                                                            </div>
                                                                        </div> <?php

                                                                    } else if($item["type"] == "textarea") { ?>

                                                                        <div class="col-12 pb-2">
                                                                            <div class="form-floating">
                                                                                <textarea class="form-control" placeholder="<?= $item["placeholder"] ?>" name="<?= $item["name"] ?>" id="<?= $item["name"] ?>"></textarea>
                                                                                <label for="<?= $item["name"] ?>"><?= $item["label"] ?></label>
                                                                            </div>
                                                                        </div> <?php

                                                                    } else if($item["type"] == "email") { ?>

                                                                        <div class="col-6 pb-2">
                                                                            <div class="form-floating mb-3">
                                                                                <input type="email" class="form-control" name="<?= $item["name"] ?>" id="<?= $item["name"] ?>" placeholder="<?= $item["placeholder"] ?>">
                                                                                <label for="<?= $item["name"] ?>"><?= $item["label"] ?></label>
                                                                            </div>
                                                                        </div> <?php

                                                                    } else if($item["type"] == "list" && $item["data"] == "api") { ?>
                                                                    
                                                                        <div class="col-6 pb-2">
                                                                            <div class="form-floating mb-3">
                                                                                <input class="form-control" list="<?= $item["name"]."-list" ?>" id="<?= $item["name"] ?>" placeholder="<?= $item["placeholder"] ?>">
                                                                                <datalist id="<?= $item["name"]."-list" ?>">
                                                                                </datalist>
                                                                                <label for="<?= $item["name"] ?>" class="form-label"><?= $item["label"] ?></label>
                                                                            </div>
                                                                            <script>
                                                                                (function () {
                                                                                    window.addEventListener('load', function () {
                                                                                        (function(){
                                                                                            var xhr = new XMLHttpRequest();
                                                                                            xhr.open('GET', '<?= $item["url"] ?>', true /*async*/);
                                                                                            xhr.onreadystatechange = function () {
                                                                                                if (xhr.readyState === 4) {
                                                                                                    const data  = xhr.response;
                                                                                                    for(let i = 0; i < data.length; i++) {
                                                                                                        const item = data[i];
                                                                                                        let html = document.createElement("option");
                                                                                                        html.value = item.name.official;
                                                                                                        document.querySelector('<?= "#".$item["name"]."-list" ?>').append(html);
                                                                                                    }
                                                                                                }
                                                                                            };
                                                                                            xhr.responseType = "json";
                                                                                            xhr.send();
                                                                                        })();
                                                                                    });
                                                                                })();
                                                                            </script>
                                                                        </div> <?php
                                                                    } 
                                                                }
                                                                ?>
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                </div> <?php

                                            } ?>
                                            
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="amount-to-invest-title">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#amount-to-invest" aria-expanded="false" aria-controls="amount-to-invest">
                                                        <?= Lang::get("form.money.title", [], null, $lang) ?>
                                                    </button>
                                                </h2>
                                                <div id="amount-to-invest" class="accordion-collapse collapse" aria-labelledby="amount-to-invest-title">
                                                    <div class="accordion-body">2</div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="hs-button primary" id="submitbutton" value="Update email preferences">
                                        <div class="clearer"></div>
                                    </div>
                                </form>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div><!--end widget-span -->
    </div><!--end row-->
</div>