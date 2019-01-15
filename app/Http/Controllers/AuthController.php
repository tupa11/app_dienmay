<?php

namespace App\Http\Controllers;

use App\Helpers\Thumbnail;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordConfirmRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\UserRequest;
use App\Models\Email;
use App\Models\InviteUser;
use App\Models\Member;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Flash;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Sentinel;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tungltdev\LaravelSettings\Facades\Settings;

class AuthController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/';

    public function index()
    {
        if (Auth::check()) {
            return redirect("/");
        }
        return view('BE.login');
    }

    /**
     * Account sign in.
     *
     * @return View
     */
    public function login()
    {
        if (Auth::check()) {
            flash()->success(__('auth.logined'));
            return redirect()->route('admin.dashboard');
        }
        return view('BE.login');
    }

    /**
     * Account sign in form processing.
     *
     * @return Redirect
     */
    public function postLogin(LoginRequest $request)
    {
        $remember = (bool)$request->remember;
        $credentials = $request->only('username', 'password');
        $credentials['active'] = 1;
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
            flash(__('auth.signin_success'))->success();
            return redirect()->route('admin.dashboard');
        } else {
            flash(__('auth.login_params_not_valid'))->error();
            return back()->withInput();
        }
    }

    /**
     * Account forgot password.
     *
     * @return View
     */
    public function getForgotPassword()
    {
        if (Sentinel::check()) {
            return redirect("/");
        }
        return view('forgot');
    }

    /**
     * Forgot password form processing page.
     *
     * @return Redirect
     */
    public function postForgotPassword(PasswordResetRequest $request)
    {
        if (!filter_var(Settings::get('site_email'), FILTER_VALIDATE_EMAIL) === false) {
            $userFind = Member::where('email', $request->email)->first();
            if (isset($userFind->id)) {
                $user = Sentinel::findById($userFind->id);
                ($reminder = Reminder::exists($user)) || ($reminder = Reminder::create($user));

                $data = [
                    'email' => $user->email,
                    'name' => $userFind->full_name,
                    'subject' => trans('auth.reset_your_password'),
                    'code' => $reminder->code,
                    'id' => $user->id
                ];
                Mail::send('emails.reminder', $data, function ($message) use ($data) {
                    $message->from(config('mail.username'), 'Accounting | Caza.vn');
                    $message->to($data['email'], $data['name'])->subject($data['subject']);
                });

                Flash::success(trans("auth.reset_password_link_send"));
                return back();
            }
            Flash::warning(trans("auth.user_dont_exists"));
            return back();
        } else {
            return redirect()->back();
        }
    }


    /**
     * Logout page.
     *
     * @return Redirect
     */
    public function getLogout()
    {
        Auth::logout();
        session()->flush();
        flash(__('auth.successfully_logout'));
        return redirect('login');
    }

    /**
     * Profile page.
     *
     * @return Redirect
     */
    public function getProfile()
    {
        if (!Sentinel::check()) {
            return redirect("/");
        }

        $title = trans('auth.user_profile');
        $user_data = Member::find(Sentinel::getUser()->id);
        return view('profile', compact('title', 'user_data'));
    }


    public function uploadFile(UploadedFile $file, $path)
    {
        $destinationPath = public_path() . '/uploads/' . $path;
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0777, true);
            copy(public_path() . '/uploads/index.html', $destinationPath . '/index.html');
            copy(public_path() . '/uploads/.ignore', $destinationPath . '/.gitignore');
        }
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();
        $picture = str_slug(substr($filename, 0, strrpos($filename, "."))) . '_' . time() . '.' . $extension;
        $image = $file->move($destinationPath, $picture);
        if ($image) {
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $sourcePath = $image->getPath() . '/' . $image->getFilename();
                $thumbPath = $image->getPath() . '/thumb_' . $image->getFilename();
                Thumbnail::generate_image_thumbnail($sourcePath, $thumbPath);
            }
            return $image->getFileInfo()->getFilename();
        }
        return null;
    }

}
