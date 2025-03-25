<script>
/* ==================================================
    # Advisor Carousel
    ===============================================*/
$('.advisor-carousel').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    navText: [
        "<i class='fa fa-angle-left'></i>",
        "<i class='fa fa-angle-right'></i>"
    ],
    dots: false,
    autoplay: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});

$(".popup-gallery").magnificPopup({
    type: 'image',
    gallery: {
        enabled: true
    },
    // other options
});

$(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
    type: "iframe",
    mainClass: "mfp-fade",
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
});

$('.magnific-mix-gallery').each(function() {
    var $container = $(this);
    var $imageLinks = $container.find('.item');

    var items = [];
    $imageLinks.each(function() {
        var $item = $(this);
        var type = 'image';
        if ($item.hasClass('magnific-iframe')) {
            type = 'iframe';
        }
        var magItem = {
            src: $item.attr('href'),
            type: type
        };
        magItem.title = $item.data('title');
        items.push(magItem);
    });

    $imageLinks.magnificPopup({
        mainClass: 'mfp-fade',
        items: items,
        gallery: {
            enabled: true,
            tPrev: $(this).data('prev-text'),
            tNext: $(this).data('next-text')
        },
        type: 'image',
        callbacks: {
            beforeOpen: function() {
                var index = $imageLinks.index(this.st.el);
                if (-1 !== index) {
                    this.goTo(index);
                }
            }
        }
    });
});
</script>