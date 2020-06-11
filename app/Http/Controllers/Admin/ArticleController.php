<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;
use App\Comment;
use App\Reply;
use Illuminate\Support\Facades\Redis;
class ArticleController extends Controller
{   
    //展示文章详情
    function index($page=1,$limit=4){
        $article = new Article();
        $articles=$article->paginate(5);;
        foreach($articles as &$value)
        $value['article_category'] =($article->find($value['article_id'])->category)->category_name;
        return view("admin.article.article_list")->with("rows",$articles)->with("page",$page); 
    }
    //添加页面
    function createView(){
        //文章分类
        $article_categories=\App\Category::get(); 
        return view("admin.article.article_add")->with("article_categories",$article_categories);
    }
    //添加到数据库中
    function create(Request $request){
        $article =new Article;
        $article->article_title=$request->input('title');
        $article->article_category_id=$request->input('article_category_id'); 
        $article->article_thumb=$request->input('thumb'); 
        $article->article_content=$request->input('content'); 
        $article->save();
        return redirect('/admin/article/');
    }
    //图片上传
    function upLoadFile(){
    $filesName = $_FILES['file']['name'];  
	$filesTmpName = $_FILES['file']['tmp_name'];  
	$filePath = "./img/".date("Ymd",time()).rand(1,50).$filesName; 
	//$file = basename($_POST['file']);  
	while(file_exists($filePath))
	{$filePath = "./img/".date("Ymd",time()).rand(1,50).$filesName;}

     move_uploaded_file($filesTmpName, $filePath);
	
     return  json_encode(["filePath"=>$filePath]) ;
   }
   //编辑文章
   function edit(Request $request){
       $articleId= $request->article;//传递参数文章id
       $article = Article::find($articleId);
       return view("admin.article.article_edit")->with("article",$article)
       ->with('article_categories',Category::get());
   }
   //更新
   function saveEdit(Request $request){
    $article =(new Article)::find($request->article);
    $article->article_id=$request->article;
    $article->article_title=$request->input('title');
    $article->article_category_id=$request->input('article_category_id'); 
    $article->article_thumb=$request->input('thumb'); 
    $article->article_content=$request->input('content'); 
    //$flight = App\Flight::find(1);
    $flag= $article->save();
    if($flag){
        return redirect('/admin/article/')->with('info', '请先登录!');
       // return json_encode(['flag'=>1]);
    }else{
        echo "<script>alert('更新失败');</script>";
        return redirect()->back();
    }
   }
   //删除
   function destroy(Request $request){
      $article = Article::find($request->article);
      //删除文章下的评论
      $comments = Comment::where("article_id",$request->article)->get();
      foreach($comments as $comment){
        $commentsId=$comment->comments_id;
        $replies = Reply::where("comments_id",$commentsId)->get();
        foreach($replies as $reply){
            $reply->delete();
        }
        $comment->delete();
      }
      $flag=$article->delete();
      if($flag){
        return json_encode(['flag'=>1]);
    }else{
        return json_encode(['flag'=>0]);
    }
   }
   
}
