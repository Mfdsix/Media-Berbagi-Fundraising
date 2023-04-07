const statusSlider = new Swiper('#swiper-status', {
    slidesPerView: 'auto',
    spaceBetween: 12,
    loop: false,
});

$('.status-block').on("click", function() {
    $('.status-block').removeClass('active')
    $(this).addClass('active')
})

function tabClick(e) {
    $('.history-section').each((n,o) => {
        $(o).hide()
    })
    e.forEach(x=>{
        $(x).show()
    })
}
function goBack() {
    window.history.back()
}