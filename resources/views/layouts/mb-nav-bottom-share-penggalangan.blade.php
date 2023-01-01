<!-- NAV: Bantu share penggalangan dana ini -->
<nav id="nav-bantu-share">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="nav-bantu-share__title">Bantu share penggalangan dana ini</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-between mb-3">
                <a href="https://web.whatsapp.com/send?text={{ Request::url() }}" rel="noopener noreferrer" target="_blank" class="nav-bantu-share__hijau nav-bantu-share__hijau__desktop">Whatsapp</a>
                <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}&t=" rel="noopener noreferrer" target="_blank" class="nav-bantu-share__biru">Facebook</a>
            </div>
            <div class="col-12 mb-2">
                <a href="https://api.whatsapp.com/send/?phone={{$phone}}&text=Halo+saya+ada+kendala" class="nav-bantu-share__whatsapp">Hubungi kami via WhatsApp</a>
            </div>
            <div class="col-12">
                <a href="{{ url('donation/'.'INV-' . $transaction->created_at->format('ymd').sprintf('%05d', $transaction->id)) }}" class="nav-bantu-share__transaksi">Lihat Transaksi</a>
            </div>
        </div>
    </div>
</nav>
