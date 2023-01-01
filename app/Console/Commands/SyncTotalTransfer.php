<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Funding;

class SyncTotalTransfer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi jumlah donasi dan kode unik';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Sinkronisasi jumlah donasi + kode unik ...");

        $count = Funding::count();

        $progressBar = $this->output->createProgressBar($count);
        $progressBar->start();

        $pages = round($count/1000)+1;
        for($i = 0; $i<=$pages;$i++){
            $datas = Funding::offset($i*1000)
            ->limit(1000)
            ->orderBy('id')
            ->get();

            foreach ($datas as $key => $value) {
                $donasi = $value->nominal;
                $kode = $value->unique_code;
                $total = $donasi + $kode;

                $value->total = $total;
                $value->save();

                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->info("\n..............................");
        $this->info("$count Data Berhasil Sinkronisasi :)");
    }
}