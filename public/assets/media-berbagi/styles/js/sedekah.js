// OPEN & CLOSE SHADOW MODAL
function openShadow() {
    $('#shadow-modal').css({ 'visibility': 'visible', 'z-index': '90' });
}
function closeShadow() {
    $('#shadow-modal').css({ 'visibility': 'hidden', 'z-index': '-10' });
}

// DESKRIPSI
$('.sedekah-section-baca-selengkapnya__deskripsi').click(function() {
    $('#modal-sedekah-deskripsi').css({ 'bottom': '0px' });
    openShadow()
});
$('#modal-sedekah-deskripsi .modal-lihat-semua-close-button').click(function() {
    $('#modal-sedekah-deskripsi').css({ 'bottom': '-200%' });
    closeShadow()
});

// KABAR TERBARU
$('.sedekah-section-baca-selengkapnya__kb').click(function() {
    $('#modal-sedekah-kabar-berita').css({ 'bottom': '0px' });
    openShadow()
});
$('#modal-sedekah-kabar-berita .modal-lihat-semua-close-button').click(function() {
    $('#modal-sedekah-kabar-berita').css({ 'bottom': '-200%' });
    closeShadow()
});

// DONATUR
$('.sedekah-section-lihat-semua__donatur').click(function() {
    $('#modal-sedekah-donatur').css({ 'bottom': '0px' });
    openShadow()
});
$('#modal-sedekah-donatur .modal-lihat-semua-close-button').click(function() {
    $('#modal-sedekah-donatur').css({ 'bottom': '-200%' });
    closeShadow()
});

// FUNDRAISER
$('.sedekah-section-lihat-semua__fundraiser').click(function() {
    $('#modal-sedekah-fundraiser').css({ 'bottom': '0px' });
    openShadow()
});
$('#modal-sedekah-fundraiser .modal-lihat-semua-close-button').click(function() {
    $('#modal-sedekah-fundraiser').css({ 'bottom': '-200%' });
    closeShadow()
});

// SHARE
$('.page-nav-sedekah__share').click(function() {
    $('#nav-share-section').css({ 'bottom': '0px' });
    openShadow()
});
$('.nav-share-section__close').click(function() {
    $('#nav-share-section').css({ 'bottom': '-200%' });
    closeShadow()
});