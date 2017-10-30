<?php

use Illuminate\Database\Seeder;

class CodeFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\CodeFile::class, 100)->create();
    }
}
