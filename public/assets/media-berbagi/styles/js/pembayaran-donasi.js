// OPEN & CLOSE SHADOW MODAL
function openShadow() {
    $("#shadow-modal").css({ visibility: "visible", "z-index": "90" });
}
function closeShadow() {
    $("#shadow-modal").css({ visibility: "hidden", "z-index": "-10" });
}

// PILIH NOMINAL DONASI
$(".page-pembayaran-donasi-main__pilih__nominal__donasi").click(function () {
    $(this)
        .siblings()
        .removeClass(
            "page-pembayaran-donasi-main__pilih__nominal__donasi-active"
        );
    $(this).addClass(
        "page-pembayaran-donasi-main__pilih__nominal__donasi-active"
    );
    $('#nominal_donasi').val(formatRupiah($(this).data("nominal").toString(), 'Rp. '))
    $("#nominal_value").val( $(this).data("nominal"))
});

// INPUT DONASI ACTIVE
$(".page-pembayaran-donasi-main__input__nominal__donasi").on(
    "keyup",
    function () {
        $(".page-pembayaran-donasi-main__pilih__nominal__donasi").removeClass(
            "page-pembayaran-donasi-main__pilih__nominal__donasi-active"
        );
    }
);

// CLICK DONASI SEKARANG: OPEN & CLOSE
$(".page-pembayaran-donasi-main__pilih__pembayaran").click(function () {
    $("#pilih-metode-pembayaran").css({ bottom: "0px" });
    openShadow();
});
$(".pilih-metode-pembayaran-close").click(function () {
    $("#pilih-metode-pembayaran").css({ bottom: "-200%" });
    closeShadow();
});

$(".pilih-metode-pembayaran__payment").click(function () {
    $(".pilih-metode-pembayaran__payment").removeClass(
        "pilih-metode-pembayaran__payment-active"
    );
    $(this).addClass("pilih-metode-pembayaran__payment-active");

    $(".page-pembayaran-donasi-main__pilih__pembayaran").html($(this).data(""));
});

function processPayment(payment_method) {
    $("#payment_method").val(payment_method);
    $("#pilih-metode-pembayaran").css({ bottom: "-200%" });
    $("#selected-payment-method").html(payment_method.split("-")[2]);
    closeShadow();
}

function openLoading(){
    $("#loading").removeClass('d-none')
}