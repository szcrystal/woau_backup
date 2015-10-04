<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    
    protected $fillable = ['title', 'sub_title', 'intro_content', 'main_content', 'sub_content', 'url_name', 'img_link', 'slug', 'closed'];
    
}

