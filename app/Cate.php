<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $table = 'cates';
    
    protected $fillable = ['c_name', 'slug', 'group'];
    
    public function cateRelation() {
    	return $this->hasMany('App\CateRelation');
    }
    
}

