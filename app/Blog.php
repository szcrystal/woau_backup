<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    
    protected $fillable = [
	    'title',
        'sub_title',
        'intro_content',
        'main_content',
        'sub_content',
        'url_name',
        'img_link',
        'category',
        'slug',
        'closed',
        'created_at',
        ];
    

	public function cateRelation() {
    	return $this->hasMany('App\CateRelation');
    }
    
}

