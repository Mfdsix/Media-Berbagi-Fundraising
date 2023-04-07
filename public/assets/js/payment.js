$(".nominal-item").click(function () {
    $(".nominal-donasi").val(convertToRupiah($(this).data("amount")));
    $(".nominal-item").removeClass("selected");
    $(this).toggleClass("selected");
});

$(".nominal-donasi").keyup(function () {
    $(".nominal-donasi").val($(this).val());
});

$(".btn-pay-donation").click(function () {
    $("#form-nominal").submit();
});
