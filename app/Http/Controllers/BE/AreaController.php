<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends UserController
{
    public function __construct()
    {
        parent::__construct();

        view()->share([
            'type' => 'area'
        ]);
    }

    public function index()
    {
        $title = __('area.title');
        return view('BE.area.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Area::orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->address) {
            $docs = $docs->where('address', 'like', '%' . $request->address . '%');
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.area.grid', compact('docs', 'total'));
    }

    public function store(AreaRequest $request)
    {
        Area::create($request->all());
        return 1;
    }

    public function show(Area $area)
    {
        return response()->json($area, 200);
    }

    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->except('area_id'));
        return 1;
    }

    public function destroy(Area $area)
    {
        $count = $area->admins->count();
        if (!$count) {
            $area->delete();
            return 1;
        }
    }
}

