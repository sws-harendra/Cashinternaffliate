<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\User;
use App\Models\Wallet;
use App\Models\UserEarning;
use App\Models\ProductClick;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProductEarningLevel;
use App\Http\Controllers\Controller;

class AdminClickController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST CLICKS
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $clicks = ProductClick::with(['product', 'user'])
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view('backend.admins.pages.clicks.index', compact('clicks'));
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW LEVEL COMPLETION PAGE
    |--------------------------------------------------------------------------
    */
    public function convertPage($id)
    {
        $click = ProductClick::with('product')->findOrFail($id);

        $levels = ProductEarningLevel::where('affiliate_product_id', $click->affiliate_product_id)
            ->orderBy('level_order')
            ->get();

        // Completed Levels
        $completed = UserEarning::where('click_id', $click->id)
            ->pluck('earning_level_id')
            ->toArray();

        // Expiry Check
        $isExpired = $click->isExpired();

        return view('backend.admins.pages.clicks.convert', compact('click', 'levels', 'completed', 'isExpired'));
    }

    /*
    |--------------------------------------------------------------------------
    | MARK ONE LEVEL COMPLETED (HOLD BALANCE)
    |--------------------------------------------------------------------------
    */
    public function completeLevel(Request $request, $id)
    {
        $request->validate([
            'level_id' => 'required|exists:products_earning_levels,id'
        ]);

        $click = ProductClick::findOrFail($id);
        $level = ProductEarningLevel::findOrFail($request->level_id);

        if ($click->isExpired()) {
            return back()->with('error', 'This lead has expired. No further actions allowed.');
        }
        $wallet = Wallet::where('uuid', $click->user_id)->first();
        if (!$wallet) {
            return back()->with('error', 'Wallet not found for this user.');
        }

        // Check if already completed
        $exists = UserEarning::where('click_id', $click->id)
            ->where('earning_level_id', $level->id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'This level is already completed.');
        }

        DB::transaction(function () use ($click, $level, $wallet) {

            // 1. Create holding earning
            $earning = UserEarning::create([
                'user_id' => $click->user_id,
                'affiliate_product_id' => $click->affiliate_product_id,
                'click_id' => $click->id,
                'earning_level_id' => $level->id,
                'amount' => $level->amount,
                'status' => 'holding',
            ]);

            // 2. Add to hold balance
            $wallet->hold_balance += $level->amount;
            $wallet->save();

            // dd($wallet);
            // 3. Create transaction entry
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $wallet->uuid,
                'type' => 'hold',
                'amount' => $level->amount,
                'reference_id' => $earning->id,
                'description' => "{$level->level_name} Completed - Amount on Hold"
            ]);

            // Update click status
            $click->status = 1; // In progress
            $click->save();
        });

        return back()->with('success', 'Level marked completed. Amount added to Hold Balance.');
    }

    /*
    |--------------------------------------------------------------------------
    | FINAL APPROVAL: RELEASE HOLD → BALANCE
    |--------------------------------------------------------------------------
    */
    public function finalApprove($id)
    {
        $click = ProductClick::findOrFail($id);

        if ($click->is_converted) {
            return back()->with('error', 'Already fully converted.');
        }

        if ($click->isExpired()) {
            return back()->with('error', 'Cannot approve! This lead has expired.');
        }

        $wallet = Wallet::where('uuid', $click->user_id)->first();
        if (!$wallet) {
            return back()->with('error', 'User wallet not found.');
        }

        // All holding earnings
        $earnings = UserEarning::where('click_id', $click->id)
            ->where('status', 'holding')
            ->get();

        if ($earnings->count() == 0) {
            return back()->with('error', 'No pending levels to approve.');
        }

        DB::transaction(function () use ($earnings, $wallet, $click) {

            $total = $earnings->sum('amount');

            // 1. Approve all holding earnings
            foreach ($earnings as $e) {
                $e->update(['status' => 'approved']);
            }

            // 2. Move money hold → balance
            $wallet->hold_balance -= $total;
            $wallet->balance += $total;
            $wallet->collection += $total;
            $wallet->save();

            // 3. Add Transaction Log
            WalletTransaction::create([
                'wallet_id' => $wallet->id,
                'user_id' => $wallet->uuid,
                'type' => 'release',
                'amount' => $total,
                'reference_id' => $click->id,
                'description' => "Final Conversion - Amount Released"
            ]);

            // 4. Mark Click Converted
            $click->update([
                'is_converted' => true,
                'status' => 3,
                'converted_at' => now()
            ]);
        });

        return redirect()->route('admins.affiliate.clicks')
            ->with('success', 'Final Conversion Completed. Amount Released to Wallet.');
    }
}

