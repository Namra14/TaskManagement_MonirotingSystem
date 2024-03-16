$(document).ready(function () {
  var multipleCardCarousel = document.querySelector(
  "#carouselExampleControls"
);
if (window.matchMedia("(min-width: 576px)").matches) {
  var carousel = new bootstrap.Carousel(multipleCardCarousel, {
    interval: false,
    wrap: false
  });
  var carouselWidth = $(".carousel-inner")[0].scrollWidth;
  var cardWidth = $(".carousel-item").width();
  var scrollPosition = 0;
  $("#carouselExampleControls .carousel-control-next").on("click", function () {
    if (scrollPosition < carouselWidth - cardWidth * 3) {
      scrollPosition += cardWidth;
      $("#carouselExampleControls .carousel-inner").animate(
        { scrollLeft: scrollPosition },
        600
      );
    }
  });
  $("#carouselExampleControls .carousel-control-prev").on("click", function () {
    if (scrollPosition > 1) {
      scrollPosition -= cardWidth;
      $("#carouselExampleControls .carousel-inner").animate(
        { scrollLeft: scrollPosition },
        600
      );
    }
  });
} else {
  $(multipleCardCarousel).addClass("slide");
}
});

var carousel = new bootstrap.Carousel(multipleCardCarousel, {
  interval: false,
  wrap: false,
});


const searchInput = document.getElementById('searchInput');
const searchIcon = document.getElementById('searchIcon');

searchInput.addEventListener('input', function() {
  if (searchInput.value === '') {
    searchIcon.style.display = 'inline-block'; // Show the icon
  } else {
    searchIcon.style.display = 'none'; // Hide the icon when there is input
  }
});
