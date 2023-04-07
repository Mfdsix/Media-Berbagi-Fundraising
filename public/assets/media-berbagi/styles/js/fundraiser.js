$('.page-fundraiser__box__checklist').click(function() {
    let dataInput = $(this).data('input');
    if(dataInput == false || dataInput == 'false') {
        $(this).data('input', 'true');
        $(this).addClass('page-fundraiser__box__checklist-active');
        $('.button-fundraiser-submit').prop("disabled", false);
    } else {
        $(this).data('input', 'false');
        $(this).removeClass('page-fundraiser__box__checklist-active');
        $('.button-fundraiser-submit').prop("disabled", true);
    }
});