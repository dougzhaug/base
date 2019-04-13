<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\RouteHasPermission;
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
    protected $error;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->setLayout();
        $this->receiveDate();
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
