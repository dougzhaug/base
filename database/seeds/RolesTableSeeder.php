<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name' => '总管理员',
                'guard_name' => 'admin',
                'depict' => '拥有最高权限',
                'js_tree_ids' => '1,10,100,101,102,103,104,200,201,202,203,204,205,300,301,302,303,304,305,400,401,402,420,421,422',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];


        DB::table('roles')->insert($insertData);
    }
}
