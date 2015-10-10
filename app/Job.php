<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    						'job_number',
                            'company_name',
                            'title',
                            'sub_title',
                            'main_content',
                            'work_name', 
							'work_site', 
                            'work_format',
                            'work_day',	 
                            'work_require', 
                            'work_other', 
                            'work_other_second', 
                            'img_link',
                            'slug',
                            'closed',
                            'created_at',
                        ];
                            
//    $table->increments('id');
//            $table->integer('job_number');
//            $table->string('company_name');
//            $table->string('title');
//            $table->string('sub_title');
//            $table->string('first_comment');
//            $table->text('main_comment');
//            $table->string('sub_comment');
//            $table->timestamps();

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['job_number', ];
    
    
    public function jobentry() {
    	return $this->hasMany('App\Jobentry');
    }
    
}

