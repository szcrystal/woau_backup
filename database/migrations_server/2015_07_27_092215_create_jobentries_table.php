<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobentriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('jobentries', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('user_id')->nullable()->default(NULL);
            $table->string('user_name')->nullable()->default(NULL);
            $table->string('user_mail')->nullable()->default(NULL);
            $table->integer('job_id')->nullable()->default(NULL);
            $table->string('company_name')->nullable()->default(NULL);
            $table->text('note')->nullable()->default(NULL);
            $table->string('attach_name')->nullable()->default(NULL);
            $table->string('attach_path')->nullable()->default(NULL);
            
            $table->timestamps();
        });
        //['user_id', 'user_name', 'user_mail', 'job_id', 'company_name', 'note', 'attach_path'];
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobentries');
    }
}
