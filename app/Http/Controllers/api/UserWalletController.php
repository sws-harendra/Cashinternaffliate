<?php

namespace App\Http\Controllers\api;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use App\Models\UserPaymentMethod;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserWalletController extends Controller
{
    public function wallet(Request $request)
    {
        // dd($request->user()->uuid);
        $wallet = Wallet::where('uuid', $request->user()->uuid)->firstOrFail();
        // Wallet Transactions (list)
        $walletTransactions = WalletTransaction::where('user_id', $request->user()->uuid)
            ->orderBy('id', 'DESC')
            ->paginate(5);

        // Withdraw Requests (list)
        $withdrawRequests = WithdrawRequest::where('user_id', $request->user()->uuid)
            ->orderBy('id', 'DESC')
            ->paginate(5);

        return response()->json([
            'success' => true,
            'data' => [
                'wallet' => $wallet,
                'transactions' => $walletTransactions,
                'withdraw_requests' => $withdrawRequests
            ]
        ]);
    }

    public function transactions(Request $request)
    {
        $wallet = Wallet::where('uuid', $request->user()->uuid)->firstOrFail();

        $transactions = $wallet->transactions()
            ->latest()
            ->paginate(20);

        return response()->json($transactions);
    }

   

}
