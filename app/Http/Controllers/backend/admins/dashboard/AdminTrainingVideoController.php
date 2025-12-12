<?php

namespace App\Http\Controllers\backend\admins\dashboard;

use Illuminate\Http\Request;
use App\Models\TrainingVideo;
use App\Models\TrainingSubCategory;
use App\Http\Controllers\Controller;

class AdminTrainingVideoController extends Controller
{
    public function index()
    {
        $videos = TrainingVideo::with('subcategory')->paginate(20);
        return view('backend.admins.pages.training_videos.index', compact('videos'));
    }

    public function create()
    {
        $subcategories = TrainingSubCategory::where('status', 1)->get();
        return view('backend.admins.pages.training_videos.create', compact('subcategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_category_id' => 'required',
            'title' => 'required',
            'video_url' => 'required|url',
            'duration' => 'nullable|numeric'
        ]);

        TrainingVideo::create($request->all());

        return back()->with('success', 'Training Video Added Successfully!');
    }

    public function edit($id)
    {
        $video = TrainingVideo::findOrFail($id);
        $subcategories = TrainingSubCategory::all();

        return view('backend.admins.pages.training_videos.edit', compact('video', 'subcategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_category_id' => 'required',
            'title' => 'required',
            'video_url' => 'required|url',
            'duration' => 'nullable|numeric'
        ]);

        $video = TrainingVideo::findOrFail($id);
        $video->update($request->all());

        return redirect()->route('admins.training-videos.index')
            ->with('success', 'Training Video Updated Successfully!');
    }

    public function delete($id)
    {
        TrainingVideo::findOrFail($id)->delete();
        return back()->with('success', 'Training Video Deleted!');
    }
}
