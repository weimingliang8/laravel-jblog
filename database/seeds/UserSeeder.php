<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 正常填充
//        User::create([
//            'name' => 'list5',
//            'email' => 'list5@qq.com',
//            'password' => bcrypt('admin888')
//        ]);

        // 使用模型工厂填充
        factory(User::class, 300)->create();

        $user = User::findOrFail(1);
        $user->name = '魏明亮';
        $user->email = 'weimingliang8@163.com';
        $user->password = bcrypt('admin888');
        $user->is_admin = true;
        $user->save();

        $user = User::findOrFail(2);
        $user->name = '魏明亮2';
        $user->email = 'weimingliang2@163.com';
        $user->password = bcrypt('admin888');
        $user->save();
    }
}
