<?php

use Illuminate\Database\Migrations\Migration;

class ChangeCollationMessageKeyToUtf8bin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE `message` MODIFY `message_key` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_bin;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
