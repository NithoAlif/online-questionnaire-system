<?php

use Illuminate\Database\Seeder;

class UserListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_list')->insert([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'first_name' => 'admin',
            'last_name' => '123',
            'role_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

    }
}
