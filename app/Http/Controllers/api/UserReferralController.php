<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserReferralController extends Controller
{
     public function index(Request $request)
    {
        $user = $request->user();

        // User wallet
        $wallet = Wallet::where('uuid', $user->uuid)->first();

        // My referrals
        $referrals = User::where('referred_by', $user->referral_code)
            ->select('id', 'uuid', 'name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'referral_code'   => $user->referral_code,
                'total_referrals' => $referrals->count(),
                'referral_income' => (float) ($wallet->refer_balance ?? 0),

                'referrals' => $referrals->map(function ($ref) {
                    return [
                        'name'       => $ref->name,
                        'joined_at'  => $ref->created_at->format('d M Y'),
                        'status'     => 'active', // future: block / inactive
                    ];
                }),
            ]
        ]);
    }
}
