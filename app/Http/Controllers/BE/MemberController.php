<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Area;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends UserController
{
    public function __construct()
    {
//        $this->middleware('authorized:admin.list', ['only' => ['index']]);
//        $this->middleware('authorized:admin.add', ['only' => ['create']]);
//        $this->middleware('authorized:admin.list', ['only' => ['catalog']]);

        parent::__construct();

        $areas_pluck = Area::get()->pluck('name_address', 'id');
        $areas_pluck = $areas_pluck->prepend(__('member.area'), '');

        $levels = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
        ];

        view()->share([
            'type' => 'member',
            'levels' => $levels,
            'areas_pluck' => $areas_pluck,
        ]);
    }

    public function index()
    {
        $title = __('member.title');
        return view('BE.member.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Member::with('area', 'admin')->orderBy('id');
        if (1) {
            if ($request->name) {
                $docs = $docs->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->username) {
                $docs = $docs->where('username', 'like', '%' . $request->username . '%');
            }
            if ($request->level) {
                $docs = $docs->where('level', $request->level);
            }
            if ($request->area_id) {
                $docs = $docs->whereHas('area', function ($q) use ($request) {
                    $q->where('id', $request->area_id);
                });
            }
            if ($request->status) {
                $docs = $docs->where('status', $request->status);
            }
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.member.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('member.new');
        return view('BE.member.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validate = [
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'username' => 'required|unique:members|alpha|min:3|max:99',
            'level' => 'required',
            'area_id' => 'required',
            'password' => 'required|string|min:3',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|regex:/^\d{7,15}?$/',
        ];
        if ($this->user->group == "admin") {
            $request->merge(['admin_id' => $this->user->id]);
        } else {
//            $validate['admin_id'] = 'required';
            $request->merge(['admin_id' => 1]);
        }

        $request->validate($validate);

        if ($request->hasFile('avatar_file')) {
            $user_avatar = $this->uploadFile($request->avatar_file, 'member');
            $request->merge(['avatar' => $user_avatar]);
        }
        Member::create($request->except('avatar_file'));
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.member.index');
    }

    public function edit(Member $member)
    {
        $doc = $member;
        $title = __('member.edit');
        return view('BE.member.create', compact('title', 'doc'));
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|min:2|max:50|regex:/^[\pL\s\-]+$/u',
            'level' => 'required',
            'area_id' => 'required',
//            'admin_id' => 'required',
            'phone' => 'required|regex:/^\d{7,15}?$/',
        ]);

        $request['active'] = (bool)$request['active'];
        $request['gender'] = (bool)$request['gender'];
        if ($request->password) {
            $request->merge([
                'password' => bcrypt($request->password)
            ]);
        } else {
            $request->merge(['password' => $member->password]);
        }
        if ($request->hasFile('avatar_file')) {
            unlinkUpload('member', $member->avatar);
            $user_avatar = $this->uploadFile($request->avatar_file, 'member');
            $request->merge(['avatar' => $user_avatar]);
        }
        $member->update($request->except('id', 'password_confirmation', 'avatar_file'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.member.index');
    }

    public function destroy(Member $member)
    {
        $count = 0;
        if (!$count) {
            unlinkUpload('member', $member->avatar);
            $member->delete();
            return 1;
        }
    }


}
