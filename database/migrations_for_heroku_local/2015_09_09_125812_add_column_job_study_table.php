<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnJobStudyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs', function ($table) {
            $table->string('closed')->nullable()->default('公開中');
        });
        
        Schema::table('irohas', function ($table) {
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
        Schema::table('jobs', function ($table) {
            $table->dropColumn('closed');
        });
        
        Schema::table('irohas', function ($table) {
            $table->dropColumn('closed');
        });
    }
}

