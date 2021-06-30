<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'admin',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Guru1',
                'username' => 'guru1',
                'password' => bcrypt('guru1'),
                'role' => 'guru',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Guru2',
                'username' => 'guru2',
                'password' => bcrypt('guru2'),
                'role' => 'guru',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Guru3',
                'username' => 'guru3',
                'password' => bcrypt('guru3'),
                'role' => 'guru',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Guru4',
                'username' => 'guru4',
                'password' => bcrypt('guru4'),
                'role' => 'guru',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ],
            [
                'nama' => 'Guru5',
                'username' => 'guru5',
                'password' => bcrypt('guru5'),
                'role' => 'guru',
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ]
        ]);
    }
}
