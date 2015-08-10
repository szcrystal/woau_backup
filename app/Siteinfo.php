<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siteinfo extends Model
{
    protected $table = 'siteinfos';
    
    protected $fillable = [
    	'site_name',
        'site_description',
        'site_email',
        'top_id', 
        'show_count',
        'seo_sw',
        'mail_contact',
        'mail_register',
        'mail_jobentry',
        'mail_studyentry',
        'mail_footer',
        ];
}

