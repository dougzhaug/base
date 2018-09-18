<?php

use Illuminate\Database\Seeder;

class RouteHasPermissionsTableSeeder extends Seeder
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
                'permission_id' => 1,
                'route' => 'index',
            ],
            [
                'permission_id' => 100,
                'route' => 'admin',
            ],
            [
                'permission_id' => 101,
                'route' => 'admin.create',
            ],
            [
                'permission_id' => 101,
                'route' => 'admin.store',
            ],
            [
                'permission_id' => 102,
                'route' => 'admin.show',
            ],
            [
                'permission_id' => 103,
                'route' => 'admin.edit',
            ],
            [
                'permission_id' => 103,
                'route' => 'admin.update',
            ],
            [
                'permission_id' => 104,
                'route' => 'admin.destroy',
            ],
            [
                'permission_id' => 200,
                'route' => 'role',
            ],
            [
                'permission_id' => 201,
                'route' => 'role.create',
            ],
            [
                'permission_id' => 201,
                'route' => 'role.store',
            ],
            [
                'permission_id' => 202,
                'route' => 'role.show',
            ],
            [
                'permission_id' => 203,
                'route' => 'role.edit',
            ],
            [
                'permission_id' => 203,
                'route' => 'role.update',
            ],
            [
                'permission_id' => 204,
                'route' => 'role.destroy',
            ],
            [
                'permission_id' => 205,
                'route' => 'role.get_permissions',
            ],
            [
                'permission_id' => 300,
                'route' => 'permission',
            ],
            [
                'permission_id' => 301,
                'route' => 'permission.create',
            ],
            [
                'permission_id' => 301,
                'route' => 'permission.store',
            ],
            [
                'permission_id' => 302,
                'route' => 'permission.show',
            ],
            [
                'permission_id' => 303,
                'route' => 'permission.edit',
            ],
            [
                'permission_id' => 303,
                'route' => 'permission.update',
            ],
            [
                'permission_id' => 304,
                'route' => 'permission.destroy',
            ],
            [
                'permission_id' => 305,
                'route' => 'permission.sort',
            ],
            [
                'permission_id' => 401,
                'route' => 'prompt',
            ],
            [
                'permission_id' => 421,
                'route' => 'qiniuCloud.get_up_token',
            ],
            [
                'permission_id' => 422,
                'route' => 'qiniuCloud.get_up_url',
            ],
        ];


        DB::table('route_has_permissions')->insert($insertData);
    }
}
