<?php
use Fuel\Core\Asset;
use Fuel\Core\Lang;
use Fuel\Core\Router;

Lang::load('index.json', null, $lang);

Asset::instance()->add_type(
    'mp4',
    'assets/videos/',
    function($file, $attr, $inline=null) {
        $html = '<video autoplay="" muted="" poster="" id="bgvid" loop="" style="width:100%">
            <source src="'.$file.'" ';
        foreach ($attr as $key => $value) {
            $html .= $key.' = "'.$value.'" ';
        }
        $html .= '></video>';
        return $html;
    }
);

Asset::add_path('assets/videos/', 'mp4');
?>
<div class="container-fluid body-container body-container--home p-0">
    <div class="row-fluid-wrapper">
        <div class="row-fluid">
            <div class="span12 widget-span widget-type-cell " data-widget-type="cell" data-x="0" data-w="12">
                <div class="row-fluid-wrapper row-depth-1 row-number-1 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-1" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section">
                                    <div class="hero-slider swiper-container swiper-container-initialized swiper-container-horizontal">
                                        <div class="swiper-wrapper" id="swiper-wrapper-1f838fb5fd2f5980" aria-live="polite" style="transition: all 0ms ease 0s; transform: translate3d(-2174px, 0px, 0px);">
                                            <div class="hero-slide-item swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="1" role="group" aria-label="1 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-sante.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.health.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.health.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.health.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.health.url", [], null, $lang) ?>"><?= Lang::get("slider.health.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="0" role="group" aria-label="2 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <?= Asset::mp4("finance-background.mp4", ["type" => "video/mp4"]) ?>
                                                    <!--img src="<?= Asset::get_file('slide-2.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;"-->
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.invest.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.invest.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.invest.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Router::get("about", ["lang" => $lang]) ?>"><?= Lang::get("slider.invest.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="2" role="group" aria-label="3 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-crowdfunding.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.crowdfunding.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.crowdfunding.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.crowdfunding.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.crowdfunding.url", [], null, $lang) ?>"><?= Lang::get("slider.crowdfunding.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="3" role="group" aria-label="4 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-art.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.art.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.art.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.art.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.art.url", [], null, $lang) ?>"><?= Lang::get("slider.art.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="4" role="group" aria-label="5 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-it.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.it.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.it.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.it.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.it.url", [], null, $lang) ?>"><?= Lang::get("slider.it.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="1" role="group" aria-label="6 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-sante.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.health.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.health.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.health.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.health.url", [], null, $lang) ?>"><?= Lang::get("slider.health.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="0" role="group" aria-label="7 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <?= Asset::mp4("finance-background.mp4", ["type" => "video/mp4"]) ?>
                                                    <!--img src="<?= Asset::get_file('slide-2.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;"-->
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.invest.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.invest.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.invest.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.invest.url", [], null, $lang) ?>"><?= Lang::get("slider.invest.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="2" role="group" aria-label="8 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-crowdfunding.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.crowdfunding.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.crowdfunding.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.crowdfunding.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.crowdfunding.url", [], null, $lang) ?>"><?= Lang::get("slider.crowdfunding.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="3" role="group" aria-label="9 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-art.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.art.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.art.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.art.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.art.url", [], null, $lang) ?>"><?= Lang::get("slider.art.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hero-slide-item swiper-slide swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="4" role="group" aria-label="10 / 10" style="width: 1057px; margin-right: 30px;">
                                                <div class="hero-slide-bg">
                                                    <img src="<?= Asset::get_file('slide-it.jpg', 'img') ?>" alt="slider" loading="" style="max-width: 100%; height: auto;">
                                                </div>
                                                <div class="container">
                                                    <div class="hero-slide-content">
                                                        <span class="sub-title"><?= Lang::get("slider.it.subtitle", [], null, $lang) ?> </span>
                                                        <h2 class="title"><?= Lang::get("slider.it.title", [], null, $lang) ?> </h2>
                                                        <p><?= Lang::get("slider.it.paragraph", [], null, $lang) ?></p>
                                                        <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("slider.it.url", [], null, $lang) ?>"><?= Lang::get("slider.it.button", [], null, $lang) ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
                                            <span class="swiper-pagination-bullet" tabindex="0" role="button" aria-label="Go to slide "></span>
                                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active" tabindex="0" role="button" aria-label="Go to slide "></span>
                                        </div>
                                        <div class="home-slider-prev swiper-button-prev main-slider-nav" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-1f838fb5fd2f5980">
                                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                                        </div>
                                        <div class="home-slider-next swiper-button-next main-slider-nav" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-1f838fb5fd2f5980">
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </div>
                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->

                <div class="row-fluid-wrapper row-depth-1 row-number-2 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-2" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section section-padding overflow-hidden ">
                                    <div class="container">
                                        <!-- Section Title Start -->
                                        <div class="section-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                            <h2 class="title"><?= Lang::get("whatwedo.title", [], null, $lang) ?></h2>
                                            <span></span>
                                            <p class="sub-title"><?= Lang::get("whatwedo.subtitle", [], null, $lang) ?></p>
                                        </div>
                                        <!-- Section Title End -->

                                        <!-- About Image/Timeline Start -->
                                        <div class="row mb-n7">
                                            <div class="col-lg-6 col-12 mb-7">
                                                <div class="row no-gutters">
                                                    <div class="col-6 pr-1">
                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay mb-2 aos-init aos-animate" data-aos="fade-right" data-aos-delay="400">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-1.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->

                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay aos-init aos-animate" data-aos="fade-right" data-aos-delay="500">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-2.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->
                                                    </div>
                                                    <div class="col-6 pl-1">
                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay aos-init aos-animate" data-aos="fade-right" data-aos-delay="300">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-3.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->
                                                    </div>
                                                </div>
                                                <div class="row no-gutters pt-2">
                                                    <div class="col-6 pr-1">
                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay mb-2 aos-init aos-animate" data-aos="fade-right" data-aos-delay="400">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-1.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->

                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay aos-init aos-animate" data-aos="fade-right" data-aos-delay="500">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-2.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->
                                                    </div>
                                                    <div class="col-6 pl-1">
                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay mb-2 aos-init aos-animate" data-aos="fade-right" data-aos-delay="400">
                                                            <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/about/about-1.jpg" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->

                                                        <!-- About Single Image Start -->
                                                        <div class="about-image overlay aos-init aos-animate" data-aos="fade-right" data-aos-delay="500">
                                                            <img src="<?= Asset::get_file("icarre-logo-color-reversed.jpg", "img") ?>" alt="About Image" loading="lazy" style="max-width: 100%; height: auto;">
                                                        </div>
                                                        <!-- About Single Image End -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12 align-self-center mb-n7">
                                                <!-- Feature Box Wrapper Start -->
                                                <div class="feature-box-wrapper feature-box-border mb-7 pb-7 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                                                    <div class="feature-box-icon">
                                                        <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/icon/about-icon-1.png" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="feature-content">
                                                        <h4 class="title"><?= Lang::get("whatwedo.invest.title", [], null, $lang) ?></h4>
                                                        <p><?= Lang::get("whatwedo.invest.paragraph", [], null, $lang) ?></p>
                                                    </div>
                                                </div>
                                                <!-- Feature Box Wrapper End -->

                                                <!-- Feature Box Wrapper Start -->
                                                <div class="feature-box-wrapper feature-box-border mb-7 pb-7 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                                                    <div class="feature-box-icon">
                                                        <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/icon/about-icon-2.png" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="feature-content">
                                                        <h4 class="title"><?= Lang::get("whatwedo.art.title", [], null, $lang) ?></h4>
                                                        <p><?= Lang::get("whatwedo.art.paragraph", [], null, $lang) ?></p>
                                                    </div>
                                                </div>
                                                <!-- Feature Box Wrapper End -->

                                                <!-- Feature Box Wrapper Start -->
                                                <div class="feature-box-wrapper feature-box-border mb-7 pb-7 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                                                    <div class="feature-box-icon">
                                                        <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/icon/about-icon-3.png" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="feature-content">
                                                        <h4 class="title"><?= Lang::get("whatwedo.it.title", [], null, $lang) ?></h4>
                                                        <p><?= Lang::get("whatwedo.it.paragraph", [], null, $lang) ?></p>
                                                    </div>
                                                </div>
                                                <!-- Feature Box Wrapper End -->

                                                <!-- Feature Box Wrapper Start -->
                                                <div class="feature-box-wrapper feature-box-border mb-7 pb-7 aos-init aos-animate" data-aos="fade-left" data-aos-delay="300">
                                                    <div class="feature-box-icon">
                                                        <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/icon/about-icon-3.png" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                                    </div>
                                                    <div class="feature-content">
                                                        <h4 class="title"><?= Lang::get("whatwedo.health.title", [], null, $lang) ?></h4>
                                                        <p><?= Lang::get("whatwedo.health.paragraph", [], null, $lang) ?></p>
                                                    </div>
                                                </div>
                                                <!-- Feature Box Wrapper End -->
                                            </div>
                                        </div>
                                        <!-- About Image/Content End -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->

                <div class="row-fluid-wrapper row-depth-1 row-number-3 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-3" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section section-padding bg-secondary ">
                                    <div class="container">
                                        <div class="row">
                                            <!-- Section Title Start -->
                                            <div class="col-12 section-title mb-10 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                <h2 class="title text-white"><?= Lang::get("expertise.title", [], null, $lang) ?></h2>
                                                <span></span>
                                                <p class="sub-title text-white"><?= Lang::get("expertise.subtitle", [], null, $lang) ?></p>
                                            </div>
                                            <!-- Section Title End -->
                                        </div>
                                        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-1 mb-n8">
                                            <?php
                                                $expertises = ["trading", "audit", "network", "dev", "cybersecurity", "data"];
                                                foreach ($expertises as $key => $value) { ?>
                                                    <!-- Single project Start -->
                                                    <div class="col mb-8">
                                                        <div class="single-project aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                            <div class="project-image">
                                                                <a class="project-overlay" href="<?= Lang::get('expertise.'.$value.'.url', [], null, $lang) ?>">
                                                                    <img src="<?= Asset::get_file(Lang::get('expertise.'.$value.'.img', [], null, $lang), "img") ?>" alt="project" loading="" style="max-width: 100%; height: auto;">
                                                                </a>
                                                            </div>
                                                            <div class="project-content">
                                                                <h4 class="title">
                                                                    <a href="<?= Lang::get('expertise.'.$value.'.url', [], null, $lang) ?>"><?= Lang::get('expertise.'.$value.'.title', [], null, $lang) ?></a>
                                                                </h4>
                                                                <ul class="project-tag">
                                                                    <li><a href="./project-details?hsLang=en-us"><?= Lang::get('expertise.'.$value.'.grandparent', [], null, $lang) ?></a></li>
                                                                    <li><a href="./project-details?hsLang=en-us"><?= Lang::get('expertise.'.$value.'.parent', [], null, $lang) ?></a></li>
                                                                </ul>
                                                                <a class="link" href="<?= Lang::get('expertise.'.$value.'.url', [], null, $lang) ?>"><?= Lang::get('expertise.button', [], null, $lang) ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Single Portfolio End -->
                                            <?php    }
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 text-center mt-10">
                                                <div class="load-more aos-init aos-animate" data-aos="fade-up" data-aos-delay="500">
                                                    <a class="btn btn-hover-secondary btn-primary" href="<?= Lang::get("expertise.url", [], null, $lang) ?>">
                                                        <i class="fa fa-arrow-right mr-1" aria-hidden="true"></i> <?= Lang::get("expertise.more", [], null, $lang) ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->

                <!-- row-wrapper for the team -->
                <!-- end row-wrapper for the team -->

                <div class="row-fluid-wrapper row-depth-1 row-number-5 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-5" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section funfact-bg " style="<?= 'background-image: url(\''.Asset::get_file('satisfaction.jpg', 'img').'\')' ?>">
                                    <div class="container">
                                        <div class="row row-cols-sm-2 row-cols-lg-4 row-cols-1 mb-n10">
                                            <?php
                                                $satisfactions = ["invest", "dev", "audit", "network"];
                                                foreach ($satisfactions as $key => $value) { ?>
                                                    <!-- FunFact Area Start -->
                                                    <div class="col mb-10">
                                                        <!-- Single FunFact Start -->
                                                        <div class="funfact-wrap aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                            <div class="funfact-icon">
                                                                <img src="//fs.hubspotusercontent00.net/hubfs/19899805/raw_assets/public/terbay/images/icon/funfact-icon-1.png" alt="icon" loading="" style="max-width: 100%; height: auto;">
                                                            </div>
                                                            <span class="odometer odometer-auto-theme" data-count-to="<?= Lang::get("satisfaction.".$value.".stats", [], null, $lang) ?>"></span>
                                                            <h6 class="title"><?= Lang::get("satisfaction.".$value.".title", [], null, $lang) ?></h6>
                                                        </div>
                                                        <!-- Single FunFact End -->
                                                    </div>
                                                    <!-- FunFact Area End -->
                                            <?php    } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->

                <div class="row-fluid-wrapper row-depth-1 row-number-6 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-6" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section section-padding  ">
                                    <div class="container">
                                        <div class="row">
                                            <!-- Section Title Start -->
                                            <div class="col-12 section-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                <h2 class="title"><?= Lang::get("testimonials.title", [], null, $lang) ?></h2>
                                                <span></span>
                                                <p class="sub-title"><?= Lang::get("testimonials.subtitle", [], null, $lang) ?></p>
                                            </div>
                                            <!-- Section Title End -->
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="testimonial-carousel">
                                                    <div class="swiper swiper-testimonies swiper-container">
                                                        <div class="swiper-wrapper" >
                                                            <?php foreach (Lang::get("testimonials.testimonies", [], null, $lang) as $key => $item) { ?>
                                                                <div class="swiper-slide" style="width:570px; margin-right: 30px">
                                                                    <div class="testimonial aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                        <div class="text">
                                                                            <p><?= $item["text"] ?></p>
                                                                        </div>
                                                                        <div class="thumb">
                                                                            <img src="<?= $item['img'] ?>" alt="testimonial" loading="" style="max-width: 100%; height: auto;">
                                                                            <div class="name">
                                                                                <h2 class="title"><?= $item["name"] ?></h2>
                                                                                <h4 class="sub-title"><?= $item["title"] ?></h4>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <!-- pagination -->
                                                        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
                                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->
                
                <div class="row-fluid-wrapper row-depth-1 row-number-7 dnd-section">
                    <div class="row-fluid ">
                        <div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
                            <div id="hs_cos_wrapper_dnd_area-module-7" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module">
                                <div class="section bg-secondary brand-logo-bg ">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <div class="brand-logo-carousel text-center">
                                                    <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                                                        <div class="swiper-wrapper align-items-center" id="swiper-wrapper-6859f638c07e1e82" aria-live="polite" style="transform: translate3d(-960px, 0px, 0px); transition: all 0ms ease 0s;">
                                                            <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" role="group" aria-label="1 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/phronesis-brand.png", "img") ?>" alt="Phronesis Finance Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" role="group" aria-label="2 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/iccn-brand.png", "img") ?>" alt="ICCN Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" data-swiper-slide-index="2" role="group" aria-label="3 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/dprc-kinshasa-brand.png", "img") ?>" alt="DPRC Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" data-swiper-slide-index="3" role="group" aria-label="4 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/turing-brand.png", "img") ?>" alt="Turing Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" data-swiper-slide-index="4" role="group" aria-label="5 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/tmb-brand.png", "img") ?>" alt="TMB Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>

                                                            <!-- Single Brand Logo Start -->
                                                            <div class="swiper-slide" data-swiper-slide-index="5" role="group" aria-label="6 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/maharishi-university-brand.png", "img") ?>" alt="MAHARISHI UNIVERSITY Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <!-- Single Brand Logo End -->

                                                            <!-- Single Brand Logo Start -->
                                                            <div class="swiper-slide" data-swiper-slide-index="6" role="group" aria-label="7 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/linkedin-brand.png", "img") ?>" alt="LinkedIn Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <!-- Single Brand Logo End -->

                                                            <!-- Single Brand Logo Start -->
                                                            <div class="swiper-slide" data-swiper-slide-index="7" role="group" aria-label="8 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/virtual-consult-brand.png", "img") ?>" alt="Virtual Consult Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <!-- Single Brand Logo End -->

                                                            <!-- Single Brand Logo Start -->
                                                            <div class="swiper-slide" data-swiper-slide-index="8" role="group" aria-label="9 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/bongo-brand.png", "img") ?>" alt="Bongo Logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div>
                                                            <!-- Single Brand Logo End -->
                                                            
                                                            <!-- Single Brand Logo Start -->
                                                            <!--div class="swiper-slide swiper-slide-duplicate-prev" data-swiper-slide-index="4" role="group" aria-label="10 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/iccn-brand.png", "img") ?>" alt="brand-logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div-->
                                                            <!-- Single Brand Logo End -->

                                                            <!--div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="0" role="group" aria-label="11 / 15" style="width: 162px; margin-right: 30px;">
                                                                <div class="brand-logo aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                                                    <img src="<?= Asset::get_file("partners/dprc-kinshasa-brand.png", "img") ?>" alt="brand-logo" loading="" style="max-width: 100%; height: auto;">
                                                                </div>
                                                            </div-->
                                                            
                                                        </div>

                                                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end widget-span -->
                    </div>
                    <!--end row-->
                </div>
                <!--end row-wrapper -->
                
                <div class="row-fluid-wrapper row-depth-1 row-number-8 dnd-section">
