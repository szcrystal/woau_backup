<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->default(NULL);
            $table->string('sub_title')->nullable()->default(NULL);
            $table->text('intro_content')->nullable()->default(NULL);
            $table->text('main_content')->nullable()->default(NULL);
            $table->text('sub_content')->nullable()->default(NULL);
            $table->string('url_name')->nullable()->default(NULL);
            $table->string('img_link')->nullable()->default(NULL);
            $table->string('slug')->nullable()->default(NULL);
            $table->string('closed')->nullable()->default('公開中');
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
        Schema::drop('pages');
    }

}
