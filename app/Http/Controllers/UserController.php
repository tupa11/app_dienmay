<?php

namespace App\Http\Controllers;

use App\Helpers\Thumbnail;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserController extends Controller
{
    public $user;

    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            $usrr = auth()->user();
            if (auth()->check() && $usrr) {
                $this->user = $usrr;
                $locale = $usrr->lang ?: 'en';
                app()->setLocale($locale);
                view()->share('user_data', $this->user);
            } else {
                return redirect('login');
            }
            return $next($request);
        });

    }

    public function pageInfo($page, $length, $count)
    {
        $page = $page ?: 1;
        $from = ($page - 1) * $length + 1;
        $to = ($page) * $length;
        $to = $to > $count ? $count : $to;
        $from = $from > $to ? $to : $from;
        return 'Showing ' . $from . ' to ' . $to . ' of ' . $count . ' entries';
    }

    public function uploadFile(UploadedFile $file, $path)
    {
        $destinationPath = public_path() . '/uploads/' . $path;
        if (!is_dir($destinationPath)) {
            @mkdir($destinationPath, 0777, true);
            @copy(public_path() . '/uploads/index.html', $destinationPath . '/index.html');
            @copy(public_path() . '/uploads/.ignore', $destinationPath . '/.gitignore');
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
