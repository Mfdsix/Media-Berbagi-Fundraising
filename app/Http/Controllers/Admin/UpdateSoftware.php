<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class UpdateSoftware extends Controller
{
    public function index(Request $request)
    {
        $current = new Process('git ls-remote --tags --heads --sort="v:refname" https://yudono:githubdono25@gitlab.com/mediaberbagi/mediaberbagi-si | tail -n1 | sed \'s/.*\///; s/\^{}//\'');
        $current->run();
        if (!$current->isSuccessful()) {
            // throw new ProcessFailedException($current);
        }
        if ($request->update == 'true') {
            // $process = new Process('cd .. && git config --global user.email "youdhono@gmail.com" && git config --global user.name "yudono" && git pull https://yudono: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@github.com/mediaberbagi/mediaberbagi-si.git development --no-ff');
            if(env("APP_ENV") == "local") {
                $process = new Process('cd .. && bash update_dev.sh');
            }else{
                $process = new Process('cd .. && bash update.sh');
            }
            // $process = new Process('git pull https://yudono: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@github.com/mediaberbagi/mediaberbagi-si.git');
            $process->start();
            $process->wait(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    echo '<script>console.log(`error : ' . $buffer . '`)</script>';
                } else {
                    echo '<script>console.log(`out : ' . $buffer . '`)</script>';
                }
            });
            if ($process->isSuccessful()) {
                //REDIRECT HERE
            }
        }

        $process = new Process('git log --oneline');
        $process->run();
        $perline = explode('
', $process->getOutput());
        $html = '<ul class="timeline">';
        foreach ($perline as $line) {
            $x = strpos($line, ' ');
            $html .= '<li>
					<a href="#">' . substr($line, 0, $x) . '</a>
					<p>' . substr($line, $x) . '</p>
				</li>';
        }
        $version = new Process('git tag');

        $html .= '</ul>';
        return view('admin.update-software.index', [
            'changelog' => $html,
            'current' => $current->getOutput(),
        ]);
    }
}