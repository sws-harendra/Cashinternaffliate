<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\TrainingVideo;
use App\Models\TrainingCategory;
use App\Http\Controllers\Controller;

class TutorialController extends Controller
{
    public function index()
    {
        $categories = TrainingCategory::with([
            'subcategories.videos'
        ])->get();

        return response()->json([
            'success' => true,
            'data' => $categories->map(function ($cat) {
                return [
                    'category_id' => $cat->id,
                    'category_name' => $cat->name,

                    'videos' => $cat->subcategories
                        ->flatMap->videos
                        ->map(function ($video) {
                            return [
                                'id' => $video->id,
                                'title' => $video->title,
                                'video_url' => $video->video_url,
                                'duration' => $video->duration,
                            ];
                        })->values()
                ];
            })
        ]);
    }


    public function category($id)
    {
        $category = TrainingCategory::with('subcategories', 'subcategories.videos')
            ->find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'category_id' => $category->id,
                'category_name' => $category->name,
                'subcategories' => $category->subcategories->map(function ($sub) {
                    return [
                        'id' => $sub->id,
                        'name' => $sub->name,
                        'slug' => $sub->slug,
                    ];
                }),
                'videos' => $category->subcategories
                    ->flatMap->videos
                    ->map(function ($video) {
                        return [
                            'id' => $video->id,
                            'title' => $video->title,
                            'video_url' => $video->video_url,
                            'duration' => $video->duration,
                        ];
                    })->values()
            ]
        ]);
    }


    public function videosByCategory($categoryId)
    {
        $videos = TrainingVideo::whereHas('subcategory', function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        })
            ->where('status', 1)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }

    public function videosBySubCategory($subCategoryId)
    {
        $videos = TrainingVideo::where('sub_category_id', $subCategoryId)
            ->where('status', 1)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $videos
        ]);
    }
}
