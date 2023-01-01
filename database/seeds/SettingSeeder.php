<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Setting::set([
    		'gold_price' => 830000,
    		'silver_price' => 12000,
    	]);
    }
}
