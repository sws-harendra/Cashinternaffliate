<?php
namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\ReferralEarning;

class ReferralService
{
    public static function credit(User $earningUser, float $earningAmount)
    {
        if (!$earningUser->referred_by) return;

        $referrer = User::where('referral_code', $earningUser->referred_by)->first();
        if (!$referrer) return;

        $CAP = 1000;
        $RATE = 0.05;

        $referral = ReferralEarning::firstOrCreate(
            ['referrer_user_id' => $referrer->uuid],
            ['total_earned' => 0]
        );

        $remaining = $CAP - $referral->total_earned;
        if ($remaining <= 0) return;

        $commission = $earningAmount * $RATE;
        $finalCommission = min($commission, $remaining);

        $wallet = Wallet::where('uuid', $referrer->uuid)->first();
        if (!$wallet) return;

        $wallet->refer_balance += $finalCommission;
        $wallet->save();

        $referral->increment('total_earned', $finalCommission);
    }
}
