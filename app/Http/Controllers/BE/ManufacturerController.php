<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\BannerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends UserController
{
    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'manufacturer',
        ]);
    }

    public function index()
    {
        $title = __('manufacturer.title');
        return view('BE.manufacturer.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Manufacturer::orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }
        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.manufacturer.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('manufacturer.new');
        return view('BE.manufacturer.create', compact('title'));
    }

    public function store(BannerRequest $request)
    {
        if ($request->hasFile('logo_file')) {
            $img = $this->uploadFile($request->logo_file, 'manufacturer');
            $request->merge(['logo' => $img]);
        }
        $manufacturer = null;
        if (!empty($request->manufacturer_id)) {
            $manufacturer = Manufacturer::find($request->manufacturer_id);
            $manufacturer->name = $request->name;
            $manufacturer->logo = $request->logo;
            $manufacturer->save();
            flash()->success(__('flash.update_success'));
        } else {
            Manufacturer::create($request->except('logo_file', 'manufacturer_id'));
            flash()->success(__('flash.create_success'));
        }

        return redirect()->route('admin.manufacturer.index');
    }

    public function show(Manufacturer $manufacturer)
    {
        return response()->json($manufacturer, 200);
    }

    public function update(BannerRequest $request, Manufacturer $manufacturer)
    {

    }

    public function destroy(Manufacturer $manufacturer)
    {
        $count = $manufacturer->vouchers->count();
        if (!$count) {
            unlinkUpload('manufacturer', $manufacturer->logo);
            $manufacturer->delete();
            return 1;
        }
    }


}
