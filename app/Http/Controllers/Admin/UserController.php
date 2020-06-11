<?php
namespace app\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController 
{
  function index(){
    $user = new User();
    $users= $user->paginate(5);;
    //var_dump($users[0]->user_name);exit();
    return view("admin.user.user_list")->with("users",$users);
}
function create(){
   
    return view("admin.user.user_add");
}
function store(Request $request){
    $user =(new User);
    $user->username = $request->username;
    $user->password = $request->password;
    $user->role = $request->role;
    $user->save();
    session()->flash('success', '删除文章成功！'); //装载session闪存
    return redirect('/admin/user/');
}
function edit(Request $request){
    $userId = $request->user;
    $user = User::find($userId);
    return view("admin.user.user_edit")->with("user",$user);
}
function update(Request $request){
    $user =(new User)::find($request->user);
    $user->username=$request->username;
    $user->password=$request->password;
    $user->role=$request->role;
    $flag= $user->save();
    return redirect('/admin/user/');
}
//删除
function destroy(Request $request){
$user = User::find($request->user);
$flag=$user->delete();
if($flag){
  //return redirect('/admin/article/')->with('info', '请先登录!');
  return json_encode(['flag'=>1]);
  //return redirect('/admin/user/');
}else{
  return json_encode(['flag'=>0]);
  //return redirect('/admin/user/');
}
}
}
