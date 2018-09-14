<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insertData = [
            [
                'id' => 1,
                'name' => '首页',
                'guard_name' => 'admin',
                'pid' => 0,
                'pids' => '',
                'url' => '',
                'route' => 'index',
                'sort' => 0,
                'icon' => 'fa fa-home',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'name' => '系统管理',
                'guard_name' => 'admin',
                'pid' => 0,
                'pids' => '',
                'url' => '',
                'route' => '',
                'sort' => 0,
                'icon' => 'fa fa-gears',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 管理员管理 */
            [
                'id' => 100,
                'name' => '管理员管理',
                'guard_name' => 'admin',
                'pid' => 10,
                'pids' => '10',
                'url' => '',
                'route' => 'admin',
                'sort' => 3,
                'icon' => 'fa fa-user',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 101,
                'name' => '添加管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'pids' => '10,100',
                'url' => '',
                'route' => 'admin.create,admin.store',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 102,
                'name' => '展示管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'pids' => '10,100',
                'url' => '',
                'route' => 'admin.show',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 103,
                'name' => '修改管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'pids' => '10,100',
                'url' => '',
                'route' => 'admin.edit,admin.update',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 104,
                'name' => '删除管理员',
                'guard_name' => 'admin',
                'pid' => 100,
                'pids' => '10,100',
                'url' => '',
                'route' => 'admin.destroy',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 角色管理 */
            [
                'id' => 200,
                'name' => '角色管理',
                'guard_name' => 'admin',
                'pid' => 10,
                'pids' => '10',
                'url' => '',
                'route' => 'role',
                'sort' => 2,
                'icon' => 'fa fa-puzzle-piece',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 201,
                'name' => '添加角色',
                'guard_name' => 'admin',
                'pid' => 200,
                'pids' => '10,200',
                'url' => '',
                'route' => 'role.create,role.store',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 202,
                'name' => '展示角色',
                'guard_name' => 'admin',
                'pid' => 200,
                'pids' => '10,200',
                'url' => '',
                'route' => 'role.show',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 203,
                'name' => '修改角色',
                'guard_name' => 'admin',
                'pid' => 200,
                'pids' => '10,200',
                'url' => '',
                'route' => 'role.edit,role.update',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 204,
                'name' => '删除角色',
                'guard_name' => 'admin',
                'pid' => 200,
                'pids' => '10,200',
                'url' => '',
                'route' => 'role.destroy',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 205,
                'name' => '获取权限节点',
                'guard_name' => 'admin',
                'pid' => 200,
                'pids' => '10,200',
                'url' => '',
                'route' => 'role.get_permissions',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            /* 权限管理 */
            [
                'id' => 300,
                'name' => '权限管理',
                'guard_name' => 'admin',
                'pid' => 10,
                'pids' => '10',
                'url' => '',
                'route' => 'permission',
                'sort' => 1,
                'icon' => 'fa fa-sitemap',
                'is_nav' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 301,
                'name' => '添加权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'pids' => '10,300',
                'url' => '',
                'route' => 'permission.create,permission.store',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 302,
                'name' => '展示权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'pids' => '10,300',
                'url' => '',
                'route' => 'permission.show',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 303,
                'name' => '修改权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'pids' => '10,300',
                'url' => '',
                'route' => 'permission.edit,permission.update',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 304,
                'name' => '删除权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'pids' => '10,300',
                'url' => '',
                'route' => 'permission.destroy',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 305,
                'name' => '排序权限',
                'guard_name' => 'admin',
                'pid' => 300,
                'pids' => '10,300',
                'url' => '',
                'route' => 'permission.sort',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 400,
                'name' => '默认选中项',
                'guard_name' => 'admin',
                'pid' => 0,
                'pids' => '',
                'url' => '',
                'route' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 401,
                'name' => '提示信息',
                'guard_name' => 'admin',
                'pid' => 400,
                'pids' => '400',
                'url' => '',
                'route' => 'prompt',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 402,
                'name' => '图片上传资源',
                'guard_name' => 'admin',
                'pid' => 400,
                'pids' => '400',
                'url' => '',
                'route' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 420,
                'name' => '七牛云资源',
                'guard_name' => 'admin',
                'pid' => 402,
                'pids' => '400,402',
                'url' => '',
                'route' => '',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 421,
                'name' => '获取七牛云上传token',
                'guard_name' => 'admin',
                'pid' => 420,
                'pids' => '400,402,420',
                'url' => '',
                'route' => 'qiniuCloud.get_up_token',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 422,
                'name' => '获取七牛云上传url',
                'guard_name' => 'admin',
                'pid' => 420,
                'pids' => '400,402,420',
                'url' => '',
                'route' => 'qiniuCloud.get_up_url',
                'sort' => 0,
                'icon' => '',
                'is_nav' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        DB::table('permissions')->insert($insertData);
    }
}
