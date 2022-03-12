$(document).ready(function () {
    var owl_erp = $(".owl-carousel-erp");
    owl_erp.owlCarousel({
        loop: true,
        dots: false,
        items: 4,
        responsive: {
            0: {
                items: 2,
            },
            600: {
                items: 2,
            },
            800: {
                items: 3,
            },
            1000: {
                items: 4,
            },
        },
    });

    $(".owl-next-custom-erp").click(function () {
        owl_erp.trigger("next.owl.carousel");
    });
    $(".owl-prev-custom-erp").click(function () {
        owl_erp.trigger("prev.owl.carousel");
    });
});

$(document).on("mouseleave", ".cart_button", function () {
    $(this).find(".cart_icon").removeClass("rotate360");
});
$(document).on("mouseover", ".cart_button", function () {
    $(this).find(".cart_icon").addClass("rotate360");
});
$(document).on("mouseenter", ".product_card", function () {
    console.log("enter");
    $(this).find(".cart_button").addClass("slideup");
    $(this).find(".cart_button").css("opacity", "1");
});
$(document).on("mouseleave", ".product_card", function () {
    console.log("leave");
    $(this).find(".cart_button").removeClass("slideup");
    $(this).find(".cart_button").css("opacity", "0");
});
