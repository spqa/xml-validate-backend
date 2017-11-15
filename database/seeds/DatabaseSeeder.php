<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'=>'admin',
            'email'=>'admin',
            'password'=>bcrypt('admin')
        ]);
        $this->call(MessageSeeder::class);
        $this->call(CodeFileSeeder::class);
    }
}
