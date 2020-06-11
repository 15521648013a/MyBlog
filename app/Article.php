<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{    //表
    protected $table ='article';
    //主键
    protected $primaryKey ="article_id";
   
    //查询文章种类
    // function category(){
    //     return $this->hasOne("App\\Category",'article_category_id');
    // }
    public function category()
    {
        return $this->belongsTo('App\Category','article_category_id');
    }
    //1.table1->hasOne(table2,foreignKey): select * from table2 where table2.foreignKey=table1.primayKey
    //作用：查找table2的行 table2有个属性来自与table1
    //2.table1->belongsTo(table2,foreignKey): select * from table2 where table1.foreignKey=table2.primayKey
    //作用：查找table2的行 table1有个属性来自与table2
    // 绑定1:n关系
    public function comments() {
        return $this->hasMany('App\Comment','article_id'); // 1 hasMany n
    }
}
