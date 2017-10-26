<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueIndexToMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("message", function (Blueprint $table) {
            $table->unique(["resource_file_id", "message_key"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("message", function (Blueprint $table) {
            $table->dropUnique(["resource_file_id", "message_key"]);
        });
    }
}
