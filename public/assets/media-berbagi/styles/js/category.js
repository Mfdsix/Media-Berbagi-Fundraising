// INIT SWIPER
const swiperCategoryMenu = new Swiper("#page-category-menu-container", {
  slidesPerView: "auto",
  spaceBetween: 26,
  observer: true,
});

// CATEGORY CHANGE ACRTIVE
$(".page-category-menu__list").click(function () {
  $(this).siblings().removeClass("page-category-menu__list__active");
  $(this).addClass("page-category-menu__list__active");
});

// NEWS CHANGE ACTIVE
$(".button__menu__2__news-trending").click(function () {
  $(this).siblings().removeClass("button__menu__2__news__active");
  $(this).addClass("button__menu__2__news__active");
  $('#kegiatan-row-new').hide(200);
  $('#kegiatan-row-trending').show(200);
});
$(".button__menu__2__news-new").click(function () {
  $(this).siblings().removeClass("button__menu__2__news__active");
  $(this).addClass("button__menu__2__news__active");
  $('#kegiatan-row-trending').hide(200);
  $('#kegiatan-row-new').show(200);
});
