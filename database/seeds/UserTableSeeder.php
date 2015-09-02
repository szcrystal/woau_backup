<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ads',
            'email' => 'bonjour@frank.fam.cx',
            'password' => bcrypt('aaabbb'),
            'user_number' => 59999,
            'birth' => date('2014-03-15'),
            'address' => '東京都',
            'work_history' => '',
            'office_posi' => '',
            'is_trip' => '出張可能',
            'eng_ability' => '',
            'get_year' => 2010,
            'exp_type' => '',
            'audit_posi' => '',
            'other' => '',
            'admin' => 99,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        
        DB::table('users')->insert([
            'name' => 'opal',
            'email' => 'opal@frank.fam.cx',
            'password' => bcrypt('aaa111'),
            'user_number' => mt_rand(10000, 20000),
            'birth' => date('2014-03-15'),
            'address' => '東京都',
            'work_history' => '',
            'office_posi' => '',
            'is_trip' => '出張可能',
            'eng_ability' => '',
            'get_year' => 2010,
            'exp_type' => '',
            'audit_posi' => '',
            'other' => '',
            'admin' => 10,
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ]);
        
        /*
        DB::table('jobs')->insert([
            'company_name' => '株式会社セレクティ',
            'job_number' => '151515',
            'title' => '医療事務【資格を生かして働く♪ 勤務地多数あり★実務未経験OK】',
            'first_comment' => '“はたらく”の様々なこだわりに応えます！出産後のライフスタイルの変化にも柔軟にお応えしますので、お気軽にご相談ください♪',
            'main_comment' => '勤務地	首都圏、関西、東北エリアでお仕事をご紹介しています！',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        */
        DB::table('pages')->insert([
            'title' => '公認会計士のスキルを監査役として生かしたい',
            'sub_title' => 'woman x auditor',
            'intro_content' => '女性らしい生活がしたい。子育てに時間を取りたい。でも、公認会計士として積み上げたキャリアを無駄にしたくはない。',
            'main_content' => '①監査役に興味のある女性がwoman x auditorに登録します②woman x auditor上で、女性監査役を求めている会社を紹介します',
            'url_name' => '',
            'slug' => 'pages',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        
        DB::table('cates')->insert([
            'c_name' => '未分類',
            'slug' => 'no-class',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);
        
        
        
    }
}

