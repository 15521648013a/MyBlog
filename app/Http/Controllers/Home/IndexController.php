<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Article;
use App\User;
use App\Category;
use App\Announce;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    //
    function index(Request $request ,$page=1){
        // var_dump( $request->input("page"));
        // //查询文章
        //高频文章
        $keyword = $request->keyword;
        if($keyword){
            $lists =  Article::where("article_title",'like',"%".$keyword."%")->take(5)->get();
        }else{
            $lists = Redis::get('name');
        }
        $articles=DB::table('article')->paginate(3);
        $pages=(int)(count($articles)/3)+1;
        $categories=DB::table('category')->get();
        $announce = Announce::orderBy("created_at","desc")->first()->announce_content;
        return view("home.index")->with("articles",$articles)
        ->with("pages",$pages)
        ->with("page",$page)
        ->with("lists",$lists)
        ->with("categories",$categories)
        ->with("announce",$announce);
       
       
    }
    function login(){
       //如果已经登录，直接跳转到后台
       if(isset($_SESSION['userid'])){
           if($_SESSION['role']==1)
        return redirect('admin/article');  
        else  return redirect('/index');  
       }else
       return view("home.login");
       
    }
    //验证登录
    function check(Request $request){
        $username=$request->input("username");
        $password=$request->input("password");
        $flag=User::where('username',$username)->where("password",$password)->first();
        if($flag ){
            session(['userid' => $flag->userid]);
            session(['role' => $flag->role]);
            session(['username' => $flag->username]);
          if($flag->role==1){
            return redirect('admin/article');  
          // return view("admin.admin_index")->with("rows",$articles); 
        }
           else{
               //普通用户登录，跳转前台
               return view("user.login_register");
           }
        }else{
            //
            echo "密码错误";
        }
    }
    //普通用户登录
    function userCheck(Request $request){
        if(isset($_SESSION['userid'])){
          //  echo "sdfds";
            ///return back();
        }
        $username=$request->input("username");
        $password=$request->input("password");
        $flag=User::where('username',$username)->where("password",$password)->first();
        if($flag ){
           // echo "dsf";
               $_SESSION['userid']=$flag->userid;
               $_SESSION['role']=$flag->role;
               $_SESSION['username']=$flag->username;
              // return back();
                 return json_encode(['msg'=>"dsf"]);
        }else{
            //
            echo "密码错误er";
        }

    }
    //退出登录
    function loginOut(){
        session()->forget('userid');
        session()->forget('username');
        session()->forget('role');
        //跳转到前台
        return redirect('/');
    }
    //根据文章分类列出文章列表
   function articleByCategory(Request $request,$page=1){
    $keyword = $request->keyword;
    if($keyword){
        $lists =  Article::where("article_title",'like',"%".$keyword."%")->take(5)->get();
    }else{
        $lists = Redis::get('name');
    }
       $category = $request->category;//get参数
      
       $articles=Article::where('article_category_id', $category)->paginate(3);
       $page=$request->page;
       $pages=(int)(count(Article::where('article_category_id', $category)->get())/3)+1;
        $categories=Category::get();
        $announce = Announce::orderBy("created_at","desc")->first()->announce_content;
        return view("home.index")->with("articles",$articles)
        ->with("pages",$pages)
        ->with("page",$page)
        ->with("lists",$lists)
        ->with("categories",$categories)
        ->with("category",$category)
        ->with("announce",$announce);
        
   }
    //前台显示文章详情
    function article(Request $request, $page=1){
        $articleId = $request->id;
        $categories=DB::table('category')->get();
        $article=Article::where("article_id",$articleId)->first();
        $count= count($comments = $article->comments);
        $pages = ceil($count/5);//向上取整;
        $page=$request->get('page');//当前页
        $comments = $article->comments()->paginate(5);//获取该文章的评论，每页5条
        //获取每一条评论下的回复，一条评论有多条回复
        $replies=[];
        foreach($comments as $k=>$comment){
            $replies[$k]= $comment->replies;
            foreach($replies[$k] as $reply){
                $reply->user_name = $reply->userName();
             }
        }
        //文章浏览次数加一
        $article->use_count = $article->use_count+1;
        $article->save();
        //更新redis，存入浏览最频繁的3条
        Redis::set('name', Article::orderBy("use_count",'desc')->take(5)->get()); 
        $announce = Announce::orderBy("created_at","desc")->first()->announce_content;
        return view("home.article",[
            'article'=>$article,
            'categories'=>$categories,
            'comments'=>$comments,
            'replies'=>$replies,
            'pages'=>$pages,
            'page'=>$page,//当前页数，默认为一
            'announce'=>$announce
        ]); 
    }
    //前台显示文章详情
    function _articleComment(Request $request, $page=1){
        $articleId = $request->id;
        $categories=DB::table('category')->get();
        $article=Article::where("article_id",$articleId)->first();
        $count= count($comments = $article->comments);
        $pages = ceil($count/5);//向上取整;
        $page=$request->get('page');//当前页
        $comments = $article->comments()->paginate(5);//获取该文章的评论，每页5条
        //获取每一条评论下的回复，一条评论有多条回复
        $replies=[];
        foreach($comments as $k=>$comment){
            $replies[$k]= $comment->replies;
            foreach($replies[$k] as $reply){
                $reply->user_name = $reply->userName();
             }
        }
        
        return view("home.comment",[
            
            'comments'=>$comments,
            'replies'=>$replies,
            'pages'=>$pages,
            'page'=>1//当前页数，默认为一
        ]); 
    }
    
}
