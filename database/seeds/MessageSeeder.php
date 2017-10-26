<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        \App\CodeFile::create([
//            'name'=>'menu.jsp'
//        ]);
//
//        \App\ResourceFile::create([
//            'name'=>'Menu.xml'
//        ]);
//
//        \App\Message::create([
//            'ja'=>'ブランディング',
//            'vi'=>'Xây dựng thương hiệu (branding)',
//            'en'=>'Branding',
//            'final'=>'Branding',
//            'resource_file_id'=>1,
//            'code_file_id'=>1,
//            'message_key'=>'menu.branding'
//        ]);

        factory(\App\Message::class, 100)->create();
    }
}
