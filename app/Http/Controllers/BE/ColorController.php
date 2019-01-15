<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends UserController
{
    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'color',
        ]);
    }

    public function index()
    {
        $title = __('color.title');
        return view('BE.color.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Color::orderBy('id');

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.color.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('color.new');
        return view('BE.color.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = [
            'color' => 'required|min:2|max:20|alpha|unique:colors',
            'value' => 'required|min:2|max:10|unique:colors',
        ];
        $request->validate($validate);

        Color::create($request->all());
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.color.index');
    }

    public function edit(Color $color)
    {
        $doc = $color;
        $title = __('color.edit');
        return view('BE.color.create', compact('title', 'doc'));
    }

    public function update(Request $request, Color $color)
    {
        $validate = [
            'color' => 'required|min:2|max:20|alpha',
            'value' => 'required|min:2|max:10|unique:colors',
        ];
        $request->validate($validate);
        $color->update($request->all());
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.color.index');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return 1;
    }


}
