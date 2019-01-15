<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductDeleteController extends UserController
{
    public function __construct()
    {

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


    public function index()
    {
        $title = __('product.title');
        return view('BE.productdelete.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Product::onlyTrashed()->with('category')->orderBy('id');
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

        return view('BE.productdelete.grid', compact('docs', 'total'));
    }

    public function destroy($id)
    {
        Product::withTrashed()->find($id)->restore();
        return 1;
    }

}
