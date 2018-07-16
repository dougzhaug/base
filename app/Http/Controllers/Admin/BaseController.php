<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
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
        $this->setLayout();
        $this->getNav();
        $this->receiveDate();

    }

    /**
     * 导航-共享信息
     */
    private function getNav()
    {
        $route = FacadesRequest::route()->getName();  //获取当前路由别名
//        $url = \Request::getRequestUri();     //获取当前路由
//        $url = substr($url,1,strrpos($url,'?')?strrpos($url,'?')-1:100); //dd($url);die;
        $permission = Permission::where(['route'=>$route])->first();
        if(!$permission){   //当前路由不存在
            return error('路由异常');
        }
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
}
