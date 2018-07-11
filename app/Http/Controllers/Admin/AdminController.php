<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Rules\phone;
use Illuminate\Http\Request;

class AdminController extends BaseController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){
            return [
                'draw'=>intval($request->draw),
                'recordsTotal' => 100,
                'recordsFiltered' => 98,
                'data' => Admin::all(),
                //'error' => '错误提示',
            ];
        }
        return view('admin.admin.index');
    }

    public function create()
    {
        return view('admin.admin.create');
    }

    public function store(Request $request)
    {
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required','unique:admins',new phone()],
            'email' => 'string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
        ]);
    }
}
