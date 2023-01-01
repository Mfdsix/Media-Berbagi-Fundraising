<?php

use Illuminate\Database\Seeder;
use App\Config;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Config::count() <= 0) {
            Config::create([
                "APP_NAME" => "MediaBerbagi",
                "MAIL_MAILER" => null,
                "MAIL_HOST" => null,
                "MAIL_PORT" => null,
                "MAIL_USERNAME" => null,
                "MAIL_PASSWORD" => null,
                "MAIL_ENCRYPTION" => null,
                "MAIL_FROM_ADDRESS" => null,
                "MAIL_FROM_NAME" => "MediaBerbagi",
                "MB_HOST" => null,
                "MB_ACCESS_KEY" => null,
                "RUANGWA_TOKEN" => null,
            ]);
        }
    }
}
