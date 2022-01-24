<?php

use Fuel\Core\Asset;
use Fuel\Core\Config;
use Fuel\Core\Lang;
use Fuel\Core\Router;

Config::load("icarre-data-config.json");
$tel = Config::get("tel");
$mail = Config::get("mail");
$address = Config::get("address");

Lang::load("footer.json", null, $lang);
?>
<footer class="section footer-section bg-secondary">
    <!-- Footer Top Start -->
    <div class="footer-top">
        <div class="container">
            <div class="row mb-n10">
                <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-10">
                    <div class="single-footer-widget">
                        <div class="footer-logo">
                            <div id="hs_cos_wrapper_footer_logo" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-logo" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <span id="hs_cos_wrapper_footer_logo_hs_logo_widget" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_logo" data-hs-cos-general-type="widget" data-hs-cos-type="logo"><a href="https://19899805.hs-sites.com/en-us/terbay/home?hsLang=en-us" id="hs-link-footer_logo_hs_logo_widget" style="border-width:0px;border:0px;">
                                    <img src="<?= Asset::get_file("logo_large_reverse.png", "img") ?>" class="hs-image-widget " style="width:177px;border-width:0px;border:0px;" width="177" alt="Footer logo" title="Footer logo"></a>
                                </span>
                            </div>
                        </div>
                        <div id="hs_cos_wrapper_about_text" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                            <span id="hs_cos_wrapper_about_text_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                                <p class="desc-content pt-5 pb-3">Lorem ipsum dolor sit amet, consect ascing elit, sed do eiusmod incididunt ut labore et dolore Many desktop</p>
                            </span>
                        </div>

                        <!-- Contact Address Start -->
                        <ul class="widget-address">
                            <div id="hs_cos_wrapper_contact_info" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <span id="hs_cos_wrapper_contact_info_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                                    <li><i class="fa fa-map-o"></i><span><?= $address ?></span></li>
                                    <li><i class="fa fa-phone"></i><a href="<?= 'tel:'.$tel ?>"><?= $tel ?></a></li>
                                    <li><i class="fa fa-envelope-o"></i><a href="<?= 'mailto:'.$mail ?>"><?= $mail ?></a></li>
                                </span>
                            </div>
                        </ul>
                        <!-- Contact Address End -->
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 col-xl-3 mb-10">
                    <div class="single-footer-widget">
                        <div id="hs_cos_wrapper_footer_widget_title" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-header" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                            <span id="hs_cos_wrapper_footer_widget_title_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_header" data-hs-cos-general-type="widget" data-hs-cos-type="header">
                                <h2><?= Lang::get("expertise.title", [], null, $lang) ?></h2>
                            </span>
                        </div>
                        <ul class="widget-list pt-6">
                            <div id="hs_cos_wrapper_footer_menu_one" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-simple_menu" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <span id="hs_cos_wrapper_footer_menu_one_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_simple_menu" data-hs-cos-general-type="widget" data-hs-cos-type="simple_menu">
                                    <div id="hs_menu_wrapper_footer_menu_one_" class="hs-menu-wrapper active-branch flyouts hs-menu-flow-vertical" role="navigation" data-sitemap-name="" data-menu-id="" aria-label="Navigation Menu">
                                        <ul role="menu">
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("expertise.it", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("expertise.invest", [], null, $lang) ?></a></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("expertise.health", [], null, $lang) ?></a></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("expertise.art", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("expertise.crowdfunding", [], null, $lang) ?></a></li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-2 col-xl-3 mb-10">
                    <div class="single-footer-widget aos-init aos-animate">
                        <div id="hs_cos_wrapper_footer_widget_title" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-header" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                            <span id="hs_cos_wrapper_footer_widget_title_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_header" data-hs-cos-general-type="widget" data-hs-cos-type="header">
                                <h2><?= Lang::get("links.title", [], null, $lang) ?></h2>
                            </span>
                        </div>
                        <ul class="widget-list pt-6">
                            <div id="hs_cos_wrapper_footer_menu_one" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-simple_menu" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <span id="hs_cos_wrapper_footer_menu_one_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_simple_menu" data-hs-cos-general-type="widget" data-hs-cos-type="simple_menu">
                                    <div id="hs_menu_wrapper_footer_menu_one_" class="hs-menu-wrapper active-branch flyouts hs-menu-flow-vertical" role="navigation" data-sitemap-name="" data-menu-id="" aria-label="Navigation Menu">
                                        <ul role="menu">
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="<?= Router::get("index", ["lang" => $lang]) ?>" role="menuitem" target="_self"><?= Lang::get("links.home", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="<?= Router::get("about", ["lang" => $lang]) ?>" role="menuitem" target="_self"><?= Lang::get("links.about", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("links.terms", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("links.health", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("links.art", [], null, $lang) ?></a></li>
                                            <li class="hs-menu-item hs-menu-depth-1" role="none"><a href="#" role="menuitem" target="_self"><?= Lang::get("links.crowdfunding", [], null, $lang) ?></a></li>
                                        </ul>
                                    </div>
                                </span>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-10">
                    <div class="single-footer-widget">
                        <div id="hs_cos_wrapper_footer_widget_title" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-header" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                            <span id="hs_cos_wrapper_footer_widget_title_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_header" data-hs-cos-general-type="widget" data-hs-cos-type="header">
                                <h2><?= Lang::get("newsletter.title", [], null, $lang) ?></h2>
                            </span>
                        </div>
                        <div class="widget-body pt-5">
                            <div id="hs_cos_wrapper_mail_text" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" style="" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <span id="hs_cos_wrapper_mail_text_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                                    <p class="desc-content mb-0"><?= Lang::get("newsletter.paragraph", [], null, $lang) ?></p>
                                </span>
                            </div>
                            
                            <!-- Newsletter Form Start -->
                            <div class="newsletter-form-wrap pt-4">
                                <form id="mc-form" class="mc-form">
                                    <div id="hs_cos_wrapper_site_mail" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-form" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                        <span id="hs_cos_wrapper_site_mail_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_form" data-hs-cos-general-type="widget" data-hs-cos-type="form">
                                            <div id="newsletter-info"></div>
                                        </span>
                                    </div>
                                </form>
                            </div>

                            <div class="newsletter-form-wrap pt-4">
                                <form action="#" id="newsletter-form" class="mc-form" novalidate="true" data-hs-cf-bound="true">
                                    <div id="hs_cos_wrapper_site_mail" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-form" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                        <span id="hs_cos_wrapper_site_mail_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_form" data-hs-cos-general-type="widget" data-hs-cos-type="form">
                                            <div id="hs_form_target_site_mail">
                                                <div class="hs-nested-form-fix">
                                                    <div class="hs_email hs-email hs-fieldtype-text field hs-form-field">
                                                        <div class="input">
                                                            <input id="newsletter-email" class="hs-input" type="email" name="email" placeholder='<?= Lang::get("newsletter.form.placeholder", [], null, $lang) ?>' value="" autocomplete="email" inputmode="email">
                                                        </div>
                                                    </div>
                                                    <div class="hs_submit hs-submit">
                                                        <div class="actions">
                                                            <input type="submit" value='<?= Lang::get("newsletter.form.button", [], null, $lang) ?>' class="hs-button primary large">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </form>
                                <script>
                                    function processForm(e) {
                                        if(e.preventDefault()) e.preventDefault();

                                        const mail_format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                        let mail = document.querySelector("#newsletter-email");
                                        let info = document.querySelector("#newsletter-info");
                                        console
                                        if(mail_format.test(mail.value)) {
                                            mail.value = "";
                                            info.innerHTML("<?= '<p>'.Lang::get('newsletter.form.success', [], null, $lang).'</p>' ?>");
                                        } else {
                                            info.innerHTML("<?= '<p>'.Lang::get('newsletter.form.error', [], null, $lang).'</p>' ?>");
                                        }
                                        return false;
                                    }
                                    let newsletter = document.querySelector("#newsletter-form");
                                    if(newsletter.attachEvent) {
                                        newsletter.attachEvent("submit", processForm);
                                    } else newsletter.addEventListener("submit", processForm);
                                </script>
                            </div>
                            <!-- Newsletter Form End -->

                            <!-- Soclial Link Start -->
                            <div class="social-widget-wrapper mt-6">
                                <div id="hs_cos_wrapper_module_16226538086882" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                    <ul class="widget-social justify-content-start">
                                        <li><a href="https://www.facebook.com/"><i class="fa fa-facebook-f"></i></a></li>
                                        <li><a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li>
                                        <!--li><a href="?hsLang=en-us"><i class="fa fa-vimeo"></i></a></li-->
                                    </ul>
                                </div>
                            </div>
                            <!-- Social Link End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Top End -->

    <!-- Footer Bottom Start -->
    <div class="container">
        <div class="row align-items-center footer-bottom">
            <div class="col-12 text-center">
                <div class="copyright-content">
                    <div id="hs_cos_wrapper_footer_copyright" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module widget-type-rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                        <span id="hs_cos_wrapper_footer_copyright_" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_rich_text" data-hs-cos-general-type="widget" data-hs-cos-type="rich_text">
                            <p class="mb-0"><?= "(c)  ".date("Y")." iCarré - All Rights Reserved."  ?></p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom End -->
</footer>