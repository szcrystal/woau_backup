<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cate_relations', function (Blueprint $table) {
            $table->integer('blog_id')->nullable()->default(NULL);
            $table->integer('cate_id')->nullable()->default(NULL);
            //$table->integer('cate_order')->nullable()->default(NULL);
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
        Schema::drop('cate_relations');
    }
}
