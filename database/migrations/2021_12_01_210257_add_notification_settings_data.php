<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

class AddNotificationSettingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Setting::insert([
            [
                'key' => 'donation_reminder',
                'value' => "Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nTerima kasih telah berniat untuk investasi akhirat di <<app_name>>.\n\nKami hanya ingin mengingatkan niat baik Bapak/Ibu untuk berinvestasi akhirat di <<app_name>>\nPahala besar dan keberkahan sudah menunggu segera tunaikan niat baik Anda\n\nIni Nomor Transaksinya : <<invoice_number>>\nDonasi untuk program: <<campaign_name>>\nTinggal selangkah lagi pahala Anda langsung mengalir in syaa Allah.\n\nSilahkan transfer sejumlah <<donation_amount>>\n(Pastikan nominal transfernya sama persis, agar bisa kami konfirmasi dengan tepat)\n\nPembayaran dengan: <<payment_method>>\nLakukan sebelum <<time_limit>>\n\nSemoga niat baik kita semua, dimudahkan oleh Allah.\n\nSilahkan simpan kontak ini sebagai Admin Amal <<app_name>> untuk mendapatkan info terkait program lainnya.\n\nTerima kasih.",
            ],
            [
                'key' => 'donation_thanks',
                'value' => "Bismillah..\n\nAssalaamualaikum Bapak/Ibu...\nSahabat-Surga\n\nAlhamdulillah investasi akhirat Anda sebesar <<donation_amount>> telah kami terima\n\nKami berdoa semoga membalasnya dengan pahala yang besar dan tidak putus putus nya. Menambahkan keberkahan pada harta yang tersisa dan memberikan kebahagiaan bagi Anda dan keluarga. Serta Allah mudahkan semua urusan Anda.\nAmin Ya Robbal Alamin\n\nTerima kasih.",
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
