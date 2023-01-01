<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\Funding;

class ProjectExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close expired project';

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
        $projects = Project::where('date_target', '<', Date('Y-m-d'))
        ->update([
            'status' => 2
        ]);
        $funding = Funding::where('status', 'pending')
        ->where('time_limit', '<', Date('Y-m-d'))
        ->update([
            'status' => 'canceled'
        ]);
    }
}
