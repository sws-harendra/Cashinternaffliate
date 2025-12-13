<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\UserPaymentMethod;
use App\Http\Controllers\Controller;

class AdminPaymentMethodController extends Controller
{
    public function index()
    {
        $methods = UserPaymentMethod::with('user')
            ->orderBy('id', 'DESC')
            ->paginate(20);

        return view(
            'backend.admins.pages.payment_methods.index',
            compact('methods')
        );
    }

    public function approve($id)
    {
        $method = UserPaymentMethod::findOrFail($id);

        $method->update([
            'verification_status' => 'approved',
            'rejection_reason' => null,
            'verified_at' => now(),
            'verified_by' => auth('admin')->user()->id
        ]);

        return back()->with('success', 'Payment method approved');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $method = UserPaymentMethod::findOrFail($id);

        $method->update([
            'verification_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'verified_at' => now(),
            'verified_by' => auth('admin')->user()->id
        ]);

        return back()->with('success', 'Payment method rejected');
    }

}
