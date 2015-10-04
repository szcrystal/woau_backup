<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnClosed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function ($table) {
            $table->string('closed')->nullable()->default('公開中');
        });
        
        Schema::table('pages', function ($table) {
            $table->string('closed')->nullable()->default('公開中');
        });
        
        Schema::table('blogs', function ($table) {
            $table->string('closed')->nullable()->default('公開中');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function ($table) {
            $table->dropColumn('closed');
        });
        
        Schema::table('pages', function ($table) {
            $table->dropColumn('closed');
        });
        
        Schema::table('blogs', function ($table) {
            $table->dropColumn('closed');
        });
    }
}

