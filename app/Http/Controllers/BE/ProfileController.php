<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Admin;
use App\Models\Area;
use Illuminate\Http\Request;

class ProfileController extends UserController
{
    public function __construct()
    {
//        $this->middleware('authorized:admin.list', ['only' => ['index']]);
//        $this->middleware('authorized:admin.add', ['only' => ['create']]);
//        $this->middleware('authorized:admin.list', ['only' => ['catalog']]);

        parent::__construct();

        $areas_pluck = Area::get()->pluck('name_address', 'id');
        $areas_pluck = $areas_pluck->prepend(__('admin.area'), '');

        view()->share([
            'type' => 'profile',
            'areas_pluck' => $areas_pluck,
        ]);
    }

    public function index()
    {
        $title = __('profile.title');

        $lang = ['en' => 'English', 'vi' => 'Vietnamese'];
        if (!auth()->check()) {
            flash()->success(__('auth.logined'));
            return redirect()->route('getlogin');
        }
        return view('BE.profile.index', compact('lang', 'title'));
    }

    public function update(Request $request, $id)
    {
        if ($this->user->id != $id) {
            return redirect()->route('admin.profile.index');
        }
        $admin = Admin::find($id);

        if (!empty($request->changepass)) {
            if (password_verify($request->oldPass, $admin->password)) {
                $request->validate([
                    'oldPass' => 'required|string|min:3',
                    'newPass' => 'required|string|min:3',
                    'confNewPass' => 'required|same:newPass',
                ]);
                $admin->password = bcrypt($request->newPass);
                $admin->save();
            } else {
                flash()->error(__('auth.failed'));
                return redirect()->route('admin.profile.index');
            }
        } else {

            if ($request->hasFile('avatar_file')) {
                unlinkUpload('avatar', $admin->avatar);
                $user_avatar = $this->uploadFile($request->avatar_file, 'avatar');
                $request->merge(['avatar' => $user_avatar]);
            }
            $admin->update($request->except('id', 'password_confirmation', 'avatar_file'));
        }

        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.profile.index');
    }


}
