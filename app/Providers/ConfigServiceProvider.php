<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (\Schema::hasTable('configs')) {
            $config = DB::table('configs')->first();
            if ($config) //checking if table is not empty
            {
                $configs = array(
                    'driver'     => $config->MAIL_MAILER ?? 'mail',
                    'host'       => $config->MAIL_HOST,
                    'port'       => $config->MAIL_PORT,
                    'from'       => array('address' => $config->MAIL_FROM_ADDRESS, 'name' => $config->MAIL_FROM_NAME),
                    'encryption' => $config->MAIL_ENCRYPTION,
                    'username'   => $config->MAIL_USERNAME,
                    'password'   => $config->MAIL_PASSWORD,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $configs);
                Config::set("app.name", $config->APP_NAME);
            }
        }
    }
}