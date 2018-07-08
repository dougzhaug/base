<?php

namespace App\Http\Controllers\Admin;

class PromptController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(!empty(session('message'))){
            $data = [
                'message' => session('message'),        //提示信息
                'url' => session('url'),                //跳转的URL
                'wait_time' => session('wait_time'),  //跳转的时间 默认3秒
                'status' => session('status')   //状态 success error warning continue
            ];
        } else {
            $data = [
                'message' => '请勿非法访问！',
                'url' => '/',
                'wait_time' => 3,
                'status' => 'error'
            ];
        }

        return view('admin.prompt.index',['data'=>$data]);
    }
}
