<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use App\Models\Faq;
use App\Models\Benefit;
use App\Models\HowItWorks;
use App\Models\WhomToSell;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TermsCondition;
use App\Models\AffiliateProduct;
use App\Models\AffiliateCategory;
use App\Http\Controllers\Controller;
use App\Models\AffiliateSubCategory;
use App\Models\ProductTrainingVideo;

class AdminAffiliateProductController extends Controller
{
    public function index()
    {
        $products = AffiliateProduct::with('category', 'subcategory')->latest()->paginate(20);
        return view('backend.admins.pages.affiliate_products.index', compact('products'));
    }

    public function create()
    {
        $categories = AffiliateCategory::where('status', 'active')->get();
        return view('backend.admins.pages.affiliate_products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:affiliate_products',
            'affiliate_link' => 'required',
            'category_id' => 'required|exists:affiliate_categories,id',
            'product_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'expiry_days' => 'required|integer|min:1',
        ]);

        // Upload product image
        $productImage = null;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $productImage = time() . '_prod_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-products'), $productImage);
        }

        // Upload banner
        $bannerImage = null;
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerImage = time() . '_banner_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-products'), $bannerImage);
        }

        AffiliateProduct::create([
            'product_image' => $productImage,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => Str::slug($request->slug),
            'affiliate_link' => $request->affiliate_link,
            'description' => $request->description,
            'banner' => $bannerImage,
            'earnings' => $request->earnings ?? 0,
            'is_top_product' => $request->is_top_product ? 1 : 0,
            'top_product_title' => $request->top_product_title,
            'is_recommended' => $request->is_recommended ? 1 : 0,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'expiry_days' => $request->expiry_days,
        ]);

        return redirect()->route('admins.affiliate-products.index')
            ->with('success', 'Product Created Successfully!');
    }

    public function edit($id)
    {
        $product = AffiliateProduct::findOrFail($id);
        $categories = AffiliateCategory::where('status', 'active')->get();
        $subcategories = AffiliateSubCategory::where('category_id', $product->category_id)->get();

        return view('backend.admins.pages.affiliate_products.edit', compact('product', 'categories', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $product = AffiliateProduct::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:affiliate_products,slug,' . $id,
            'affiliate_link' => 'required',
            'category_id' => 'required|exists:affiliate_categories,id',
            'product_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'banner' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'expiry_days' => 'required|integer|min:1',
        ]);
        // dd($request->all());

        $productImage = $product->product_image;
        if ($request->hasFile('product_image')) {
            if ($productImage && file_exists(public_path('uploads/affiliate-products/' . $productImage))) {
                unlink(public_path('uploads/affiliate-products/' . $productImage));
            }
            $file = $request->file('product_image');
            $productImage = time() . '_prod_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-products'), $productImage);
        }

        $bannerImage = $product->banner;
        if ($request->hasFile('banner')) {
            if ($bannerImage && file_exists(public_path('uploads/affiliate-products/' . $bannerImage))) {
                unlink(public_path('uploads/affiliate-products/' . $bannerImage));
            }
            $file = $request->file('banner');
            $bannerImage = time() . '_banner_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/affiliate-products'), $bannerImage);
        }

        $product->update([
            'product_image' => $productImage,
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'slug' => $request->slug,
            'affiliate_link' => $request->affiliate_link,
            'description' => $request->description,
            'banner' => $bannerImage,
            'earnings' => $request->earnings ?? 0,
            'is_top_product' => $request->is_top_product ? 1 : 0,
            'top_product_title' => $request->top_product_title,
            'is_recommended' => $request->is_recommended ? 1 : 0,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'expiry_days' => $request->expiry_days,
        ]);

        return redirect()->route('admins.affiliate-products.index')
            ->with('success', 'Product Updated Successfully!');
    }

    public function delete($id)
    {
        $product = AffiliateProduct::findOrFail($id);

        if ($product->product_image && file_exists(public_path('uploads/affiliate-products/' . $product->product_image))) {
            unlink(public_path('uploads/affiliate-products/' . $product->product_image));
        }

        if ($product->banner && file_exists(public_path('uploads/affiliate-products/' . $product->banner))) {
            unlink(public_path('uploads/affiliate-products/' . $product->banner));
        }

        $product->delete();

        return redirect()->route('admins.affiliate-products.index')
            ->with('success', 'Product Deleted Successfully!');
    }

    public function details($id)
    {
        $product = AffiliateProduct::with([
            'benefits',
            'howItWorks',
            'whomToSell',
            'terms',
            'faqs',
            'trainingVideos',
        ])->findOrFail($id);

        return view('backend.admins.pages.affiliate_products.details', compact('product'));
    }

    public function detailsUpdate(Request $request, $id)
    {
        $product = AffiliateProduct::findOrFail($id);

        // BENEFITS
        Benefit::where('affiliate_product_id', $id)->delete();
        if ($request->benefits) {
            foreach ($request->benefits as $b) {
                if (!empty($b)) {
                    Benefit::create([
                        'affiliate_product_id' => $id,
                        'benefit_title' => $b
                    ]);
                }
            }
        }

        // HOW IT WORKS
        HowItWorks::where('affiliate_product_id', $id)->delete();
        if ($request->steps) {
            foreach ($request->steps as $s) {
                if (!empty($s)) {
                    HowItWorks::create([
                        'affiliate_product_id' => $id,
                        'step_title' => $s
                    ]);
                }
            }
        }

        // WHOM TO SELL
        WhomToSell::where('affiliate_product_id', $id)->delete();
        if ($request->audience) {
            foreach ($request->audience as $a) {
                if (!empty($a)) {
                    WhomToSell::create([
                        'affiliate_product_id' => $id,
                        'target_audience' => $a
                    ]);
                }
            }
        }

        // TERMS
        // DELETE ALL OLD TERMS
        TermsCondition::where('affiliate_product_id', $id)->delete();

        // INSERT NEW TERMS
        if ($request->terms_points) {
            foreach ($request->terms_points as $t) {
                if (!empty($t)) {
                    TermsCondition::create([
                        'affiliate_product_id' => $id,
                        'terms' => $t
                    ]);
                }
            }
        }


        // FAQ
        Faq::where('affiliate_product_id', $id)->delete();
        if ($request->faq_question) {
            foreach ($request->faq_question as $key => $q) {
                if (!empty($q)) {
                    Faq::create([
                        'affiliate_product_id' => $id,
                        'question' => $q,
                        'answer' => $request->faq_answer[$key] ?? ''
                    ]);
                }
            }
        }


        // TRAINING VIDEOS
        ProductTrainingVideo::where('affiliate_product_id', $id)->delete();

        if ($request->video_title) {
            foreach ($request->video_title as $key => $title) {
                $url = $request->video_url[$key];

                if (!empty($title) && !empty($url)) {
                    ProductTrainingVideo::create([
                        'affiliate_product_id' => $id,
                        'video_title' => $title,
                        'video_url' => $url,
                    ]);
                }
            }
        }


        return back()->with('success', 'Product Details Updated Successfully!');
    }


}
