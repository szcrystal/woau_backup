<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studyentry extends Model
{
    protected $table = 'studyentries';

    protected $fillable = [
    						'user_id',
                            'user_name',
                            'user_mail',
                            'iroha_id',
                            'study_name',
                            'note',
                            //'attach_name',
                            //'attach_path',
                        ];
}

