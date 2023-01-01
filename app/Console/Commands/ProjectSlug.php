<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class ProjectSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Auto Project Slug';

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
        $projects = Project::where('slug', null)
        ->get();

        echo "Generating ".(count($projects))." Slugs\n";

        foreach ($projects as $k => $v) {
            $slug_url = $v->id.'-'.preg_replace('/[^a-zA-Z0-9_.-]/', '', str_replace(' ', '-', $v->title));

            echo "> ".$slug_url."\n";

            $v->update([
                'slug' => $slug_url
            ]);
        }

        echo "done :)\n";
    }
}
