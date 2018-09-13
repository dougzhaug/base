<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Auth;
use Qiniu\Zone;

class QiniuCloudController extends BaseController
{
    //七牛云

    private $config;
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->config = config('uploader.disks.qiniu');
    }

    /**
     * 获取七牛云上传token
     */
    public function get_up_token()
    {
        $auth = new Auth(config('uploader.disks.qiniu.access_key'),config('uploader.disks.qiniu.secret_key'));
        $uptoken = $auth->uploadToken(config('uploader.disks.qiniu.bucket'));
        return ['uptoken'=>$uptoken];
    }

    /**
     * 获取七牛云上传url
     * @return array
     */
    public function get_up_url()
    {
        $zone = Zone::queryZone($this->config['access_key'],$this->config['bucket']);
        $upurl = 'https://'.array_get($zone->cdnUpHosts, '0');
        return ['upurl'=>$upurl];
    }
}
