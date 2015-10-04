<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_number');
            $table->string('company_name')->nullable()->default(NULL);
            $table->string('title')->nullable()->default(NULL);
            $table->string('sub_title')->nullable()->default(NULL);
            $table->text('first_comment')->nullable()->default(NULL);
            $table->text('main_comment')->nullable()->default(NULL);
            $table->string('sub_comment')->nullable()->default(NULL);
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
        Schema::drop('jobs');
    }
}

