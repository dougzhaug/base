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
            $columns = $request->columns;
            $order_column = 'id';
            $order_dir = 'desc';

            if($request->order){
                $order = $request->order[0];
                $order_column = $columns[$order['column']]['data'];
                $order_dir = $order['dir'];
            }

            $data = Admin::where([])->orderBy($order_column,$order_dir)->paginate($request->length)->toArray();
            $data['draw'] =  intval($request->draw);
            $data['recordsTotal'] =  $data['total'];
            $data['recordsFiltered'] =  $data['total'];
            return $data;
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
