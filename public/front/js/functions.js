! function(o) {

    "use strict";

    o(window).on("load", function() {

        o('[data-loader="circle-side"]').fadeOut(), o("#preloader").delay(350).fadeOut("slow");

        var e = o(".hero_home .content"),

            a = o("#hero_video .content ");

        e.find("h3, p, form").addClass("fadeInUp animated"), e.find(".btn_1").addClass("fadeIn animated"), a.find(".h3, p, form").addClass("fadeInUp animated"), o(window).scroll()

    });

    var e = o(".header_sticky"),

        a = o("#toTop");

    o(window).on("scroll", function() {

        1 < o(this).scrollTop() ? e.addClass("sticky") : e.removeClass("sticky"), 0 != o(this).scrollTop() ? a.fadeIn() : a.fadeOut()

    }), a.on("click", function() {

        o("body,html").animate({

            scrollTop: 0

        }, 500)

    }), o(".selectbox").selectbox(), o("#results").stick_in_parent({

        spacer: !1,

        offset_top: 0

    }), o("#sidebar").theiaStickySidebar({

        additionalMarginTop: 95

    });

    var n = o("nav#menu").mmenu({

            extensions: ["pagedim-black"],

            counters: !1,

            keyboardNavigation: {

                enable: !0,

                enhance: !0

            },

            navbar: {

                title: "MENU"

            },

            navbars: [{

                position: "bottom",

                content: ['<a href="#0">© Innayat Medical Tourism</a>']

            }]

        }, {

            clone: !0

        }),

        t = o("#hamburger"),

        i = n.data("mmenu");

    t.on("click", function() {

        i.open()

    }), i.bind("open:finish", function() {

        setTimeout(function() {

            t.addClass("is-active")

        }, 100)

    }), i.bind("close:finish", function() {

        setTimeout(function() {

            t.removeClass("is-active")

        }, 100)

    }), new WOW({

        boxClass: "wow",

        animateClass: "animated",

        offset: 0,

        mobile: !0,

        live: !0,

        callback: function(e) {},

        scrollContainer: null

    }).init(), o("#reccomended, #staff, #levelFront, #testimonials").owlCarousel({

        center: !0,

        items: 4,

        loop:true,

        margin:0,

        responsive: {

            0: {

                items: 1

            },

            600: {

                items: 4

            },

            1e3: {

                items: 4

            }

        }

    }), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e) {

        return new bootstrap.Tooltip(e)

    }), o("#booking_date").dateDropper(), o("#booking_time").timeDropper({

        setCurrentTime: !1,

        meridians: !0,

        primaryColor: "#e74e84",

        borderColor: "#e74e84",

        minutesInterval: "15"

    });

  

  

  /*var s = o("#secondary_nav");



    function l(e) {

        o(e.target).prev(".panel-heading").find(".indicator").toggleClass("icon_minus_alt2 icon_plus_alt2")

    }

    s.stick_in_parent(), s.find("ul li a").on("click", function(e) {

        e.preventDefault();

        e = this.hash, e = o(e);

        o("html, body").animate({

            scrollTop: e.offset().top - 95

        }, 300, "swing")

    }), s.find("ul li a").on("click", function() {

        s.find(".active").removeClass("active"), o(this).addClass("active")

    }), o('#faq_box a[href^="#"]').on("click", function() {

        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {

            var e = o(this.hash);

            if ((e = e.length ? e : o("[name=" + this.hash.slice(1) + "]")).length) return o("html,body").animate({

                scrollTop: e.offset().top - 185

            }, 300), !1

        }

    }), o("ul#cat_nav li a").on("click", function() {

        o("ul#cat_nav li a.active").removeClass("active"), o(this).addClass("active")

    }), o(".accordion").on("hidden.bs.collapse shown.bs.collapse", function(e) {

        o(e.target).prev(".card-header").find("i.indicator").toggleClass("icon_minus_alt2 icon_plus_alt2")

    }), o(".panel-group").on("hidden.bs.collapse", l), o(".panel-group").on("shown.bs.collapse", l), o("#password, #password1, #password2").hidePassword("focus", {

        toggle: {

            className: "my-toggle"

        }

    })*/

}(window.jQuery);