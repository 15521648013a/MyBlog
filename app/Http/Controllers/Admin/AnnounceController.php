<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Announce;
class AnnounceController extends Controller
{
    function index(){
        $announce = new Announce();
        $announces= $announce->paginate(10);
        //var_dump($announces[0]->announce_name);exit();
        return view("admin.announce.announce_list")->with("announces",$announces);
    }
    function create(){
       
        return view("admin.announce.announce_add");
    }
    function store(Request $request){
        $announce =(new Announce);
        $announce->announce_content = $request->content;
        $announce->save();
        return redirect('/admin/announce/');
    }
    function edit(Request $request){
        $announceId = $request->announce;
        $announce = Announce::find($announceId);
        return view("admin.announce.announce_edit")->with("announce",$announce);
    }
    function update(Request $request){
        $announce =(new Announce)::find($request->announce);
        $announce->announce_content=$request->content;
        $flag= $announce->save();
        return redirect('/admin/announce/');
    }
    //删除
   function destroy(Request $request){
    $announce = Announce::find($request->announce);
    $flag=$announce->delete();
    if($flag){
      //return redirect('/admin/article/')->with('info', '请先登录!');
      return json_encode(['flag'=>1]);
      //return redirect('/admin/announce/');
  }else{
      return json_encode(['flag'=>0]);
      //return redirect('/admin/announce/');
  }
 }
}
