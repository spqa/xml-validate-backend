<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->string("ja", 255)->nullable(true);
            $table->string("vi", 255)->nullable(true);
            $table->string("en", 255)->nullable(true);
            $table->string("final", 255)->nullable(true);
            $table->boolean("applied")->default(false);
            $table->integer("code_file_id")->index()->nullable(true);
            $table->integer("resource_file_id")->index()->nullable(true);
            $table->string("message_key", 100)->nullable(false);
            $table->integer('updated_by')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message');
    }
}
