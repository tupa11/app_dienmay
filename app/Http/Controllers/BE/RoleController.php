<?php

namespace App\Http\Controllers\BE;

use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends UserController
{

    protected $module = [
        'admin' => ['admin', 'role'],
        'member',
        'product' => ['product', 'productdelete', 'color', 'size'],
        'category',
        'manufacturer',
        'sale_viethan',
        'voucher',
        'code_voucher',
        'banner',
        'image',
        'area',
    ];
    protected $permission = ['list', 'edit', 'add', 'delete'];

    protected $custom = [
        'setting.index' => 'Cài đặt',
//        'order_price.change' => 'Change sales order price',
//        'product.stock' => 'Product - stock tab',
//        'product.price' => 'Product - price tab',
    ];

    public function generateParams()
    {
        view()->share([
            'permission' => $this->permission,
            'module' => $this->module,
            'custom' => $this->custom,
            'dashboard' => ['dashboard.basic' => 'Basic Dashboard', 'dashboard.admin' => 'Admin Dashboard']
        ]);
    }

    public function __construct()
    {

        parent::__construct();

        view()->share([
            'type' => 'role',
        ]);
    }

    public function index()
    {
        $title = __('role.title');
        return view('BE.role.index', compact('title'));
    }

    public function grid(Request $request)
    {
        $limit = $request->limit ?: 5;
        $docs = Role::orderBy('id');
        if ($request->name) {
            $docs = $docs->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->username) {
            $docs = $docs->where('username', 'like', '%' . $request->username . '%');
        }

        $docs = $docs->paginate($limit);
        $total = $docs->total();

        return view('BE.role.grid', compact('docs', 'total'));
    }

    public function create()
    {
        $title = __('role.new');
        $this->generateParams();
        return view('BE.role.create', compact('title'));
    }

    public function store(Request $request)
    {
        $rq = $request->all();
        $rq['permissions'] = json_encode($rq['permissions']);

        Role::create($rq);
        flash()->success(__('flash.create_success'));
        return redirect()->route('admin.role.index');
    }

    public function edit(Role $role)
    {
        $doc = $role;
        $title = __('role.edit') . " " . @$doc->name;

        $this->generateParams();
        return view('BE.role.create', compact('title', 'doc'));
    }

    public function update(Request $request, Role $role)
    {
        $rq = $request->all();
        $rq['permissions'] = json_encode($rq['permissions']);

        $role->update($rq);
        flash()->success(__('flash.update_success'));
        return redirect()->route('admin.role.index');
    }

    public function destroy(Role $role)
    {
        $count = $role->admins->count();
        if (!$count) {
            $role->delete();
            return 1;
        }
    }

}
