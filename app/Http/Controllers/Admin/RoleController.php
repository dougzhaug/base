<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->isMethod('post')){
            $builder = Role::where('guard_name','admin')->orderBy('id','desc')->select(['id','name','guard_name','depict','created_at']);

            /* where start*/

            if($request->keyword){
                $builder->where($request->action_field,'like','%'.$request->keyword.'%');
            }

            /* where end */

            //获取总条数
            $total = $builder->count();

            $data = $builder->offset($request->start)->take($request->length)->get()->toArray();

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        $actionField = ['name'=>'角色名称'];
        $this->setActionField($actionField);
        return view('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.create');
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
            'name' => ['required','unique:roles'],
            'permissions' => ['required'],
        ]);

        $create = [
            'name' => $request->name,
            'depict' => $request->depict ? : '',
            'js_tree_ids' => $request->js_tree_ids,
        ];

        $role = Role::create($create);

        if(!$role){
            return error('网络异常');
        }

        $permission_ids = explode(',',$request->permissions) ? : 0;       //选中的权限id  explode(',',"1,10,100,101,203,303,305");

        $permissions = Permission::whereIn('id',$permission_ids)->get();

        $result = $role->syncPermissions($permissions);

        if($result){
            return success('添加成功','role');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('admin.role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $this->validate($request, [
            'name' => ['required'],
            'permissions' => ['required'],
        ]);

        $update = [
            'name' => $request->name,
            'depict' => $request->depict ? : '',
            'js_tree_ids' => $request->js_tree_ids,
        ];

        $res = $role->update($update);

        if(!$res){
            return error('网络异常');
        }

        $permission_ids = explode(',',$request->permissions) ? : 0;       //选中的权限id  explode(',',"1,10,100,101,203,303,305");

        $permissions = Permission::whereIn('id',$permission_ids)->get();

        $result = $role->syncPermissions($permissions);

        if($result){
            return success('编辑成功','role');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        if(!empty($role->users->toArray())){       //如果该角色已经分配了将不能删除
            return error('该角色已经被分配，请收回后再进行操作');
        }
        $result = $role->delete();
        if($result){
            return success('编辑成功','role');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 获取权限节点
     *
     * @param Request $request
     * @param Role $role
     * @return array
     */
    public function get_permissions(Request $request,Role $role)
    {
        if($request->ajax()){
            $permissionAll = Permission::all(['id','name as text','pid','icon']);

            if($role){     //编辑
                $rolePermissions = explode(',',$role->js_tree_ids);        //获取角色的权限id
                foreach ($permissionAll as $k=>$v){
                    if(in_array($v['id'],$rolePermissions)){
                        $v['state'] = ['selected'=>true];
                    }
                }
            }

            $permissions = make_tree($permissionAll);
            return $permissions;
        }
    }
}
