<?php

namespace App\Http\Controllers\Admin;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\MediaItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        $items = MediaItem::with('media')->latest()->get();

        return view('admin.media.index', compact('items'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|max:26214455',
            'collection' => 'required',
        ]);

        $item = MediaItem::create([
            'title' => $request->title,
        ]);

        $item
            ->addMedia($request->file('file'))
            ->usingFileName(time() . '_' . $request->file('file')->getClientOriginalName())
            ->toMediaCollection($request->collection);

        return back()->with('success', 'آپلود شد');
    }


    public function destroy($id)
    {
        Media::findOrFail($id)->delete();
        return back();
    }
}
