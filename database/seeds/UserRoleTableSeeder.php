<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert([
            'role' => 'Administrator',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('user_role')->insert([
            'role' => 'Tendik',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('user_role')->insert([
            'role' => 'Dosen',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('user_role')->insert([
            'role' => 'Mahasiswa',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('user_role')->insert([
            'role' => 'Alumni',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('user_role')->insert([
            'role' => 'Anonymous',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
