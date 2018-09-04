<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    protected $admin;
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth:admin');
        $this->middleware(function ($request, $next) {      //使用中间来实现左侧导航自动加载
            $this->admin =  Auth::user();
            $this->getNav();
            return $next($request);
        });
        $this->setLayout();
        $this->receiveDate();
    }

    /**
     * 导航-共享信息
     *
     */
    private function getNav()
    {
        $route = FacadesRequest::route()->getName();  //获取当前路由别名
        $permission = Permission::where('route','like','%'.$route.'%')->first();//dd($permission);die;
        if(!$permission){   //当前路由不存在
            return error('路由异常');
        }

        //面包屑导航
        $this->getBreadcrumb($permission['pids'],$permission['id']);

        if(in_array($this->admin->name,['admin'])){       //总管理员
            $permissionAll = Permission::where(['is_nav'=>1])->orderBy('sort','desc')->get();
        }else{
            $pAll = $this->admin->getAllPermissions();
            $permissionAll = [];
            foreach ($pAll as $v){
                if($v['is_nav']){
                    $permissionAll[] = $v;
                }
            }
        }

        $nav = make_li_tree_for_ul($permissionAll,$permission->id,explode(',',$permission->pids));
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

    /**
     * 设置模板类型
     *
     * @param $layout
     */
    protected function setLayout($layout=false)
    {
        View::share('layout',$layout ? trim($layout) : 'admin.layouts.fixed');
    }

    /**
     * 验证器
     *
     * @param $data
     * @param $rule
     * @return mixed
     */
    protected function validator($data,$rule)
    {
        return Validator::make($data, $rule)->validate();
    }

    /**
     * 设置多功能输入框选项
     *
     * @param $fields
     */
    protected function setActionField($fields)
    {
        View::share('actionField',$fields);
    }

    /**
     * 时间查询
     */
    protected function receiveDate()
    {
        if($date_range = $this->request->date_range){
            list($start_date,$end_date) = explode(config('daterangepicker.separator'),$date_range);

            $this->request->start_date = $start_date;
            $this->request->end_date = $end_date;

            View::share([
                'start_date'=> $start_date,
                'end_date' => $end_date
            ]);
        }
    }

    /**
     * 面包屑导航
     *
     * @param $pids  当前路由的父导航
     * @param $id   当前路由
     */
    protected function getBreadcrumb($pids,$id)
    {
        $ids = explode(',',$pids);
        array_push($ids,$id);
        $breadcrumb = Permission::whereIn('id',$ids)->get()->toArray();

        $endBreadcrumb = array_pop($breadcrumb);
        View::share([
            'breadcrumb'=>$breadcrumb,
            'endBreadcrumb' =>$endBreadcrumb,
        ]);
    }
}
