$(".rupiah").on("keyup", function () {
    $(this).val(convertToRupiah($(this).val()));
});

function convertToRupiah(angka) {
    if (angka == NaN) return 0;
    var number_string = angka.toString().replace(/\./g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return rupiah;
}

function copyToClipboard(value) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(value).select();
    document.execCommand("copy");
    $temp.remove();
    var toast = new iqwerty.toast.Toast();
    toast.setText("Text disalin ke papan klip").show();
}

function goBack() {
    window.history.back();
}
