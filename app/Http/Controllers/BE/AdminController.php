<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminController extends UserController
{
    public function __construct()
    {
        $this->middleware('authorized:admin.list', ['only' => ['index']]);
        $this->middleware('authorized:admin.add', ['only' => ['create']]);

        parent::__construct();

        $areas_pluck = Area::get()->pluck('name_address', 'id');
        $areas_pluck = $areas_pluck->prepend(__('admin.area'), '');

        $roles_pluck = Role::get()->pluck('name', 'id');
        $roles_pluck = $roles_pluck->prepend(__('role.name'), '');


        view()->share([
            'type' => 'admin',
            'roles_pluck' => $roles_pluck,
            'areas_pluck' => $areas_pluck,
        ]);
    }

    public function index()
    {
        $title = __('admin.title');
        return view('BE.admin.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Admin::with('role', 'area')->orderBy('id');
        if (1) {
            if ($request->name) {
                $docs = $docs->where('name', 'like', '%' . $request->fullname . '%');
            }
            if ($request->username) {
                $docs = $docs->where('username', 'like', '%' . $request->username . '%');
            }
            if ($request->role_id) {
                $docs = $docs->whereHas('role', function ($q) use ($request) {
                    $q->where('id', $request->role_id);
                });
            }
            if ($request->area_id) {
                $docs = $docs->whereHas('area', function ($q) use ($request) {
                    $q->where('id', $request->area_id);
                });
            }
            if ($request->active) {
                $docs = $docs->where('active', $request->active);
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.admin.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('admin.new');
        return view('BE.admin.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|unique:admins|alpha|min:3|max:99',
            'role_id' => 'required',
            'area_id' => 'required',
            'password' => 'required|string|min:3',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|regex:/^\d{7,15}?$/',
        ]);

        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
            $request->merge(['avatar' => $user_avatar]);
        }
        Admin::create($request->all());
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.admin.index');
    }

    public function edit(Admin $admin)
    {
        $doc = $admin;
        $title = __('admin.edit');
        return view('BE.admin.create', compact('title', 'doc'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'area_id' => 'required',
            'role_id' => 'required',
            'phone' => 'required|regex:/^\d{7,15}?$/',
        ]);


        $request['active'] = (boolean)$request['active'];
        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
        } else {
            $request->merge(['password' => $admin->password]);
        }

        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
            $request->merge(['avatar' => $user_avatar]);
        }
        $admin->update($request->except('id', 'password_confirmation', 'avatar_file'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.admin.index');
    }

    public function destroy(Admin $admin)
    {
        $count = $admin->shops->count();
        if (!$count) {
            $admin->delete();
            return 1;
        }
    }


}
