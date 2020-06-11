<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
class CategoryController extends Controller
{
    function index(){
        $category = new Category();
        $categores= $category->paginate(6);
        //var_dump($categores[0]->category_name);exit();
        return view("admin.category.category_list")->with("categores",$categores);
    }
    function create(){
       
        return view("admin.category.category_add");
    }
    function store(Request $request){
        $category =(new Category);
        $category->category_name = $request->name;
        $category->category_sug = $request->sug;
        $category->save();
        return redirect('/admin/category/');
    }
    function edit(Request $request){
        $categoryId = $request->category;;
        $category = Category::find($categoryId);
        return view("admin.category.category_edit")->with("category",$category);
    }
    function update(Request $request){
        $category =(new Category)::find($request->category);
        $category->category_sug=is_null($request->sug)?'':$request->sug;
        $category->category_name=$request->name;
        $flag= $category->save();
        return redirect('/admin/category/');
    }
    //删除
   function destroy(Request $request){
    $category = Category::find($request->category);
    $flag=$category->delete();
    if($flag){
      //return redirect('/admin/article/')->with('info', '请先登录!');
      return json_encode(['flag'=>1]);
  }else{
      return json_encode(['flag'=>0]);
  }
 }
}
