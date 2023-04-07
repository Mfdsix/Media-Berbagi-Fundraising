// INIT SWIPER
const swiper = new Swiper("#home-slider", {
    slidesPerView: "auto",
    spaceBetween: 18,
    observer: true,
    pagination: {
        el: ".home-slider-pagination",
    },
    autoplay: {
        delay: 3000,
    },
});

// OPEN & CLOSE SHADOW MODAL
function openShadow() {
    $("#shadow-modal").css({ visibility: "visible", "z-index": "90" });
}
function closeShadow() {
    $("#shadow-modal").css({ visibility: "hidden", "z-index": "-10" });
}

// NAV BURGER
$(".nav-top-primary__button__burger").click(function () {
    let dataOpen = $(this).data("open");
    if (dataOpen == false || dataOpen == "false") {
        $(this).data("open", "true");
        $(this).css({ transform: "rotate(90deg)" });
        $(
            "#nav-top-primary-search, #nav-top-primary-image, #nav-top-primary-image-login"
        ).slideUp(150);
        $(
            ".nav-top-primary__button__search, .nav-top-primary__button__image"
        ).data("open", "false");
        $("#nav-top-primary-burger").slideDown(250);
        openShadow();
    } else {
        $(this).data("open", "false");
        $(this).css({ transform: "rotate(0deg)" });
        $("#nav-top-primary-burger").slideUp(250);
        closeShadow();
    }
});

// NAV SEARCH
$(".nav-top-primary__button__search").click(function () {
    let dataOpen = $(this).data("open");
    if (dataOpen == false || dataOpen == "false") {
        $(this).data("open", "true");
        $(
            "#nav-top-primary-burger, #nav-top-primary-image, #nav-top-primary-image-login"
        ).slideUp(150);
        $(
            ".nav-top-primary__button__burger, .nav-top-primary__button__image"
        ).data("open", "false");
        $(".nav-top-primary__button__burger").css({
            transform: "rotate(0deg)",
        });
        $("#nav-top-primary-search").slideDown(250);
        openShadow();
    } else {
        $(this).data("open", "false");
        $("#nav-top-primary-search").slideUp(250);
        closeShadow();
    }
});

// NAV IMAGE
$(".nav-top-primary__button__image").click(function () {
    let dataOpen = $(this).data("open");
    if (dataOpen == false || dataOpen == "false") {
        $(this).data("open", "true");
        $("#nav-top-primary-burger, #nav-top-primary-search").slideUp(150);
        $(
            ".nav-top-primary__button__burger, .nav-top-primary__button__search"
        ).data("open", "false");
        $(".nav-top-primary__button__burger").css({
            transform: "rotate(0deg)",
        });
        $("#nav-top-primary-image, #nav-top-primary-image-login").slideDown(
            300
        );
        openShadow();
    } else {
        $(this).data("open", "false");
        $("#nav-top-primary-image, #nav-top-primary-image-login").slideUp(300);
        closeShadow();
    }
});

// MENU SEDEKAH - WAKAF - ZAKAT
$(".home__button__sedekah, .home__button__wakaf, .home__button__zakat").click(
    function () {
        $(this).siblings().removeClass("home__button__3__active");
        $(this).addClass("home__button__3__active");
    }
);

// DONASI SELECT
$(".home__pilih__nominal").click(function () {
    $(this).siblings().removeClass("home__pilih__nominal__active");
    $(this).addClass("home__pilih__nominal__active");

    nominal = $(this).data("nominal");
    var input = $('.rupiah')[0];
    $("#nominal_value").val(nominal.toString().replace('Rp. ', '').replace(/\./g, ''));
    input.value = formatRupiah(nominal.toString(), 'Rp. ');
});

// INPUT DONASI ACTIVE
$(".home__input__nominal__donasi").on("keyup", function () {
    $(".home__pilih__nominal").removeClass("home__pilih__nominal__active");
});

