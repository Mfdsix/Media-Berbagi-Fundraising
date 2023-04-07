function updateAmount(amount) {
    let rupiah = convertToRupiah(amount);
    $('.quantity-amount').html(`Rp${rupiah}`)
    let donate = $('.btn-donate-now')
    let x = donate.prop('href')
    if(x != undefined) {
        let n = x.indexOf('nominal/')
        let c = x.substr(n+8)
        c = JSON.parse(atob(c))
        c.nominal = amount
        c = btoa(JSON.stringify(c))
        donate.attr('href', x.substr(0,n)+'nominal/'+c)
    }
}

$('.quantity-plus').click(function() {
    let count = parseInt($(this).prev().val())+1;
    $(this).prev().val(count)
    updateAmount($(this).prev().data('amount')*count)
})

$('.quantity-minus').click(function() {
    if(parseInt($(this).next().val()) > 0) {
        let count = parseInt($(this).next().val())-1;
        $(this).next().val(count)

        updateAmount($(this).next().data('amount')*count)
    }
})

$('#btn-share').click(function() {
    $('.screen-cover').toggleClass('d-none')
    $('#bottom-share').toggleClass('d-none')
})



$('.screen-cover').click(function() {
    $('.screen-cover').toggleClass('d-none')
    $('#bottom-share').toggleClass('d-none')
})

$(window).scroll(function() {
    var height = $(window).scrollTop();

    if(height > 420) {
        $('.footer-menu').show();
    } else {
        $('.footer-menu').hide();
    }
});