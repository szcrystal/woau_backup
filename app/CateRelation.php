<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CateRelation extends Model
{
    protected $table = 'cate_relations';
    
    protected $fillable = ['blog_id', 'cate_id'];
    
    
//    public function blogs()
//    {
//        return $this->hasMany('App\Blog');
//    }
    
}

