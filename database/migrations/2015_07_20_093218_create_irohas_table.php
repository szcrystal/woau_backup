<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIrohasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irohas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default(NULL);
            $table->string('sub_title')->nullable()->default(NULL);
            $table->text('intro_content')->nullable()->default(NULL);
            $table->text('main_content')->nullable()->default(NULL);
            $table->text('sub_content')->nullable()->default(NULL);
            $table->string('url_name')->nullable()->default(NULL);
            $table->string('img_link')->nullable()->default(NULL);
            $table->string('slug')->nullable()->default(NULL);
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
        Schema::drop('irohas');
    }
}
