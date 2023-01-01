<?php

namespace App\Console\Commands;

use App\Models\Funding;
use App\Models\Fundraiser;
use App\Models\Project;
use App\Models\Withdrawal;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Console\Command;

class GatewayPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gateway:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Post data to mediaberbagi gateway';

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
        if (!envdb('MB_ACCESS_KEY') || !envdb('MB_HOST')) {
            return;
        }

        $projects = Project::withTrashed()
            ->get();

        $returned = [];
        $totalDonation = 0;
        $totalFee = 0;

        $instants = ['sedekah', 'zakat', 'wakaf'];
        foreach ($instants as $instant) {
            $online_donation = Funding::where('project_id', 0)
                ->where('fund_type', $instant)
                ->where('status', 'paid')
                ->where('is_admin', 0)
                ->sum('nominal');
            $offline_donation = Funding::where('project_id', 0)
                ->where('fund_type', $instant)
                ->where('status', 'paid')
                ->where('is_admin', 1)
                ->sum('nominal');
            $total = $online_donation + $offline_donation;
            $withdrawed_mediaberbagi = Withdrawal::where('project_id', 0)
                ->where('project_type', $instant)
                ->where('withdrawal_type', 'mediaberbagi_right')
                ->sum('nominal');
            $can_be_withdrawed = (1 / 100) * $total - $withdrawed_mediaberbagi;
            $titles = [
                'sedekah' => 'Sedekah',
                'wakaf' => 'Wakaf',
                'zakat' => 'Zakat',
            ];

            array_push($returned, [
                'id' => 0,
                'title' => 'Donasi Instan - ' . $titles[$instant],
                'online_donation' => $online_donation,
                'offline_donation' => $offline_donation,
                'donation' => $total,
                'fee' => floor($can_be_withdrawed),
                'project_type' => $instant,
            ]);
            $totalDonation += $total;
            $totalFee += $can_be_withdrawed;
        }

        foreach ($projects as $k => $v) {
            $donation = $v->countDonation();
            $mediaberbagi_withdrawed = $v->withdrawal('mediaberbagi_right');
            $online_donation = Funding::where('is_admin', '!=', 1)
                ->where('project_id', $v->id)
                ->where('status', 'paid')
                ->sum('nominal');
            $offline_donation = Funding::where('is_admin', 1)
                ->where('project_id', $v->id)
                ->where('status', 'paid')
                ->sum('nominal');
            $total = $online_donation + $offline_donation;

            $can_be_withdrawed = ((1 / 100) * $donation) - $mediaberbagi_withdrawed;

            if ($can_be_withdrawed > 0) {
                // example
                // {
                //     "id": 1,
                //     "title": "Projek Penggalangan Dana",
                //     "online_donation": 80000,
                //     "offline_donation": 20000,
                //     "donation": 100000,
                //     "fee": 100
                // },

                array_push($returned, [
                    'id' => $v->id,
                    'title' => $v->title,
                    'online_donation' => $online_donation,
                    'offline_donation' => $offline_donation,
                    'donation' => $total,
                    'fee' => floor($can_be_withdrawed),
                ]);
                $totalDonation += $total;
                $totalFee += $can_be_withdrawed;
            }
        }

        // example
        //     "project" : 2,
        // "fundraiser": 10,
        // "donature": 15,
        // "transaction": {
        //     "total": 100,
        //     "success": 50
        // },

        $users = User::where('level', 'user')
            ->count();
        $fundraiser = Fundraiser::count();
        $totalTransaction = Funding::count();
        $successTransaction = Funding::where('status', 'paid')
            ->count();

        $data = [
            'project' => count($projects),
            'fundraiser' => $fundraiser,
            'users' => $users,
            'donature' => $totalTransaction,
            'transaction' => [
                'total' => $totalTransaction,
                'success' => $successTransaction,
            ],
            'donation' => [
                'total' => $totalDonation,
                'fee' => floor($totalFee),
                'items' => $returned,
            ],
        ];

        // echo "posting data\n";
        // echo json_encode($data);
        // echo "\n";

        try {

            $client = new Client();
            $response = $client->post(envdb('MB_HOST') . '/gateway/callback', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'X-MediaBerbagi-Identifier' => envdb('MB_ACCESS_KEY'),
                    'X-MediaBerbagi-Mode' => 'production',
                ],
                RequestOptions::JSON => $data,
                'http_errors' => false,
            ]);

            $status = $response->getStatusCode();
            if ($status == 200) {
                echo "success\n";
            } else {
                echo "failed - " . $status . "\n";
            }
        } catch (Exception $e) {
            echo "failed - pre-execution\n";
        }
    }
}
