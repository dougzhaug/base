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

//配合下面方法用   不需直接调用
function make_tree($arr) {
    if (!function_exists('make_tree1')) {

        function make_tree1($arr, $parent_id = 0) {
            $new_arr = array();
            foreach ($arr as $k => $v) {
                if ($v->pid == $parent_id) {
                    $new_arr[] = $v;
                    unset($arr[$k]);
                }
            }
            foreach ($new_arr as &$a) {
                $a->children = make_tree1($arr, $a->id);
            }
            return $new_arr;
        }

    }
    return make_tree1($arr);
}

//配合下面方法用   不需直接调用
function make_tree_with_namepre($arr) {
    $arr = make_tree($arr);
    if (!function_exists('add_namepre1')) {

        function add_namepre1($arr, $prestr = '') {
            $new_arr = array();
            foreach ($arr as $v) {
                if ($prestr) {
                    if ($v == end($arr)) {
                        $v->name = $prestr . '└─ ' . $v->name;
                    } else {
                        $v->name = $prestr . '├─ ' . $v->name;
                    }
                }

                if ($prestr == '') {
                    $prestr_for_children = '&nbsp;&nbsp;';
                } else {
                    if ($v == end($arr)) {
                        $prestr_for_children = $prestr . '&nbsp;&nbsp;&nbsp;&nbsp;';
                    } else {
                        $prestr_for_children = $prestr . '│ ';
                    }
                }
                $v->children = add_namepre1($v->children, $prestr_for_children);

                $new_arr[] = $v;
            }
            return $new_arr;
        }

    }
    return add_namepre1($arr);
}

/* * 无限分类的下拉框表示
 * @param $arr  数据源  这里是对象类型
 * @param int $depth，当$depth为0的时候表示不限制深度
 * @return string
 * default  默认选择的id
 */

function make_option_tree_for_select($arr, $default, $depth = 0) {
    $arr = make_tree_with_namepre($arr);
    if (!function_exists('make_options1')) {

        function make_options1($arr, $default, $depth, $recursion_count = 0, $ancestor_ids = '') {
            $recursion_count++;
            $str = '';
            foreach ($arr as $v) {
                $value = "";
                if ($v->id == $default) {
                    $value = "selected=selected";
                }
                $str .= "<option value='{$v->id}' data-depth='{$recursion_count}' data-ancestor_ids='" . ltrim($ancestor_ids, ',') . "' {$value}>{$v->name}</option>";
                if ($v->pid == 0) {
                    $recursion_count = 1;
                }
                if ($depth == 0 || $recursion_count < $depth) {
                    $str .= make_options1($v->children,$default, $depth, $recursion_count, $ancestor_ids . ',' . $v->id);
                }
            }
            return $str;
        }

    }
    return make_options1($arr, $default, $depth);
}

/**
 * 生成导航
 * @param $arr
 * @param $default
 * @param $pid
 * @param int $depth
 * @return string
 */
function make_li_tree_for_ul($arr, $default,$pid, $depth = 0)
{
    $arr = make_tree($arr);//dd($arr);die;
    if(!function_exists('make_li')){
        function make_li($arr,$default,$pids)
        {
            $html = '';
            foreach($arr as $t)
            {
                $active = '';
                if($default == $t['id']){
                    $active = 'active';
                }elseif(in_array($t['id'],$pids)){
                    $active = 'active menu-open';
                }

                $href = '';
                if($t['route']){
                    $href = route($t['route']);
                }

                if(empty($t['children'])){
                    $html .= '<li class="' . $active . '"><a href="' . $href . '"><i class="fa ' . $t['icon'] . '"></i><span>' . $t['name'] . '</span></a></li>';
                }else{

                    if(in_array($t['id'],$pids)){
                        $active = 'active menu-open';
                    }
                    $html .= '<li class="treeview ' . $active . '"><a href="' . $href . '"><i class="fa ' . $t['icon'] . '"></i> <span>' . $t['name'] . '</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>';
                    $html .= make_li($t['children'],$default,$pids);
                    $html = $html.'</li>';
                }
            }
            return $html ? '<ul class="treeview-menu">'.$html.'</ul>' : $html ;
        }
    }
    return make_li($arr,$default,$pid);
}

if (! function_exists('success')) {
    /**
     * 成功提示页面
     *
     * @param $url
     * @param bool $message
     * @param int $time
     * @return \Illuminate\Http\RedirectResponse
     */
    function success($message,$url=false,$time=3)
    {
        return redirect('prompt')->with(['message'=>$message?:'成功','url' =>$url?:$_SERVER["HTTP_REFERER"], 'wait_time'=>$time,'status'=>'success']);
    }
}

if (! function_exists('error')) {
    /**
     * 失败提示页面
     *
     * @param $url
     * @param bool $message
     * @param int $time
     * @return \Illuminate\Http\RedirectResponse
     */
    function error($message,$url=false,$time=3)
    {
        return redirect('prompt')->with(['message'=>$message?:'失败','url' =>$url?:'javascript:history.back(-1);', 'wait_time'=>$time,'status'=>'error']);
    }
}
