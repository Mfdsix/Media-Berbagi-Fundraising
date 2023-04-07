$('.btn-read-more').click(function() {
    if($(this).prev().hasClass('expanded')) {
        $(this).html('Read more')
    } else {
        $(this).html('Read less')
    }
    $(this).prev().toggleClass('expanded')
})

$('.btn-view-more').click(function() {
    if($(this).prev().hasClass('expanded')) {
        $(this).html('Read more')
    } else {
        $(this).html('Read less')
    }
    $(this).prev().toggleClass('expanded')
})