<?php

namespace App\Http\Controllers\api;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use App\Models\UserPaymentMethod;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserWithdrawController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|exists:user_payment_methods,id',
        ]);

        $user = $request->user();
        $wallet = Wallet::where('uuid', $user->uuid)->firstOrFail();

        $minWithdraw = (float) config_value('min_withdraw', 10);

        if ($request->amount < $minWithdraw) {
            return response()->json([
                'message' => "Minimum withdraw is ₹{$minWithdraw}"
            ], 422);
        }

        if ($wallet->balance < $request->amount) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }

        $method = UserPaymentMethod::where('id', $request->payment_method_id)
            ->where('user_id', $user->uuid)
            ->where('verification_status', 'approved')
            ->first();

        if (!$method) {
            return response()->json([
                'message' => 'Payment method not approved'
            ], 422);
        }

        DB::transaction(function () use ($wallet, $request, $user) {

            // CUT balance immediately
            $wallet->balance -= $request->amount;
            $wallet->save();

            // Withdraw request
            $withdraw = WithdrawRequest::create([
                'user_id' => $user->uuid,
                'wallet_id' => $wallet->id,
                'payment_method_id' => $request->payment_method_id,
                'amount' => $request->amount,
                'status' => 'pending',
            ]);

            // Wallet transaction
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $user->uuid,
                'type' => 'debit',
                'amount' => $request->amount,
                'reference_id' => $withdraw->id,
                'description' => 'Withdraw request placed',
            ]);
        });

        return response()->json([
            'message' => 'Withdraw request submitted successfully'
        ]);
    }


    public function history(Request $request)
    {
        $user = $request->user();

        $withdraws = WithdrawRequest::with('paymentMethod')
            ->where('user_id', $user->uuid)
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => [
                'withdraws' => $withdraws
            ]
        ]);
    }

}
