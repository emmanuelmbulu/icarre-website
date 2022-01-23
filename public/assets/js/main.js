!function($) {
    "use strict";
    $(window).on("scroll", (function() {
        $(this).scrollTop() > 350 ? $(".header-sticky").addClass("sticky") : $(".header-sticky").removeClass("sticky")
    }
    )),
    $(".mobile-menu-bar").on("click", (function() {
        $("body").addClass("fix"),
        $(".mobile-menu-wrapper").addClass("open")
    }
    )),
    $(".btn-close-bar,.body-overlay").on("click", (function() {
        $("body").removeClass("fix"),
        $(".mobile-menu-wrapper").removeClass("open")
    }
    )),
    $(".header-search-icon").on("click", (function() {
        $("body").addClass("fix"),
        $(".offcanvas-search").addClass("open")
    }
    )),
    $(".btn-close-bar,.body-overlay").on("click", (function() {
        $("body").removeClass("fix"),
        $(".offcanvas-search").removeClass("open")
    }
    ));
    var $offCanvasNav = $(".level-1");
    $offCanvasNav.find(".dropdown.level-2").slideUp(),
    $offCanvasNav.on("click", "li a, li .menu-expand, li .dropdown-btn", (function(e) {
        var $this = $(this);
        $this.parent().attr("class").match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) && ("#" === $this.attr("href") || $this.hasClass("menu-expand") || $this.hasClass("dropdown-btn")) && (e.preventDefault(),
        $this.siblings("ul:visible").length ? ($this.parent("li").removeClass("active"),
        $this.siblings("ul").slideUp()) : ($this.parent("li").addClass("active"),
        $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active"),
        $this.closest("li").siblings("li").find("ul:visible").slideUp(),
        $this.siblings("ul").slideDown()))
    }
    )),
    $(".mobile-navigation li.has-children ul").length && $(".mobile-navigation .level-1 li.has-children").append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
    var $scrollUp, $lastScrollTop, $window;
    new Swiper(".hero-slider",{
        loop: !0,
        speed: 750,
        spaceBetween: 30,
        slidesPerView: 1,
        effect: "slide",
        parallax: !0,
        navigation: {
            nextEl: ".home-slider-next",
            prevEl: ".home-slider-prev"
        },
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: "true"
        }
    }),
    new Swiper(".testimonial-carousel .swiper-container",{
        loop: !0,
        speed: 750,
        spaceBetween: 30,
        slidesPerView: 2,
        effect: "slide",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: "true"
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30
            }
        }
    }),
    new Swiper(".brand-logo-carousel .swiper-container",{
        loop: !0,
        speed: 750,
        spaceBetween: 30,
        slidesPerView: 5,
        effect: "slide",
        breakpoints: {
            320: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            480: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 30
            },
            992: {
                slidesPerView: 5,
                spaceBetween: 30
            }
        }
    }),
    new Swiper(".project-carousel .swiper-container",{
        loop: !0,
        slidesPerView: 4,
        spaceBetween: 30,
        observer: !0,
        observeParents: !0,
        autoHeight: !0,
        setWrapperSize: !0,
        pagination: {
            el: ".project-carousel .swiper-pagination"
        },
        navigation: {
            nextEl: ".project-carousel .swiper-button-next",
            prevEl: ".project-carousel .swiper-button-prev"
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            575: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 30
            }
        }
    });
    ($(window).on("load", (function() {
        $(".project-tab").on("click", "button", (function() {
            var filterValue = $(this).attr("data-filter");
            $(this).siblings(".is-checked").removeClass("is-checked"),
            $(this).addClass("is-checked"),
            $grid.isotope({
                filter: filterValue
            })
        }
        ));
        var $grid = $(".mesonry-list").isotope({
            percentPosition: !0,
            transitionDuration: "0.7s",
            layoutMode: "masonry",
            masonry: {
                columnWidth: ".resizer"
            }
        })
    }
    )),
    $(".odometer").length) && ($(".odometer").offset().top < $(window).height() && $(".odometer").each((function() {
        $(this).html($(this).data("count-to"))
    }
    )),
    $(window).on("scroll", (function() {
        $(".odometer").offset().top < function() {
            var scrollPos = $(window).scrollTop()
              , winHeight = $(window).height();
            return Math.round(scrollPos + winHeight / 1.2)
        }() && $(".odometer").each((function() {
            $(this).html($(this).data("count-to"))
        }
        ))
    }
    )));
    $(window).on("scroll", (function() {
        AOS.init({
            duration: 1200,
            disable: !1,
            offset: 30,
            once: !0,
            easing: "ease"
        })
    }
    )),
    AOS.init({
        duration: 1200,
        disable: !1,
        offset: 30,
        once: !0,
        easing: "ease"
    }),
    $scrollUp = $("#scroll-top"),
    $lastScrollTop = 0,
    ($window = $(window)).on("scroll", (function() {
        var st = $(this).scrollTop();
        st > $lastScrollTop ? $scrollUp.removeClass("show") : $window.scrollTop() > 200 ? $scrollUp.addClass("show") : $scrollUp.removeClass("show"),
        $lastScrollTop = st
    }
    )),
    $scrollUp.on("click", (function(evt) {
        $("html, body").animate({
            scrollTop: 0
        }, 600),
        evt.preventDefault()
    }
    )),
    $("#mc-form").ajaxChimp({
        language: "en",
        callback: function(resp) {
            "success" === resp.result ? ($(".mailchimp-success").html("" + resp.msg).fadeIn(900),
            $(".mailchimp-error").fadeOut(400)) : "error" === resp.result && $(".mailchimp-error").html("" + resp.msg).fadeIn(900)
        },
        url: "http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"
    }),
    $((function() {
        var form = $("#contact-form")
          , formMessages = $(".form-messege");
        $(form).submit((function(e) {
            e.preventDefault();
            var formData = $(form).serialize();
            $.ajax({
                type: "POST",
                url: $(form).attr("action"),
                data: formData
            }).done((function(response) {
                $(formMessages).removeClass("error"),
                $(formMessages).addClass("success"),
                $(formMessages).text(response),
                $("#contact-form input,#contact-form textarea").val("")
            }
            )).fail((function(data) {
                $(formMessages).removeClass("success"),
                $(formMessages).addClass("error"),
                "" !== data.responseText ? $(formMessages).text(data.responseText) : $(formMessages).text("Oops! An error occured and your message could not be sent.")
            }
            ))
        }
        ))
    }
    ))
}(jQuery);
//# sourceURL=https://cdn2.hubspot.net/hub/19899805/hub_generated/template_assets/48247472476/1623747430956/terbay/js/main.js
