<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteHasPermission extends Model
{
    /**
     * 更新数据
     *
     * @param $permission_id
     * @param $route
     * @return mixed
     */
    public static function updateRouteHasPermission($permission_id,$route)
    {

        self::deleteRoutHasPermission($permission_id);

        $routes = explode(',',$route);

        $insert = [];
        foreach ($routes as $val){
            $insert[] = ['permission_id'=>$permission_id,'route'=>$val];
        }
        return self::insert($insert);
    }

    /**
     * 删除对应的所以数据
     *
     * @param $permission_id
     * @return mixed
     */
    public static function deleteRoutHasPermission($permission_id)
    {

        return self::where(['permission_id'=>$permission_id])->delete();
    }

    /**
     * 一对多（反向）
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function permission()
    {
        return self::belongsTo('App\Models\Permission');
    }
}
