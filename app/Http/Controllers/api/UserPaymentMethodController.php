<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\UserPaymentMethod;
use App\Http\Controllers\Controller;

class UserPaymentMethodController extends Controller
{
    public function addUpi(Request $request)
    {
        $request->validate([
            'holder_name' => 'required|string',
            'upi_id' => 'required|string'
        ]);

        // dd($request->all());

        $userId = $request->user()->uuid;

        // Already added?
        $exists = UserPaymentMethod::where('user_id', $userId)
            ->where('type', 'upi')
            ->first();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'UPI already added. Please wait for verification.'
            ], 422);
        }

        UserPaymentMethod::create([
            'user_id' => $userId,
            'type' => 'upi',
            'holder_name' => $request->holder_name,
            'upi_id' => $request->upi_id,
            'verification_status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'UPI added successfully. Awaiting admin verification.'
        ]);
    }

    public function addBank(Request $request)
    {
        $request->validate([
            'holder_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'ifsc_code' => 'required|string',
            'branch' => 'nullable|string'
        ]);

        $userId = $request->user()->uuid;

        $exists = UserPaymentMethod::where('user_id', $userId)
            ->where('type', 'bank')
            ->first();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Bank account already added. Please wait for verification.'
            ], 422);
        }

        UserPaymentMethod::create([
            'user_id' => $userId,
            'type' => 'bank',
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch' => $request->branch,
            'verification_status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bank details added successfully. Awaiting admin verification.'
        ]);
    }

    public function list(Request $request)
    {
        $methods = UserPaymentMethod::where('user_id', $request->user()->uuid)
            ->orderBy('id', 'DESC')
            ->get()
            ->map(function ($m) {
                return [
                    'id' => $m->id,
                    'type' => $m->type,
                    'holder_name' => $m->holder_name,
                    'upi_id' => $m->upi_id,
                    'bank_name' => $m->bank_name,
                    'account_number' => $m->account_number
                        ? 'XXXX' . substr($m->account_number, -4)
                        : null,
                    'ifsc_code' => $m->ifsc_code,
                    'branch' => $m->branch,
                    'verification_status' => $m->verification_status,
                    'rejection_reason' => $m->rejection_reason,
                    'is_default' => $m->is_default,
                    'verified_at' => $m->verified_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $methods
        ]);
    }


    public function updateUpi(Request $request)
    {
        $request->validate([
            'holder_name' => 'required|string',
            'upi_id' => 'required|string'
        ]);

        $method = UserPaymentMethod::where('user_id', $request->user()->uuid)
            ->where('type', 'upi')
            ->firstOrFail();

        if ($method->verification_status !== 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'UPI can only be updated if rejected.'
            ], 403);
        }

        $method->update([
            'holder_name' => $request->holder_name,
            'upi_id' => $request->upi_id,
            'verification_status' => 'pending',
            'rejection_reason' => null,
            'verified_at' => null,
            'verified_by' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'UPI updated successfully. Awaiting verification.'
        ]);
    }

    public function updateBank(Request $request)
    {
        $request->validate([
            'holder_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'ifsc_code' => 'required|string',
            'branch' => 'nullable|string'
        ]);

        $method = UserPaymentMethod::where('user_id', $request->user()->uuid)
            ->where('type', 'bank')
            ->firstOrFail();

        if ($method->verification_status !== 'rejected') {
            return response()->json([
                'success' => false,
                'message' => 'Bank details can only be updated if rejected.'
            ], 403);
        }

        $method->update([
            'holder_name' => $request->holder_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'ifsc_code' => $request->ifsc_code,
            'branch' => $request->branch,
            'verification_status' => 'pending',
            'rejection_reason' => null,
            'verified_at' => null,
            'verified_by' => null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bank details updated successfully. Awaiting verification.'
        ]);
    }





}