// CLICK DONASI SEKARANG: OPEN & CLOSE
let isLogin = $("#home-data-diri").length;
$(".home__button__donasi__sekarang").click(function () {
    if (isLogin == 0) {
        $("#pilih-metode-pembayaran").css({ bottom: "0px" });
        openShadow();
    } else {
        let nama = $(".home-data-diri__nama").val();
        let handphone = $(".home-data-diri__handphone").val();
        let donasiInput = $("#donation_nominal").val();
        if (donasiInput == "" && nominal == 0) {
            alert("Pilih Nominal Atau Isi Nominal Donasi");
            return;
        } else if (parseInt(donasiInput) <= 0) {
            alert("Nominal Tidak Valid");
            return;
        }
        if (nama.length > 0 && handphone.length > 0) {
            $("#pilih-metode-pembayaran").css({ bottom: "0px" });
            openShadow();
        } else {
            alert("Lengkapi Data Diri!");
        }
    }
});
$(".pilih-metode-pembayaran-close").click(function () {
    $("#pilih-metode-pembayaran").css({ bottom: "-200%" });
    closeShadow();
});

// TRENDING - NEW CHANGE ACTIVE
$(".button__menu__2__news-trending").click(function () {
    $(this).siblings().removeClass("button__menu__2__news__active");
    $(this).addClass("button__menu__2__news__active");
    $("#kegiatan-row-new").hide(200);
    $("#kegiatan-row-trending").show(200);
});
$(".button__menu__2__news-new").click(function () {
    $(this).siblings().removeClass("button__menu__2__news__active");
    $(this).addClass("button__menu__2__news__active");
    $("#kegiatan-row-trending").hide(200);
    $("#kegiatan-row-new").show(200);
});

// KEGIATAN - BERITA CHANGE ACTIVE
$(".button__menu__2__news-kegiatan").click(function () {
    $(this).siblings().removeClass("button__menu__2__news__active");
    $(this).addClass("button__menu__2__news__active");
    $("#home-row-berita").hide(200);
    $("#home-row-kegiatan").show(200);
});
$(".button__menu__2__news-berita").click(function () {
    $(this).siblings().removeClass("button__menu__2__news__active");
    $(this).addClass("button__menu__2__news__active");
    $("#home-row-kegiatan").hide(200);
    $("#home-row-berita").show(200);
});

$(".home__button__3__active").click()

function setDonationType(type, nominal = "") {
    if(nominal == 0) {
        let n1 = $($(".home__pilih__nominal")[0])
        let n2 = $($(".home__pilih__nominal")[1])
        let n3 = $($(".home__pilih__nominal")[2])
        let n4 = $($(".home__pilih__nominal")[3])
        n1.attr("data-nominal", 100000);
        n2.attr("data-nominal", 200000);
        n3.attr("data-nominal", 300000);
        n4.attr("data-nominal", 400000);
        n1.html("Rp100,000");
        n2.html("Rp200,000");
        n3.html("Rp300,000");
        n4.html("Rp400,000");
    }else{
        let nml = JSON.parse(nominal)
        let n1 = $($(".home__pilih__nominal")[0])
        let n2 = $($(".home__pilih__nominal")[1])
        let n3 = $($(".home__pilih__nominal")[2])
        let n4 = $($(".home__pilih__nominal")[3])
        n1.attr("data-nominal", nml[0]);
        n2.attr("data-nominal", nml[1]);
        n3.attr("data-nominal", nml[2]);
        n4.attr("data-nominal", nml[3]);
        n1.html("Rp"+number_format(nml[0]));
        n2.html("Rp"+number_format(nml[1]));
        n3.html("Rp"+number_format(nml[2]));
        n4.html("Rp"+number_format(nml[3]));
    }
    donationType = type;
}

function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function processPayment(payment_method) {
    $("#loading").removeClass('d-none')
    var split = payment_method.split("-");
    var payment_type = split[0];
    var payment_code = split[1];
    var payment_name = split[2];
    var user_name = $("#fullname").val();
    var phone = $("#phone_number").val();
    var donation = $("#nominal_value").val();

    if (user_name == null || user_name == "") {
        alert("Nama Lengkap Harus Diisi");
        return;
    }
    if (phone == null || phone == "") {
        alert("Nomor Handphone Harus Diisi");
        return;
    }

    if (donation == null || donation == "") {
        donation = nominal;
    }

    if(donation < 10000) {
        alert("Minimal Rp. 10.000");
        return;
    }else if(donation > 10000000000){
        alert("Maksimal Rp. 10.000.000.000");
        return;
    }

    var params = {
        donation_type: donationType,
        payment_type: payment_type,
        payment_code: payment_code,
        payment_name: payment_name,
        donature_name: user_name,
        donature_phone: phone,
        nominal: donation,
        referral_code: getReferralCode(),
    };

    window.location.href = "/donate/" + btoa(JSON.stringify(params));
}
