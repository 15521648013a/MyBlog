<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Reply;
class Comment extends Model
{
    //主键
    protected $primaryKey ="comments_id";
    protected $fillable = [
        'content', 'user_id', 'article_id'
    ];
    // 根据 user_id 获取用户名
    public function userName() {
        return User::find($this->user_id)->username; //这里通过当前对象的 user_id 获取 user对象， 然后指向->name属性
    }
    // 绑定1:n关系
    public function replies() {
        return $this->hasMany('App\Reply','comments_id'); // 1 hasMany n
    }
}
