<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\VoucherRequest;
use App\Models\CodeVoucher;
use App\Models\Manufacturer;
use App\Models\Voucher;
use DB;
use Illuminate\Http\Request;

class VoucherController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        $manufacturers_pluck = Manufacturer::pluck('name', 'id');
        view()->share([
            'type' => 'voucher',
            'manufacturers_pluck' => $manufacturers_pluck,
        ]);
    }

    public function index()
    {
        $title = __('voucher.title');
        return view('BE.voucher.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Voucher::with('manufacturer', 'codevochers')->orderBy('id');

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.voucher.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('voucher.new');
        return view('BE.voucher.create', compact('title'));
    }

    public function store(VoucherRequest $request)
    {
        DB::transaction(function () use ($request) {
            $rq = $request->all();
            if ($request->hasFile('img')) {
                $img = $this->uploadFile($rq['img'], 'voucher');
                $rq['img'] = $img;
            }
            $time1 = null;
            $time2 = null;

            if (!empty($rq['timerange'])) {
                $rq['timerange'] = str_replace("/", "-", $rq['timerange']);
                $time = explode(" - ", $rq['timerange']);
                $time1 = $time[0];
                $time2 = $time[1];

                $time1 = strtotime($time1);
                $time2 = strtotime($time2);

                unset($rq['timerange']);
            }
            $rq['time_start'] = $time1;
            $rq['time_end'] = $time2;

            $voucher = Voucher::create($rq);

//        auto genarete code voucher
            factory(CodeVoucher::class, (int)$request->number_code)->create([
                'voucher_id' => $voucher->id,
                'manufacturer_id' => $rq['manufacturer_id'],
            ]);

            flash()->success(__('flash.create_success'));
        });

        return redirect()->route('admin.voucher.index');
    }

    public function edit(Voucher $voucher)
    {
        $voucher->timerange = date(settings('date_format'),
                $voucher->time_start) . " - " . date(settings('date_format'), $voucher->time_end);
        $doc = $voucher;
        $title = __('voucher.edit');
        return view('BE.voucher.create', compact('title', 'doc'));
    }

    public function update(VoucherRequest $request, Voucher $voucher)
    {
        DB::transaction(function () use ($request, $voucher) {
            if ($request->number_code > $voucher->number_code) {
                factory(CodeVoucher::class, ((int)$request->number_code - $voucher->number_code))->create([
                    'voucher_id' => $voucher->id,
                    'manufacturer_id' => $voucher->manufacturer_id,
                ]);
            }
            $rq = $request->all();
            if ($request->hasFile('img')) {
                unlinkUpload('voucher', $voucher->img);
                $img = $this->uploadFile($rq['img'], 'voucher');
                $rq['img'] = $img;
            }
            $time1 = null;
            $time2 = null;
            if (!empty($rq['timerange'])) {
                $rq['timerange'] = str_replace("/", "-", $rq['timerange']);
                $time = explode(" - ", $rq['timerange']);
                $time1 = $time[0];
                $time2 = $time[1];

                $time1 = strtotime($time1);
                $time2 = strtotime($time2);

                unset($rq['timerange']);
            }
            $rq['time_start'] = $time1;
            $rq['time_end'] = $time2;

            $rq['number_code'] = (int)$rq['number_code'];
            $voucher->update($rq);

            flash()->success(__('flash.update_success'));
        });
        return redirect()->route('admin.voucher.index');
    }

    public function destroy(Voucher $voucher)
    {
        $count = $voucher->codevochers->count();
        if (!$count) {
            unlinkUpload('voucher', $voucher->img);
            $voucher->delete();
            return 1;
        }
    }


}
