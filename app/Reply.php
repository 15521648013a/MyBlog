<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
     //表
     protected $table ='replys';
      //主键
      protected $primaryKey ="replys_id";
     protected $fillable = ['user_id','re_user_id','comments_id','content'];
     // 根据 user_id 获取用户名
    public function userName($userid='') {
        if($userid){
            return User::find($userid)->username; //这里通过当前对象的 user_id 获取 user对象， 然后指向->name属性
        }else
        return User::find($this->user_id)->username; //这里通过当前对象的 user_id 获取 user对象， 然后指向->name属性
    }
}
