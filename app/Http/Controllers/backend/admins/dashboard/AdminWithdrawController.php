<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminWithdrawController extends Controller
{
     // List all withdraw requests
    public function index()
    {
        $withdraws = WithdrawRequest::with(['user', 'paymentMethod'])
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view(
            'backend.admins.pages.withdraw.index',
            compact('withdraws')
        );
    }

    // Approve withdraw
    public function approve($id)
    {
        $withdraw = WithdrawRequest::where('status', 'pending')->findOrFail($id);
        $wallet = Wallet::findOrFail($withdraw->wallet_id);

        DB::transaction(function () use ($withdraw, $wallet) {

            $withdraw->update([
                'status' => 'approved',
                'processed_at' => now(),
                'processed_by' => auth()->user()->id,
            ]);

            $wallet->total_withdraw += $withdraw->amount;
            $wallet->save();

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $withdraw->user_id,
                'type' => 'withdraw',
                'amount' => $withdraw->amount,
                'reference_id' => $withdraw->id,
                'description' => 'Withdraw approved by admin',
            ]);
        });

        return back()->with('success', 'Withdraw approved successfully');
    }

    // Reject withdraw
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string'
        ]);

        $withdraw = WithdrawRequest::where('status', 'pending')->findOrFail($id);
        $wallet = Wallet::findOrFail($withdraw->wallet_id);

        DB::transaction(callback: function () use ($withdraw, $wallet, $request) {

            // refund balance
            $wallet->balance += $withdraw->amount;
            $wallet->save();

            $withdraw->update([
                'status' => 'rejected',
                'rejection_reason' => $request->reason,
                'processed_at' => now(),
                'processed_by' => auth()->user()->id,
            ]);

            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $withdraw->user_id,
                'type' => 'refund',
                'amount' => $withdraw->amount,
                'reference_id' => $withdraw->id,
                'description' => 'Withdraw rejected & refunded',
            ]);
        });

        return back()->with('success', 'Withdraw rejected & refunded');
    }
}
