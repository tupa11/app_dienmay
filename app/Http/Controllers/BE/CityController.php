<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\AreaRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends UserController
{
    public function __construct()
    {
        parent::__construct();
        $title = __('city.title');
        view()->share([
            'type' => 'city',
            'title' => $title
        ]);
    }

    public function index()
    {
        return view('BE.city.index');
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = City::with('districts')->orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.city.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('city.new');
        return view('BE.city.create', compact('title'));
    }

    public function store(AreaRequest $request)
    {
        City::create($request->all());
        return 1;
    }

    public function show(City $city)
    {
        return response()->json($city, 200);
    }

    public function edit(City $city)
    {

    }

    public function update(AreaRequest $request, City $city)
    {
        $city->update($request->except('city_id'));
        return 1;
    }

    public function destroy(City $city)
    {
        $count = 0;
        if (!$count) {
            $city->delete();
            return 1;
        }
    }
}

