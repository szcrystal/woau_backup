<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->nullable()->default(NULL);
            $table->string('site_description')->nullable()->default(NULL);
            $table->string('site_email')->nullable()->default(NULL);
            $table->integer('top_id')->nullable()->default(NULL);
            $table->integer('show_count')->nullable()->default(NULL);
            $table->boolean('seo_sw')->nullable()->default(NULL);
            $table->text('mail_contact')->nullable()->default(NULL);
            $table->text('mail_register')->nullable()->default(NULL);
            $table->text('mail_jobentry')->nullable()->default(NULL);
            $table->text('mail_studyentry')->nullable()->default(NULL);
            $table->text('mail_footer')->nullable()->default(NULL);
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
        Schema::drop('siteinfos');
    }
    
}

