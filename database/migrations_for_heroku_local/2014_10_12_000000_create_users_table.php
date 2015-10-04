<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            
            $table->integer('user_number')->nullable()->default(NULL);
            $table->date('birth')->nullable()->default(NULL);
            $table->string('address')->nullable()->default(NULL);
            $table->string('work_history')->nullable()->default(NULL);
			$table->string('office_posi')->nullable()->default(NULL);
            $table->string('is_trip')->nullable()->default(NULL);
            $table->string('eng_ability')->nullable()->default(NULL);
            $table->integer('get_year')->nullable()->default(NULL);
            $table->string('exp_type')->nullable()->default(NULL);
            $table->string('audit_posi')->nullable()->default(NULL);
            $table->text('other')->nullable()->default(NULL);
            
            $table->integer('admin');
            $table->rememberToken();
            $table->timestamps();
        });
        
    }
    
//            'address',
//            'work_history',
//            'office_posi',
//            'is_trip',
//            'eng_ability',
//            'get_year',
//            'exp_type',
//            'audit_posi',
//            'other',
    
    /*
    	名前*、メールアドレス*、パスワード*、
        生年月日*、
        所在地*、職歴、役職、子供の有無、子供の年齢、出張の可否、英語能力、
        公認会計士資格取得年、過去の経験監査業種、監査時のポジション、その他（*は必須）
    
    */
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
