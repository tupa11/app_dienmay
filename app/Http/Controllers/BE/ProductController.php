<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends UserController
{
    public function __construct()
    {
//        $this->middleware('authorized:admin.list', ['only' => ['index']]);
//        $this->middleware('authorized:admin.add', ['only' => ['create']]);
//        $this->middleware('authorized:admin.list', ['only' => ['catalog']]);

        $categorys_pluck = Category::get()->pluck('name', 'id');
        $categorys_pluck = $categorys_pluck->prepend(__('category.name'), '');

        $colors_pluck = Color::get()->pluck('color', 'id');
        $colors_pluck = $colors_pluck->prepend(__('color.color'), '');

        $sizes_pluck = Size::get()->pluck('code', 'id');
        $sizes_pluck = $sizes_pluck->prepend(__('size.code'), '');

        parent::__construct();

        view()->share([
            'type' => 'product',
            'categorys_pluck' => $categorys_pluck,
            'colors_pluck' => $colors_pluck,
            'sizes_pluck' => $sizes_pluck,
        ]);
    }

    public function upload(Request $request)
    {
        @$image = Image::create([
            'name' => $this->uploadFile($request->file('gallery'), 'products'),
            'alt' => $request->img_alt,
            'title' => $request->img_title,
            'path' => 'products',
        ]);
        return $image;
    }

    public function uploadFromUrl(Request $request)
    {
        $pathInfo = pathinfo($request->url);
        $name = $pathInfo['basename'];
        $ext = $pathInfo['extension'];
        if ($name && $ext && in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])) {
            $name = str_replace('.' . $ext, '', $name);
            $name = str_slug($name) . '.' . $ext;
            $to = $_SERVER['DOCUMENT_ROOT'] . '/uploads/products/' . $name;
            if ($this->saveImage($request->url, $to)) {
                $image = Image::create([
                    'name' => $name,
                    'title' => $request->title,
                    'alt' => $request->alt,
                    'path' => 'products'
                ]);
                if (Thumbnail::generate_image_thumbnail($to,
                    $_SERVER['DOCUMENT_ROOT'] . '/uploads/products/thumb_' . $name)) {
                    return $image;
                }
            }
        }
        return null;
    }

    public function index()
    {
        $title = __('product.title');
        return view('BE.product.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Product::with('category')->orderBy('id');
        if (1) {
            if ($request->name) {
                $docs = $docs->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->category_id) {
                $docs = $docs->whereHas('category', function ($q) use ($request) {
                    $q->where('id', $request->category_id);
                });
            }
            if ($request->active) {
                $docs = $docs->where('active', (bool)$request->active);
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.product.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('product.new');
        return view('BE.product.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'category_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'price' => 'required|regex:/^[0-9]+$/',
            'details' => 'required',
            'image_gallery' => 'required',
        ]);

        $i = 0;
        $slug = $request->slug ?: str_slug($request->name);
        $newSlug = $slug;
        while (Product::where('slug', $newSlug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        if (!$request->product_image && $request->image_gallery) {
            $request->merge(['product_image' => $request->image_gallery[0]]);
        }

        $request->name = mb_strtoupper($request->name);
        $request->merge(['name' => $request->name]);


        $product = Product::create($request->except('file_3d_file', 'tag', 'categories', 'image_gallery', 'property',
            'color', 'parent_gallery'));
        $product->save();
        $product->images()->sync($request->image_gallery);

        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.product.index');
    }

    public function edit(Product $product)
    {
        $doc = $product;
        $this->generateParams($product->id);
        $title = __('product.edit');
        return view('BE.product.create', compact('title', 'doc'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'category_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
            'price' => 'required|regex:/^[0-9]+$/',
            'details' => 'required',
        ]);

        $request['active'] = (bool)$request['active'];
        $i = 0;
        $slug = $request->slug ?: str_slug($request->name);
        $newSlug = $slug;
        while (Product::where('slug', $newSlug)->first()) {
            $i++;
            $newSlug = $slug . '-' . $i;
        }
        $request->merge(['slug' => $newSlug]);

        if (!$request->product_image && $request->image_gallery) {
            $request->merge(['product_image' => $request->image_gallery[0]]);
        }

        $request->name = mb_strtoupper($request->name);
        $request->merge(['name' => $request->name]);

        $product->images()->sync($request->image_gallery);

        $product->update($request->except('file_3d_file', 'tag', 'categories', 'image_gallery', 'property',
            'color', 'parent_gallery'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.product.index');
    }

    public function destroy(Product $product)
    {
        $count = 0;
        if (!$count) {
            $product->delete();
            return 1;
        }
    }

    private function generateParams($id = 0)
    {
        if ($id) {
            $productGallery = Product::find($id)->images()->get();

            view()->share([
                'productGallery' => $productGallery,
            ]);
        }
    }
}
