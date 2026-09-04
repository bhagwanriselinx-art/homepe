<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    // INDEX
    public function index()
    {
        $videos = Video::latest()->get();
        return view('admin.videos.index', compact('videos'));
    }

    // CREATE
    public function create()
    {
        return view('admin.videos.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'required|mimes:mp4,mov,avi|max:20480',
        ]);

        $videoPath = null;

        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/videos'), $name);
            $videoPath = 'uploads/videos/' . $name;
        }

        Video::create([
            'title' => $request->title,
            'video_file' => $videoPath,
        ]);

        return redirect()->route('admin.videos.index')->with('success', 'Video uploaded successfully');
    }

    // EDIT
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|mimes:mp4,mov,avi|max:20480',
        ]);

        // Upload new video
        if ($request->hasFile('video_file')) {

            if ($video->video_file && file_exists(public_path($video->video_file))) {
                unlink(public_path($video->video_file));
            }

            $file = $request->file('video_file');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/videos'), $name);

            $video->video_file = 'uploads/videos/' . $name;
        }

        // Update ONLY required fields
        $video->title = $request->title;
        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully');
    }

    // DELETE
    public function destroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->video_file && file_exists(public_path($video->video_file))) {
            unlink(public_path($video->video_file));
        }

        $video->delete();

        return back()->with('success', 'Video deleted successfully');
    }
}