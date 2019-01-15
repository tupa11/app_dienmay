<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\SalonRequest;
use App\Models\Admin;
use App\Models\City;
use App\Models\Salon;
use Illuminate\Http\Request;

class SalonController extends UserController
{
    public function __construct()
    {
//        $this->middleware('authorized:admin.list', ['only' => ['index']]);
//        $this->middleware('authorized:admin.add', ['only' => ['create']]);
//        $this->middleware('authorized:admin.list', ['only' => ['catalog']]);

        parent::__construct();
        $title = __('salon.title');
        $admins = Admin::orderBy('id')->pluck('full_name', 'id');
        $admins->prepend(__('salon.admin'));
        view()->share([
            'type' => 'salon',
            'title' => $title,
            'admins' => $admins,
        ]);
    }

    public function index()
    {
        $citys = City::orderBy('id')->pluck('name', 'id');
        $citys->prepend(__('salon.city'));
        return view('BE.salon.index', compact('citys'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Salon::with('city', 'district')->orderBy('id');
        if (1) {
            if ($request->name) {
                $docs = $docs->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->phone) {
                $docs = $docs->where('phone', 'like', '%' . $request->phone . '%');
            }
            if ($request->admin_id) {
                $docs = $docs->whereHas('admin', function ($q) use ($request) {
                    $q->where('id', $request->admin_id);
                });
            }
            if ($request->city_id) {
                $docs = $docs->whereHas('city', function ($q) use ($request) {
                    $q->where('id', $request->city_id);
                });
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.salon.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('salon.new');
        return view('BE.salon.create', compact('title'));
    }

    public function store(SalonRequest $request)
    {
        if ($request->hasFile('img')) {
            $img = $this->uploadFile($request->img, 'salon');
            $request->merge(['img' => $img]);
        }
        Salon::create($request->all());
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.salon.index');
    }

    public function edit(Salon $salon)
    {
        $doc = $salon;
        $title = __('salon.edit');
        return view('BE.salon.create', compact('title', 'doc'));
    }

    public function update(SalonRequest $request, Salon $salon)
    {
        if ($request->hasFile('img')) {
            $img = $this->uploadFile($request->img, 'salon');
            $request->merge(['img' => $img]);
        }

        $salon->update($request->except('id'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.salon.index');
    }

    public function destroy(Salon $salon)
    {
        $salon->delete();
        return 1;
    }


}
