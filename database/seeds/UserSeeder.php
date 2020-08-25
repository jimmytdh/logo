<?php

use Illuminate\Database\Seeder;

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
                'level' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('@csmcpir2020')
            ]);

        DB::table('users')->insert([
            'level' => 'admin',
            'username' => 'root',
            'password' => bcrypt('@tdhit1010')
        ]);
    }
}
