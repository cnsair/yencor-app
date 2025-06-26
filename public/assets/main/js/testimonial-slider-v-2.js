const owl = $("#testimonial-test");

owl.owlCarousel({
  items: 3,
  loop: true,
  dots: false,
  nav: true,
  margin: 10,
  itemsDesktop: [1199, 3],
  itemsDesktopSmall: [980, 2],
  itemsMobile: [600, 1],
  navigation: true,
  navText: [
    '<i class="fal fa-angle-left"></i>',
    '<i class="fal fa-angle-right"></i>',
  ],
  responsive: {
    0: {
      items: 1,
      nav: true,
    },
    700: {
      items: 2,
      nav: true,
    },
    1024: {
      items: 2,
      nav: true,
    },
    1366: {
      items: 3,
      nav: true,
    },
  },
});

$(document).ready(function () {
  owl.on("changed.owl.carousel", function (event) {
    $(".owl-nav").removeClass("disabled");
  });

  $(".owl-nav").removeClass("disabled");
  $(".owl-prev").addClass("prev-btn");
  $(".owl-next").addClass("next-btn");
});
