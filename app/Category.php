<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //表
    protected $table ='category';
    //主键
    protected $primaryKey ="category_id";
    //查询文章种类
    function category(){
        return $this->hasOne("App\\Article",'article_category_id');
    }
   
}
