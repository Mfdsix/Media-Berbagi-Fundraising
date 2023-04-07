const swiper = new Swiper("#histori-donasi-slider", {
  slidesPerView: "auto",
  spaceBetween: 8,
  observer: true,
});

function CampaignCategory(e,f) {
  $('.page-categori-historu-donasi__link').each((x,y) => {
    $(y).removeClass('page-categori-historu-donasi__link__active')
  })
  $(f).addClass('page-categori-historu-donasi__link__active')
}