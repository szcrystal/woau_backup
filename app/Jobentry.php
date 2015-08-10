<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobentry extends Model
{
    protected $table = 'jobentries';

    protected $fillable = [
    						'user_id',
                            'user_name',
                            'user_mail',
                            'job_id',
                            'company_name',
                            'note',
                            'attach_name',
                            'attach_path',
                        ];
    //['user_id', 'user_name', 'user_mail', 'job_id', 'company_name', 'note', 'attach_path'];                     

    //protected $hidden = ['job_number', ];
}


