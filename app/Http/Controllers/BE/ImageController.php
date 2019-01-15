<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends UserController
{
    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'image',
        ]);
    }

    public function index()
    {
        $title = __('image.title');
        return view('BE.image.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Image::orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }
        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.image.grid', compact('docs', 'total'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->img_path = 'products';
        $image = Image::create([
            'name' => $this->uploadFile($request->file('gallery'), $request->img_path),
            'alt' => $request->img_alt,
            'title' => $request->img_title,
            'path' => $request->img_path,
        ]);
        return $image;
    }

    public function show(Image $image)
    {

    }

    public function edit(Image $image)
    {
        $info = pathinfo($image->name);
        $image->file_name = $info['filename'];

        return $image;
    }

    public function update(Request $request, Image $image)
    {
        $info = pathinfo($image->name);
        $name = $request->name;
        $file = $request->name . '.' . $info['extension'];
        if ($info['filename'] != $name) {
            $count = 0;
            while (file_exists(public_path('uploads/' . $image->path . '/' . $file))) {
                $count++;
                $name = $request->name . '-' . $count;
                $file = $name . '.' . $info['extension'];
            }
            if (file_exists(public_path('uploads/' . $image->path . '/' . $image->name))) {
                rename(public_path('uploads/' . $image->path . '/' . $image->name),
                    public_path('uploads/' . $image->path . '/' . $file));
            }
            if (file_exists(public_path('uploads/' . $image->path . '/thumb_' . $image->name))) {
                rename(public_path('uploads/' . $image->path . '/thumb_' . $image->name),
                    public_path('uploads/' . $image->path . '/thumb_' . $file));
            }
        }

        $request->merge(['name' => $file]);
        $image->update($request->except('image_id'));
        return redirect()->route('admin.image.index');
    }

    public function destroy(Image $image)
    {
        $count = $image->product->count() + $image->products->count();
        if (!$count) {
            unlinkUpload($image->path, $image->name);
            $image->delete();
            return 1;
        }
    }


}
