<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends UserController
{
    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'banner',
        ]);
    }

    public function index()
    {
        $title = __('banner.title');
        return view('BE.banner.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Banner::orderBy('id');

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.banner.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('banner.new');
        return view('BE.banner.create', compact('title'));
    }

    public function store(BannerRequest $request)
    {
        if ($request->hasFile('banner_img')) {
            $img = $this->uploadFile($request->banner_img, 'banner');
            $request->merge(['img' => $img]);
        }
        if (!isset($request->active)) {
            $request->merge(['active' => 0]);
        }

        Banner::create($request->except('banner_img'));
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.banner.index');
    }

    public function edit(Banner $banner)
    {
        $doc = $banner;
        $title = __('banner.edit');
        return view('BE.banner.create', compact('title', 'doc'));
    }

    public function update(BannerRequest $request, Banner $banner)
    {
        if ($request->hasFile('banner_img')) {
            unlinkUpload('banner', $banner->img);
            $img = $this->uploadFile($request->banner_img, 'banner');
            $request->merge(['img' => $img]);
        }
        if (!isset($request->active)) {
            $request->merge(['active' => 0]);
        }

        $banner->update($request->except('banner_img'));
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.banner.index');
    }

    public function destroy(Banner $banner)
    {
        unlinkUpload('banner', $banner->img);
        $banner->delete();
        return 1;
    }


}