<div class="row-fluid ">
<div class="span12 widget-span widget-type-custom_widget dnd-module" data-widget-type="custom_widget" data-x="0" data-w="12">
<div id="hs_cos_wrapper_dnd_area-module-8" class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module" data-hs-cos-general-type="widget" data-hs-cos-type="module"><div class="section section-padding ">
        <div class="container">

            <!-- Section Title Start -->
            <div class="col-12 section-title aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                <h2 class="title">Latest Blog</h2>
                <span></span>
                <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
            <!-- Section Title End -->

            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1 mb-n6">
              
               
              
                <div class="col mb-6">
                    <!-- Blog Single Post Start -->
                    <div class="blog-single-post-wrapper aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="blog-thumb">
                            <a class="blog-overlay" href="//19899805.hs-sites.com/blog/bridge-construction?hsLang=en-us">
                                <img src="https://fs.hubspotusercontent00.net/hubfs/19899805/blog-details-2.jpg" alt="Blog Post">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span>By : Md Shohel</span>
                                <span>June 8 2021</span>
                            </div>
                            <h3 class="title"><a href="//19899805.hs-sites.com/blog/bridge-construction?hsLang=en-us">Bridge construction</a></h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered ...</p>
                            <a href="//19899805.hs-sites.com/blog/bridge-construction?hsLang=en-us" class="btn btn-outline-matterhorn btn-hover-primary btn-sm">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Single Post End -->
                </div>
              
                <div class="col mb-6">
                    <!-- Blog Single Post Start -->
                    <div class="blog-single-post-wrapper aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="blog-thumb">
                            <a class="blog-overlay" href="//19899805.hs-sites.com/blog/modern-road-construction-machines?hsLang=en-us">
                                <img src="https://fs.hubspotusercontent00.net/hubfs/19899805/blog-details-3.jpg" alt="Blog Post">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span>By : Md Shohel</span>
                                <span>June 8 2021</span>
                            </div>
                            <h3 class="title"><a href="//19899805.hs-sites.com/blog/modern-road-construction-machines?hsLang=en-us">Modern Road Construction Machines</a></h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered ...</p>
                            <a href="//19899805.hs-sites.com/blog/modern-road-construction-machines?hsLang=en-us" class="btn btn-outline-matterhorn btn-hover-primary btn-sm">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Single Post End -->
                </div>
              
                <div class="col mb-6">
                    <!-- Blog Single Post Start -->
                    <div class="blog-single-post-wrapper aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <div class="blog-thumb">
                            <a class="blog-overlay" href="//19899805.hs-sites.com/blog/construction-new-project-opening?hsLang=en-us">
                                <img src="https://fs.hubspotusercontent00.net/hubfs/19899805/blog-details-4.jpg" alt="Blog Post">
                            </a>
                        </div>
                        <div class="blog-content">
                            <div class="post-meta">
                                <span>By : Md Shohel</span>
                                <span>June 8 2021</span>
                            </div>
                            <h3 class="title"><a href="//19899805.hs-sites.com/blog/construction-new-project-opening?hsLang=en-us">Construction new project opening</a></h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered ...</p>
                            <a href="//19899805.hs-sites.com/blog/construction-new-project-opening?hsLang=en-us" class="btn btn-outline-matterhorn btn-hover-primary btn-sm">Read More</a>
                        </div>
                    </div>
                    <!-- Blog Single Post End -->
                </div>
              
            </div>
        </div>
    </div></div>

</div><!--end widget-span -->
</div><!--end row-->
</div><!--end row-wrapper -->

</div><!--end widget-span -->
</div>
</div>
</div>