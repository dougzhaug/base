<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5
 * Time: 16:36
 */

if (! function_exists('admin_asset')) {
    /**
     * 后台资源路径
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function admin_asset($path, $secure = null)
    {
        $path = 'static/admin/' . $path;
        return app('url')->asset($path, $secure);
    }
}