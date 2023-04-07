$('.method-check').on('change', function() {
    $('.method-check').not($(this)).prop('checked', false)
})