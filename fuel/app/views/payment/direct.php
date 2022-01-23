<?php

use Fuel\Core\Config;
use Fuel\Core\Fieldset;
use Fuel\Core\Form;
use Fuel\Core\Lang;
use Fuel\Core\Uri;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");

Lang::load("payment_direct.json", null, $lang);

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
                                <li><a href="<?= Uri::base(false)."/$lang" ?>"><?= Lang::get("home", [], null, $lang) ?></a></li>
                                <li><a href="#"><?= Lang::get("aboutinvest", [], null, $lang) ?></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content-wrapper">
  <div class="systems-page membership-login section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <div id="hs_cos_wrapper_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text mb-4"  data-hs-cos-general-type="widget" data-hs-cos-type="module">
            <span id="hs_cos_wrapper_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text"  data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
              <h4><?= Lang::get("form.top.title", [], null, $lang) ?></h4>
              <p><?= Lang::get("form.top.paragraph", [], null, $lang) ?></p>
            </span>
          </div>
          <div class="form-container">
            <span id="hs_cos_wrapper_my_register" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_member_register" data-hs-cos-general-type="widget" data-hs-cos-type="member_register">
              <?= Form::open(array("method" => "post", "id" => "direct-payment-form", "onsubmit" => "onFormSubmit()", "data-hs-do-not-collect" => "")) ?>
                <?= Form::csrf() ?>
                <?php
                  $form = $form == null ? Fieldset::forge('payment')->add_model('Model_Payment') : $form;
                  $prepattern = "<div class='row'><div class='col-md-6 col-sm-12'>";
                  $prepattern1 = "<div class='col-md-6 col-sm-12'>";
                  $postpattern = "</div></div>";
                  $postpattern1 = "</div>";

                  $fieldPayer = $form->field("direct_payer");
                  $fieldPayer->set_attribute("placeholder", Lang::get("form.input.payer.placeholder", [], null, $lang));
                  $fieldPayer->set_label(Lang::get("form.input.payer.label", [], null, $lang));

                  $toPrint = $prepattern.$fieldPayer.$postpattern1.$prepattern1;
                  $toPrint .= '<label for="hs-register-widget-email">'.Lang::get("form.input.email.label", [], null, $lang);
                  $toPrint .= '*</label><input class="hs-input" name="email" type="email" id="hs-register-widget-email" required ';
                  $toPrint .= 'placeholder="'.Lang::get("form.input.email.placeholder", [], null, $lang).'">'.$postpattern;

                  $fieldAmount = $form->field("amount");
                  $fieldAmount->set_attribute("placeholder", Lang::get("form.input.amount.placeholder", [], null, $lang));
                  $fieldAmount->set_label(Lang::get("form.input.amount.label", [], null, $lang));

                  $toPrint .= $prepattern.$fieldAmount.$postpattern1.$prepattern1;
                  $toPrint .= "<label></label><p>".Lang::get("form.notice", [], null, $lang)."</p>".$postpattern;

                  /*$compter = 0;
                  $toPrint = "";
                  foreach($form->field() as $item) {
                    if($item->attributes["type"] == false) continue;

                    $compter++;
                    if($compter % 2 == 1) {
                      if($item->get_attribute("name") == "direct_payer") {
                        $toPrint .= $prepattern.$item.$postpattern1.$prepattern1;
                        $toPrint .= '<label for="hs-register-widget-email">Email*</label>';
                        $toPrint .= '<input class="hs-input" name="email" type="email" id="hs-register-widget-email">';
                        $toPrint .= $postpattern1;

                        $compter++;
                      } else {
                        $toPrint .= $prepattern.$item.$postpattern1;
                      }                                
                    } else {
                      $toPrint .= $prepattern1.$item.$postpattern;
                    }
                  }*/
                  echo $toPrint;
                ?>
                <div class="hs-membership-loader hs_submit hs-submit">
                  <div class="actions">
                    <input type="submit" class="hs-button primary large" value="<?= Lang::get("form.input.submit.value", [], null, $lang) ?>">
                  </div>
                </div>
              <?= Form::close() ?>
              <script type="text/javascript">
                function onFormSubmit() {
                  //    document.querySelector('.hs-membership-loader').classList.add('active');
                }
              </script>
            </span>
          </div>
          <div>
            <div id="hs_cos_wrapper_membership_admin_content" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
              <span id="hs_cos_wrapper_membership_admin_content_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                <p><?= Lang::get("trouble.indication", [], null, $lang) ?> <a href="<?= 'mailto:'.$mail ?>"><?= Lang::get("trouble.contact", [], null, $lang) ?></a></p>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>