<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends BaseController
{

    protected $permission = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissionsAll = Permission::orderBy('sort','desc')->get();
        $permissions = make_tree_with_namepre($permissionsAll);
        $a = $this->getPermission($permissions);//dd($a);die;


        return view('admin.permission.index',['permissions'=>$a]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //$permission = Permission::create(['name' => '修改权限-执行','pid'=>3,'route'=>'permission.update','is_nav'=>0,'icon'=>'']);dd($permission);die;
        $all = Permission::orderBy('sort','desc')->get();

        $permission = make_option_tree_for_select($all,$request->pid);//dd($a);die;

        return view('admin.permission.create',['permission'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required','unique:permissions'],
        ]);

        $create = [
            'name' => $request->name,
            'pid' => $request->pid ? : 0,
            'url' => $request->url ? : '',
            'route' => $request->route ? : '',
            'icon' => $request->icon ? : 'fa-retweet',
            'sort' => $request->sort ? : 0,
            'is_nav' => $request->is_nav ? 1 : 0,
        ];

        $permission = Permission::create($create);


        if($permission){
            return success('添加成功','permission');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Permission::find($id);

        $all = Permission::orderBy('sort','desc')->get();

        $permission = make_option_tree_for_select($all,$data['pid']);

        return view('admin.permission.edit',['data'=>$data,'permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        $this->validate($request, [
            'name' => ['required'],
        ]);
        $update = [
            'name' => $request->name,
            'pid' => $request->pid ? : 0,
            'url' => $request->url ? : '',
            'route' => $request->route ? : '',
            'icon' => $request->icon ? : 'fa-retweet',
            'sort' => $request->sort ? : 0,
            'is_nav' => $request->is_nav ? 1 : 0,
        ];
        $permission = Permission::where(['id'=>$request->id])->update($update);
        if($permission){
            return success('修改成功','permission');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission,$id)
    {
        //
        $permission = Permission::destroy($id);
        if($permission){
            return success('删除成功','permission');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 排序
     *
     * @param Request $request
     * @return array
     */
    public function sort(Request $request)
    {
        $permission = Permission::where(['id'=>$request->id])->update(['sort'=>$request->sort]);
        if($permission){
            return $this->returnAjax('修改成功');
        }else{
            return $this->returnAjax('网络异常',40502);
        }

    }

    private function getPermission($data)
    {
        foreach ($data as $k => $v) {
            //若$v仍为数组 则调用自身
            if (isset($v['children']) && $v['children']){
                $this -> permission[] = $v;
                $this->getPermission($v['children']);

            }else{
                $this -> permission[] = $v;
            }
        }
        return $this -> permission;

    }
}
