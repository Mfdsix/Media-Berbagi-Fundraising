$('.accordion').click(function() {
    $(this).toggleClass('active')
    $(this).next().toggleClass('d-none')
})

$('.btn-copy').click(function() {
    copyToClipboard($('.instruction-account-number').html())
})


$('.btn-cancel-topup').click(function() {
    $('.screen-cover').toggleClass('d-none')
})

$('.btn-cover-disagree').click(function() {
    $('.screen-cover').toggleClass('d-none')
})