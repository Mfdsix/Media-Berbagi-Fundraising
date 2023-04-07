// INIT SWIPER
const swiperArticleMenu = new Swiper("#aritcle-slider-menu", {
    slidesPerView: "auto",
    spaceBetween: 26,
    observer: true,
  });

// INIT SWIPER
const swiperArticleSlide = new Swiper("#page-article-slide-swiper", {
  slidesPerView: "auto",
  spaceBetween: 18,
  observer: true,
  centeredSlides: true,
  loop: true,
  pagination: {
    el: ".page-article-slide-swiper-pagination",
  },
});

// OPEN & CLOSE SHADOW MODAL
function openShadow() {
  $('#shadow-modal').css({ 'visibility': 'visible', 'z-index': '90' });
}
function closeShadow() {
  $('#shadow-modal').css({ 'visibility': 'hidden', 'z-index': '-10' });
}