<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function city(Request $request)
    {
        $result = DB::table('cities')->select('id', 'name');
        if ($request->has('q')) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function district($city_id, Request $request)
    {
        $result = DB::table('districts')->select('id', 'name')->where('city_id', $city_id);
        if ($request->has('q') && $city_id) {
            $result = $result->where('name', 'LIKE', '%' . $request->q . '%');
        }
        $data = $result->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->name,
            ];
        });
        return response()->json($data, 200);
    }

    public function createMember(Request $request)
    {
        $data = $request->all();
        return response()->json($data, 200);
    }
}

