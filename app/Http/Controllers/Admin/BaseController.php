<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected $admin;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->getNav();
    }

    /**
     * 导航-共享信息
     */
    private function getNav()
    {
        $route = \Request::route()->getName();  //获取当前路由别名
//        $url = \Request::getRequestUri();     //获取当前路由
//        $url = substr($url,1,strrpos($url,'?')?strrpos($url,'?')-1:100); //dd($url);die;
        $permission = Permission::where(['route'=>$route])->first();

        $permissionAll = Permission::where(['is_nav'=>1])->orderBy('sort','desc')->get();
        $nav = make_li_tree_for_ul($permissionAll,$permission->id,$permission->pid);
        $nav = substr($nav,26,-5);

        View::share('nav',rtrim($nav));
    }

    /**
     * 返回ajax数据（默认为成功）
     *
     * @param $msg
     * @param $data
     * @param bool $code
     * @return array
     */
    protected function returnAjax($msg,$code=false,$data=[])
    {
        $code = $code ? : 0;
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}
