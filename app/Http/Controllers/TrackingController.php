<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\ProductClick;
use Illuminate\Http\Request;
use App\Models\AffiliateProduct;

class TrackingController extends Controller
{
    // URL structure: https://yourdomain.com/c/{product_id}/{user_id}
    public function redirect($productId, $userId, Request $req)
    {
        $product = AffiliateProduct::findOrFail($productId);

        $user = User::find($userId);
        if (!$user) {
            $userId = null; // or handle as guest
        }

        // internal click id (unguessable) that we'll store and pass to Offer18
        $clickId = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(4))), 0, 8);
        while (ProductClick::where('click_id', $clickId)->exists()) {
            $clickId = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(4))), 0, 8);
        }

        // Save click immediately
        $click = ProductClick::create([
            'lead_id' => substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(4))), 0, 5),
            'affiliate_product_id' => $product->id,
            'user_id' => $userId ?: null,
            'click_id' => $clickId,
            'sub_aff_id' => $userId ? (string) $userId : null, // you may prefer 'USER_'.$userId
            'ip' => $req->ip(),
            'user_agent' => $req->header('User-Agent'),
            'referrer' => $req->header('referer'),
            'clicked_at' => now(),
        ]);

        // Build final Offer18 URL by replacing placeholders.
        // Support common placeholder names – make sure to urlencode inserted values.
        $finalUrl = $product->affiliate_link;

        // Replace aff_click_id placeholder(s)
        $finalUrl = str_replace(
            ['{CLICK_ID}', '{click_id}', '{aff_click_id}', '{replace_it}'],
            urlencode($click->click_id),
            $finalUrl
        );

        // Replace sub_aff_id / user placeholder(s)
        $subAff = $click->sub_aff_id ?? ($click->user_id ? (string) $click->user_id : '');
        $finalUrl = str_replace(
            ['{USER_ID}', '{sub_aff_id}', '{SUB_AFF_ID}', '{user_id}'],
            urlencode($subAff),
            $finalUrl
        );

        // If any other tokens (utm, etc.) are needed, replace here.

        // Redirect to the affiliate network
        return redirect()->away($finalUrl);
    }
}
