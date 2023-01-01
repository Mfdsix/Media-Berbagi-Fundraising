<?php
namespace App\Http\Traits;

// use model fundraiser
use App\Models\Fundraiser;
// use model fundraiser transaction
use App\Models\FundraiserTransaction;

trait FundraiserProcess
{
    // FundraiserProcess($funding)

    // add fundraiser transaction by funding parameter
    public function addFundraiserTransaction($funding)
    {
        if ($funding->referral_id) {
            $referral = Fundraiser::where('user_id', $funding->referral_id)
                ->first();
            if ($referral) {

                if($funding->project != null){
                    $fee_reward = $funding->project->fundraiser_reward != null ? ($funding->project->fundraiser_reward / 100) : 0.01;
                }else{
                    $fee_reward = 0.01;
                    if($funding->project_id == 0){
                        $fee_reward = 0.01;
                        $instant = InstantProgram::where('program', $funding->fund_type)->first();
                        $fee_reward = $instant->commision / 100;
                    }
                }

                $commission = ($funding->nominal * $fee_reward);

                // check if reference id is not exist
                if (!FundraiserTransaction::where('reference_id', $funding->id)->first()) {
                    // add commission
                    FundraiserTransaction::create([
                        'type' => 'commission',
                        'amount' => $commission,
                        'status' => 'success',
                        'fundraiser_id' => $referral->id,
                        'reference_id' => $funding->id,
                        'user_id' => $referral->user_id,
                    ]);

                     $referral->update([
                        'commissions' => $referral->commissions + $commission,
                        'collected' => $referral->collected + ($funding->nominal),
                        'success_transaction' => $referral->success_transaction + 1,
                    ]);
                }
            }
        }
    }
}