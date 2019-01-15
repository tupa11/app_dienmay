<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\CodeVoucher;
use App\Models\Manufacturer;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CodeVoucherController extends UserController
{
    public function __construct()
    {

        $manufacturers_pluck = Manufacturer::pluck('name', 'id');
        $manufacturers_pluck = $manufacturers_pluck->prepend(__('code_voucher.manufacturer'), '');
        $vouchers_pluck = Voucher::pluck('name', 'id');

        parent::__construct();

        view()->share([
            'type' => 'code_voucher',
            'manufacturers_pluck' => $manufacturers_pluck,
            'vouchers_pluck' => $vouchers_pluck,
        ]);
    }

    public function index()
    {
        $title = __('code_voucher.title');
        return view('BE.code_voucher.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = CodeVoucher::orderBy('created_at');

        if (1) {
            if ($request->voucher_id) {
                $docs = $docs->whereHas('voucher', function ($q) use ($request) {
                    $q->where('id', $request->voucher_id);
                });
            }
            if ($request->manufacturer_id) {
                $docs = $docs->whereHas('manufacturer', function ($q) use ($request) {
                    $q->where('id', $request->manufacturer_id);
                });
            }
            if ($request->status) {
                $docs = $docs->whereNull('member_id');
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.code_voucher.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('code_voucher.new');
        return view('BE.code_voucher.create', compact('title'));
    }

    public function store(Request $request)
    {
        $voucher = Voucher::find($request->voucher_id);
        if (!empty($voucher)) {
            factory(CodeVoucher::class, (int)$request->number_code)->create([
                'voucher_id' => (int)$request->voucher_id,
                'manufacturer_id' => $request->number_code,
            ]);
            flash()->success(__('flash.create_success'));
        }

        return redirect()->route('admin.code_voucher.index');
    }

    public function destroy($id)
    {
        $code_voucher = CodeVoucher::where('code', $id);
        $code_voucher->delete();
        return 1;
    }


}
