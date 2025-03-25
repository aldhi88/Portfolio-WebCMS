!(function (s) {
    "use strict";
    function e() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || (console.log("pressed"), s("body").removeClass("fullscreen-enable"));
    }
    var n;
    s("#side-menu").metisMenu(),
        s("#vertical-menu-btn").on("click", function (e) {
            e.preventDefault(), s("body").toggleClass("sidebar-enable"), 992 <= s(window).width() ? s("body").toggleClass("vertical-collpsed") : s("body").removeClass("vertical-collpsed");
        }),
        s("body,html").click(function (e) {
            var t = s("#vertical-menu-btn");
            t.is(e.target) || 0 !== t.has(e.target).length || e.target.closest("div.vertical-menu") || s("body").removeClass("sidebar-enable");
        }),
        s("#sidebar-menu a").each(function () {
            var e = window.location.href.split(/[?#]/)[0];
            this.href == e &&
                (s(this).addClass("active"),
                s(this).parent().addClass("mm-active"),
                s(this).parent().parent().addClass("mm-show"),
                s(this).parent().parent().prev().addClass("mm-active"),
                s(this).parent().parent().parent().addClass("mm-active"),
                s(this).parent().parent().parent().parent().addClass("mm-show"),
                s(this).parent().parent().parent().parent().parent().addClass("mm-active"));
        }),
        s(".navbar-nav a").each(function () {
            var e = window.location.href.split(/[?#]/)[0];
            this.href == e &&
                (s(this).addClass("active"),
                s(this).parent().addClass("active"),
                s(this).parent().parent().addClass("active"),
                s(this).parent().parent().parent().addClass("active"),
                s(this).parent().parent().parent().parent().addClass("active"),
                s(this).parent().parent().parent().parent().parent().addClass("active"));
        }),
        s('[data-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault(),
                s("body").toggleClass("fullscreen-enable"),
                document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                    ? document.cancelFullScreen
                        ? document.cancelFullScreen()
                        : document.mozCancelFullScreen
                        ? document.mozCancelFullScreen()
                        : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                    : document.documentElement.requestFullscreen
                    ? document.documentElement.requestFullscreen()
                    : document.documentElement.mozRequestFullScreen
                    ? document.documentElement.mozRequestFullScreen()
                    : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }),
        document.addEventListener("fullscreenchange", e),
        document.addEventListener("webkitfullscreenchange", e),
        document.addEventListener("mozfullscreenchange", e),
        s(".dropdown-menu a.dropdown-toggle").on("click", function (e) {
            return s(this).next().hasClass("show") || s(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), s(this).next(".dropdown-menu").toggleClass("show"), !1;
        }),
        s(function () {
            s('[data-toggle="tooltip"]').tooltip();
        }),
        s(function () {
            s('[data-toggle="popover"]').popover();
        }),
        Waves.init();
})(jQuery);
