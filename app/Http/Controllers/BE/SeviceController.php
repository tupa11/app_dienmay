<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\SeviceRequest;
use App\Models\Admin;
use App\Models\Sevice;
use Illuminate\Http\Request;

class SeviceController extends UserController
{
    public function __construct()
    {

        parent::__construct();
        $title = __('sevice.title');
        $types = [
            '0' => 'Compo',
            '1' => 'Other',
        ];
        view()->share([
            'type' => 'sevice',
            'title' => $title,
            'types' => $types,
        ]);
    }

    public function index()
    {
        return view('BE.sevice.index');
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Sevice::with('salons')->orderBy('id');
        if (1) {
            if ($request->fullname) {
                $docs = $docs->where('full_name', 'like', '%' . $request->fullname . '%');
            }
            if ($request->username) {
                $docs = $docs->where('username', 'like', '%' . $request->username . '%');
            }
            if ($request->group) {
                $docs = $docs->where('group', $request->group);
            }
            if ($request->status) {
                $docs = $docs->where('status', $request->status);
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.sevice.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('sevice.new');
        return view('BE.sevice.create', compact('title'));
    }

    public function store(SeviceRequest $request)
    {
        dd($request->all());
        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
            $request->merge(['user_avatar' => $user_avatar]);
        }
        Admin::create($request->all());
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.sevice.index');
    }

    public function edit(Sevice $sevice)
    {
        $doc = $sevice;
        $title = __('sevice.edit');
        return view('BE.sevice.create', compact('title', 'doc'));
    }

    public function update(SeviceRequest $request, Sevice $admin)
    {
        $request['status'] = (boolean)$request['status'];
        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
        } else {
            $request->merge(['password' => $admin->password]);
        }

        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
            $request->merge(['user_avatar' => $user_avatar]);
        }

        $admin->update($request->except('id', 'password_confirmation'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.admin.index');
    }

    public function destroy(Sevice $admin)
    {
        $count = $admin->shops->count();
        if (!$count) {
            $admin->delete();
            return 1;
        }
    }


}
