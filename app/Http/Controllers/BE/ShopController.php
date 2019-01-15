<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\SalonRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Salon;
use Illuminate\Http\Request;

class ShopController extends UserController
{
    public function __construct()
    {

        parent::__construct();
        $title = __('shop.title');

        $categories = Category::where('parent_id', 0)->where('id', '<>', 0)->orderBy('id')->pluck('name', 'id');
        $admins = Admin::getOnlyAdmins();
        view()->share([
            'type' => 'shop',
            'title' => $title,
            'categories' => $categories,
            'admins' => $admins,
        ]);
    }

    public function index()
    {
        return view('BE.shop.index');
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Salon::with('admin', 'category')->orderBy('id');

        if (1) {
            if ($request->name) {
                $docs = $docs->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->admin_id) {
                $docs = $docs->whereHas('admin', function ($q) use ($request) {
                    $q->where('id', $request->admin_id);
                });
            }
            if ($request->category_id) {
                $docs = $docs->whereHas('category', function ($q) use ($request) {
                    $q->where('id', $request->category_id);
                });
            }
            if ($request->exprie_time) {
                $docs = $docs->where('exprie_time', $request->exprie_time);
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.shop.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('shop.new');
        return view('BE.shop.create', compact('title'));
    }

    public function store(SalonRequest $request)
    {
        Salon::create($request->all());

        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.shop.index');
    }

    public function show(Salon $shop)
    {

    }

    public function edit(Salon $shop)
    {
        $title = __('shop.edit') . ' (' . $shop->id . ')';
        return view('BE.shop.create', compact('title', 'shop'));
    }

    public function update(SalonRequest $request, Salon $shop)
    {
        $shop->update($request->except('shop_id'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.shop.index');
    }

    public function destroy(Category $category)
    {
        $count = 0;
        if (!$count) {
            $category->delete();
            return 1;
        }
    }
}

