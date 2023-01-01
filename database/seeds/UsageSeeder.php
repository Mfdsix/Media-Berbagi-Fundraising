<?php

use App\Models\StorageUsage;
use Illuminate\Database\Seeder;

class UsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $disk_usage = 200000000 + (rand(1, 10) * rand(1500000, 12500000));
            $database_usage = 5000000 + (rand(1, 10) * rand(500000, 10000000));

            StorageUsage::create([
                'disk_usage' => $disk_usage,
                'database_usage' => $database_usage,
                'created_at' => date('Y-m-d H:i:s', strtotime('-' . $i . ' days')),
            ]);
        }
    }
}
