<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

class DashboardController extends UserController
{
    protected $result = [];
    protected $data = [];

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $title = __('dashboard.title');

        if (Auth::check()) {
            if (true) {
                return view('BE.dashboard.admin', compact('title'));
            } elseif (true) {
                return view('BE.dashboard.basic');
            }
        }
    }
}
