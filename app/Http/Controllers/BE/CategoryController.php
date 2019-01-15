<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends UserController
{
    var $list;

    public function __construct()
    {

        parent::__construct();

        $this->list[0] = 'Select Category';
        $categories = Category::where('parent_id', 0)->where('id', '<>', 0)->orderBy('name', 'asc')->get();
        $this->getList($categories, 0);
        view()->share([
            'type' => 'category',
            'categories' => $this->list
        ]);
    }

    private function getList($list, $id, $str = '')
    {
        foreach ($list as $key => $val) {
            if ($val->id != $id) {
                $val->name = $str . $val->name;
                $this->list[$val->id] = $val->name;
                $this->getList($val->categories, $id, $str . '|--');
            }
        }
    }

    public function index()
    {
        $title = __('category.title');

        return view('BE.category.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Category::with('parent')->orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.category.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('category.new');
        return view('BE.category.create', compact('title'));
    }

    public function store(CategoryRequest $request)
    {
        $image = '';
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'product_category');
        }
        $request->merge(['image' => $image]);
        Category::create($request->except('image_file'));

        flash(__('flash.create_success'))->success();
        return redirect()->route('admin.category.index');
    }

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        $title = __('category.edit') . ' (' . $category->id . ')';
        return view('BE.category.create', compact('title', 'category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {

        $image = $request->image ?: $category->image;
        if ($request->hasFile('image_file')) {
            $image = $this->uploadFile($request->image_file, 'product_category');
        }
        $request->merge(['image' => $image]);

        $category->update($request->except('category_id', 'image_file'));
        flash(__('flash.update_success'))->success();

        return back();
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

