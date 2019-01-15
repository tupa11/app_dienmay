<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends UserController
{
    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'size',
        ]);
    }

    public function index()
    {
        $title = __('size.title');
        return view('BE.size.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Size::orderBy('id');

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.size.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('size.new');
        return view('BE.size.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = [
            'code' => 'required|min:1|max:20|alpha|unique:sizes',
            'value' => 'required|min:1|max:10|unique:sizes',
        ];
        $request->validate($validate);

        Size::create($request->all());
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.size.index');
    }

    public function edit(Size $size)
    {
        $doc = $size;
        $title = __('size.edit');
        return view('BE.size.create', compact('title', 'doc'));
    }

    public function update(Request $request, Size $size)
    {
        $validate = [
            'code' => 'required|min:1|max:20|alpha',
            'value' => 'required|min:1|max:10|unique:sizes',
        ];
        $request->validate($validate);
        $size->update($request->all());
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.size.index');
    }

    public function destroy(Size $size)
    {
        $size->delete();
        return 1;
    }


}
