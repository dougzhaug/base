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

            $builder = Admin::select(['id','name','phone','email','created_at']);

            /* where start*/

            if($request->keyword){
                $builder->where($request->action_field,'like','%'.$request->keyword.'%');
            }

            /* where end */

            //获取总条数
            $total = $builder->count();

            if($request->order){
                $order = $request->order[0];
                $order_column = $columns[$order['column']]['data'];
                $order_dir = $order['dir'];
                $builder->orderBy($order_column,$order_dir);
            }

            $data = $builder->offset($request->start)->take($request->length)->get()->toArray();

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        $actionField = ['name'=>'姓名','phone'=>'手机号','email'=>'邮箱'];
        $this->setActionField($actionField);
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
