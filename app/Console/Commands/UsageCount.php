<?php

namespace App\Console\Commands;

use App\Models\StorageUsage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UsageCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'usage:count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count system usage';

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
        $date = date('Y-m-d');
        $diskUsage = $this->countDiskUsage();
        $databaseUsage = $this->countDatabaseUsage();
        echo "disk usage: " . $diskUsage . ". database usage: " . $databaseUsage;

        $check = StorageUsage::where('created_at', "LIKE", $date . "%")
            ->first();
        if ($check) {
            $check->update([
                'disk_usage' => $diskUsage,
                'database_usage' => $databaseUsage,
            ]);
        } else {
            StorageUsage::create([
                'disk_usage' => $diskUsage,
                'database_usage' => $databaseUsage,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return 1;
    }

    private function countDiskUsage($directory = null)
    {
        $directory = $directory ?? base_path();
        $totalSize = 0;
        $directoryArray = scandir($directory);

        foreach ($directoryArray as $key => $fileName) {
            if ($fileName != ".." && $fileName != ".") {
                if (is_dir($directory . "/" . $fileName)) {
                    $totalSize = $totalSize + ($this->countDiskUsage($directory . "/" . $fileName));
                } else if (is_file($directory . "/" . $fileName)) {
                    $totalSize = $totalSize + filesize($directory . "/" . $fileName);
                }
            }
        }
        return $totalSize;
    }

    private function countDatabaseUsage()
    {
        $database = ENV('DB_DATABASE');
        print($database);
        $query = DB::select("select table_schema, sum((data_length+index_length)) AS size from information_schema.tables where TABLE_SCHEMA = '$database' group by 1");
        if (count($query) > 0) {
            return $query[0]->size;
        }
        return 0;
    }

    public function getFormattedSize($sizeInBytes)
    {
        if ($sizeInBytes < 1024) {
            return $sizeInBytes . " bytes";
        } else if ($sizeInBytes < 1024 * 1024) {
            return $sizeInBytes / 1024 . " KB";
        } else if ($sizeInBytes < 1024 * 1024 * 1024) {
            return $sizeInBytes / (1024 * 1024) . " MB";
        } else if ($sizeInBytes < 1024 * 1024 * 1024 * 1024) {
            return $sizeInBytes / (1024 * 1024 * 1024) . " GB";
        } else {
            return $sizeInBytes / (1024 * 1024 * 1024 * 1024) . " TB";
        }
    }
}
