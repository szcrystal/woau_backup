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
            
            $table->text('main_content')->nullable()->default(NULL);
            
            $table->string('work_name')->nullable()->default(NULL);
            $table->string('work_site')->nullable()->default(NULL);
            $table->string('work_format')->nullable()->default(NULL);
            $table->string('work_day')->nullable()->default(NULL);
            $table->text('work_require')->nullable()->default(NULL);
            $table->text('work_other')->nullable()->default(NULL);
            $table->text('work_other_second')->nullable()->default(NULL);
            
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
        Schema::drop('jobs');
    }
}

