<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\UserEarning;
use App\Models\ProductClick;
use Illuminate\Http\Request;
use App\Models\AffiliateCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserLeadController extends Controller
{
    // public function index(Request $request)
    // {
    //     $userId = $request->user()->uuid;

    //     $query = ProductClick::with(['product.category'])
    //         ->where('user_id', $userId);

    //     /* SEARCH */
    //     if ($request->filled('search')) {
    //         $search = $request->search;
    //         $query->where(function ($q) use ($search) {
    //             $q->where('lead_id', 'like', "%$search%")
    //                 ->orWhereHas('product', function ($p) use ($search) {
    //                     $p->where('title', 'like', "%$search%");
    //                 });
    //         });
    //     }

    //     /*  STATUS FILTER */
    //     if ($request->filled('status')) {
    //         switch ($request->status) {
    //             case 'pending':
    //                 $query->where('status', 0);
    //                 break;

    //             case 'inprogress':
    //                 $query->where('status', 1);
    //                 break;

    //             case 'completed':
    //                 $query->where('status', 3);
    //                 break;

    //             case 'expired':
    //                 $query->where('status', '!=', 3);
    //                 break;
    //         }
    //     }

    //     /*  DATE RANGE */
    //     if ($request->filled('from_date') && $request->filled('to_date')) {
    //         $query->whereBetween('clicked_at', [
    //             $request->from_date,
    //             $request->to_date
    //         ]);
    //     }

    //     /*  CATEGORY FILTER */
    //     if ($request->filled('category_id')) {
    //         $query->whereHas('product', function ($q) use ($request) {
    //             $q->where('category_id', $request->category_id);
    //         });
    //     }

    //     $leads = $query->orderBy('id', 'DESC')->paginate(10);

    //     return response()->json([
    //         'success' => true,
    //         'data' => $leads->through(function ($lead) {
    //             return [
    //                 'lead_id' => $lead->lead_id,
    //                 'product' => $lead->product->title ?? '',
    //                 'category' => $lead->product->category->name ?? '',
    //                 'status' => $this->leadStatus($lead),
    //                 'expiry_at' => optional($lead->expiryDate())->format('Y-m-d H:i:s'),
    //                 'clicked_at' => $lead->clicked_at,
    //             ];
    //         })
    //     ]);
    // }

    // private function leadStatus($lead)
    // {
    //     if ($lead->isExpired())
    //         return 'expired';

    //     return match ($lead->status) {
    //         0 => 'pending',
    //         1 => 'inprogress',
    //         3 => 'completed',
    //         default => 'pending',
    //     };
    // }

    // public function categories(Request $request)
    // {
    //     $userId = $request->user()->uuid;

    //     $categories = AffiliateCategory::withCount([
    //         'products as leads_count' => function ($q) use ($userId) {
    //             $q->whereHas('clicks', function ($c) use ($userId) {
    //                 $c->where('user_id', $userId);
    //             });
    //         }
    //     ])->get();

    //     return response()->json([
    //         'success' => true,
    //         'data' => $categories->map(function ($cat) {
    //             return [
    //                 'category_id' => $cat->id,
    //                 'category_name' => $cat->name,
    //                 'leads_count' => $cat->leads_count,
    //             ];
    //         })
    //     ]);
    // }



    /**
     * 1 LEADS SUMMARY
     */
    public function summary(Request $request)
    {
        $userId = $request->user()->uuid;

        $totalLeads = ProductClick::where('user_id', $userId)->count();

        $earned = UserEarning::where('user_id', $userId)
            ->where('status', 'approved')
            ->sum('amount');

        // Potential = total earning levels - approved earnings
        $potential = DB::table('products_earning_levels')
            ->join('product_clicks', 'product_clicks.affiliate_product_id', '=', 'products_earning_levels.affiliate_product_id')
            ->where('product_clicks.user_id', $userId)
            ->sum('products_earning_levels.amount') - $earned;

        return response()->json([
            'success' => true,
            'data' => [
                'total_leads' => $totalLeads,
                'earned' => (float) $earned,
                'potential' => max(0, $potential)
            ]
        ]);
    }

    /**
     * 2️⃣ CATEGORY TABS
     */
    public function categories(Request $request)
    {
        $userId = $request->user()->uuid;

        $categories = DB::table('product_clicks')
            ->join('affiliate_products', 'affiliate_products.id', '=', 'product_clicks.affiliate_product_id')
            ->join('affiliate_categories', 'affiliate_categories.id', '=', 'affiliate_products.category_id')
            ->where('product_clicks.user_id', $userId)
            ->select(
                'affiliate_categories.id',
                'affiliate_categories.name',
                DB::raw('COUNT(product_clicks.id) as leads')
            )
            ->groupBy('affiliate_categories.id', 'affiliate_categories.name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    /**
     * 3️⃣ STATUS COUNTS
     */
    public function statusCount(Request $request)
    {
        $userId = $request->user()->uuid;

        $clicks = ProductClick::where('user_id', $userId)->get();

        $now = now();

        $data = [
            'pending' => 0,
            'in_progress' => 0,
            'completed' => 0,
            'expired' => 0,
        ];

        foreach ($clicks as $click) {
            $expiry = Carbon::parse($click->clicked_at)->addDays(
                $click->product->expiry_days ?? 30
            );

            if ($expiry->isPast()) {
                $data['expired']++;
            } elseif ($click->status == 0) {
                $data['pending']++;
            } elseif ($click->status == 1) {
                $data['in_progress']++;
            } elseif ($click->status == 3) {
                $data['completed']++;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * 4️⃣ LEADS LIST
     */
    public function index(Request $request)
    {
        $userId = $request->user()->uuid;

        $query = ProductClick::with(['product.category'])
            ->where('user_id', $userId);

        /*
        |--------------------------------------------------------------------------
        | CATEGORY FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category_id')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH FILTER (lead_id, mobile, product)
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('lead_id', 'like', "%$search%")
                    ->orWhere('click_id', 'like', "%$search%")
                    ->orWhereHas('product', function ($p) use ($search) {
                        $p->where('title', 'like', "%$search%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | DATE RANGE FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('clicked_at', [
                $request->from_date . ' 00:00:00',
                $request->to_date . ' 23:59:59'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {

            if ($request->status === 'expired') {
                $query->whereHas('product', function ($q) {
                    $q->whereRaw('DATE_ADD(product_clicks.clicked_at, INTERVAL affiliate_products.expiry_days DAY) < NOW()');
                });

            } elseif ($request->status === 'pending') {
                $query->where('status', 0);

            } elseif ($request->status === 'in_progress') {
                $query->where('status', 1);

            } elseif ($request->status === 'completed') {
                $query->where('status', 3);
            }
        }

        $leads = $query->orderByDesc('id')->paginate(10);

        $data = $leads->map(function ($click) {

            $expiryDate = Carbon::parse($click->clicked_at)
                ->addDays($click->product->expiry_days ?? 30);

            $earned = UserEarning::where('click_id', $click->id)
                ->where('status', 'approved')
                ->sum('amount');

            return [
                'lead_id' => $click->lead_id,
                'product_name' => $click->product->title,
                'category' => $click->product->category->name ?? '',
                'status' => $this->statusText($click, $expiryDate),
                'earned' => (float) $earned,
                'potential' => (float) $click->product->earnings,
                'expiry_at' => $expiryDate->format('Y-m-d'),
                'clicked_at' => $click->clicked_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
            'meta' => [
                'current_page' => $leads->currentPage(),
                'total' => $leads->total()
            ]
        ]);
    }


    /**
     * 5️⃣ SINGLE LEAD DETAIL
     */
    public function show(Request $request, $leadId)
    {
        $userId = $request->user()->uuid;

        $click = ProductClick::with([
            'product.category',
            'product.earningLevels'
        ])
            ->where('lead_id', $leadId)
            ->where('user_id', $userId)
            ->firstOrFail();

        $levels = $click->product->earningLevels->map(function ($level) use ($click) {
            $completed = UserEarning::where('click_id', $click->id)
                ->where('earning_level_id', $level->id)
                ->where('status', 'approved')
                ->exists();

            return [
                'level_order' => $level->level_order,
                'level_name' => $level->level_name,
                'amount' => $level->amount,
                'completed' => $completed
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'lead_id' => $click->lead_id,
                'product' => $click->product->title,
                'category' => $click->product->category->name ?? '',
                'status' => $click->status,
                'expiry_at' => Carbon::parse($click->clicked_at)
                    ->addDays($click->product->expiry_days ?? 30),
                'clicked_at' => $click->clicked_at,  
                'levels' => $levels
            ]
        ]);
    }

    /**
     * Status Message Helper
     */
    private function statusMessage($click)
    {
        return match ($click->status) {
            0 => 'Complete the first goal to start earning',
            1 => 'Goal in progress',
            3 => 'Reward credited',
            default => 'Pending'
        };
    }

    private function statusText($click, $expiryDate)
    {
        if ($expiryDate->isPast()) {
            return 'expired';
        }

        return match ($click->status) {
            0 => 'pending',
            1 => 'in_progress',
            3 => 'completed',
            default => 'pending'
        };
    }

}


