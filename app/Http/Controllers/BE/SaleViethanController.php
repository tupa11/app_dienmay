<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\SaleViethan;
use App\Models\Voucher;
use DB;
use Illuminate\Http\Request;

class SaleViethanController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        view()->share([
            'type' => 'sale_viethan',
        ]);
    }

    public function index()
    {
        $title = __('sale_viethan.title');
        return view('BE.sale_viethan.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = SaleViethan::orderBy('id');

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.sale_viethan.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('sale_viethan.new');
        return view('BE.sale_viethan.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'title' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'time_start' => 'required',
            'time_end' => 'required',
            'img_file' => 'required',
            'detail' => 'required'
        ]);

        if ($request->hasFile('img_file')) {
            $img = $this->uploadFile($request->img_file, 'sale_viethan');
            $request->merge(['img' => $img]);
        }

        SaleViethan::create($request->except('img_file'));

        flash()->success(__('flash.create_success'));

        return redirect()->route('admin.sale_viethan.index');
    }

    public function edit(SaleViethan $sale_viethan)
    {
        $doc = $sale_viethan;
        $title = __('sale_viethan.edit');
        return view('BE.sale_viethan.create', compact('title', 'doc'));
    }

    public function update(Request $request, SaleViethan $sale_viethan)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'title' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'time_start' => 'required',
            'time_end' => 'required',
            'detail' => 'required'
        ]);

        if ($request->hasFile('img_file')) {
            unlinkUpload('sale_viethan', $sale_viethan->img);
            $img = $this->uploadFile($request->img_file, 'sale_viethan');
            $request->merge(['img' => $img]);
        }

        $sale_viethan->update($request->except('img_file'));
        flash()->success(__('flash.update_success'));

        return redirect()->route('admin.sale_viethan.index');
    }

    public function destroy(Voucher $voucher)
    {
        $count = $voucher->codevochers->count();
        if (!$count) {
            unlinkUpload('sale_viethan', $voucher->img);
            $voucher->delete();
            return 1;
        }
    }


}
