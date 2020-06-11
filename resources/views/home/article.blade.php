@include('public.head')
@include('user._login_register')
<section class="container">
  <div class="content-wrap">
    <div class="content">
      <header class="article-header">
        <h1 class="article-title"><?php echo $article->article_title?></h1>
        <div class="article-meta"> 
        <span class="item article-meta-time">
          <time class="time" data-toggle="tooltip" data-placement="bottom" title="时间：<?php echo $article->created_at?>"><i class="glyphicon glyphicon-time"></i> <?php echo $article->created_at?></time>
        </span>
        </div>
      </header>
      <article class="article-content">
        <p class="article_p">
        	<center>
          <img data-original="{{$article->article_thumb}}" src="/MyBlog/public/img/.{{$article->article_thumb}}" alt="" class="imgg" style="width:60%" ; />
        	</center>	
        </p>
        <?php echo $article->article_content?>
        <p class="article-copyright hidden-xs"><a href="">Sj博客</a> » <a href="{{$_SERVER['PHP_SELF']}}">{{$article->article_title}}</a></p>
      </article>
      
      <form method="POST" id="AddComment"  action="{{ route('comment.store') }}" >
        @csrf
        <input type="hidden" name="article_id" value="{{$article->article_id}}">
        <input type="hidden" name="user_id" value="{{session()->has('userid')?session()->has('userid'):''}}">
        <div class="form-group">
            <label for="content"></label>
            <textarea id="content" class="form-control" cols="30" rows="10" name="content" placeholder='您对这篇文章有什么看法呢？'></textarea>
        </div>
            <a class="btn  btn-primary" style="height:30px; margin-right:5px" name="" onclick="comment()">发表评论 </a>
            @if(!(session()->has('userid')))
            <a data-toggle="modal" data-target="#register" href=""> 注册</a>
            <a data-toggle="modal" data-target="#login" href=""> 登录</a>
            {{session('userid')}}
            @else
            用户:{{session('username')}}
            @endif
      </form>
      <h3>评论</h3>
      <ul id="comment_ul">
        <?php $k=0;?>
        @foreach ($comments as $comment)
        <article class="excerpt excerpt-2 " style="padding: 20px 20px 20px 25px">
          <li>
            <small >{{ $comment->userName() }} </small>评论说：
            <small style="float:right" > 
              @if(count($replies[$k]))
              <a onclick="zhe(this)"  > 折叠</a>
              <a onclick="zhan(this)" > 展开</a>
              @endif
              @if($comment->user_id== (isset($_SESSION['userid'])?$_SESSION['userid']:''))
               <!--显示删除-->
               <a onclick="commentDel('{{$comment->comments_id}}',this)"> 删除</a>
              @endif
              <a onclick="reply(this)" class="reply" > 回复</a>
              <input type="hidden" name="reuserid" value='{{$comment->user_id}}' >
              <input type="hidden" name="reusername" value='{{ $comment->userName()}}' >
              <input type="hidden" name="commentid" value='{{ $comment->comments_id }}' >
            </small>
          </li>
      		<p class="meta">
      			<time class="time"><i class="glyphicon glyphicon-time"></i>{{$comment->created_at}}</time>
      		<p class="note">“ {{ $comment->content }} ”</p>
          @foreach($replies[$k] as $reply)   
        
            <article class="excerpt excerpt-2 " style="padding: 20px 20px 20px 25px;display:none;"  >
             <li><small >{{ $reply->user_name }} </small>回复<small >{{ $reply->userName($reply->re_user_id)}} </small>：
             <small style="float:right" > 
             @if($reply->user_id== (isset($_SESSION['userid'])?$_SESSION['userid']:''))
             <!--显示删除-->
             <a onclick="replyDel('{{$reply->replys_id}}',this)"  > 删除</a>
             @endif
             <a onclick="_reply(this)" class="_reply" > 回复</a>
             <input type="hidden" name="userid" value='{{$reply->user_id}}' >
             <input type="hidden" name="reusername" value='{{ $reply->userName()}}' >
             </small></li>
      	    		<p class="meta">
      	    			<time class="time">
                    <i class="glyphicon glyphicon-time">
                    </i>{{$reply->created_at}}
                  </time>
      	    		<p class="note">“ {{ $reply->content }} ”</p>
      	    </article>
          @endforeach
          <?php $k++;?>
      	</article>    
        @endforeach         
      </ul>
      <nav class="pagination">
      {{ $comments->links() }}              
		  </nav>     
    </div>
  </div>

  <aside class="sidebar">
    <div class="fixed">
    @include("public.announce")
    </div>
  </aside>
</section>
<script>
  var reuserid='';
  var reusername='';
  // $(document).ready(function(){
  //   //鼠标悬停事件
  //   $(".excerpt").mouseover(function(){
  //     $(".reply").hide();
  //     $(this).find(".reply").show();
  //   });                                       
  //   // $("article").mouseout(function(){
  //   //   $("articlep").css("background-color","#E9E9E4");
  //   // });
  // });
  function cancel(obj){
    $(obj).text("回复").parents("article").find("textarea").remove();
    $(obj).parent().parent().parent("article").find(".btn").remove();
    $(obj).attr("onclick",'').click(eval(function(){reply(this)}));
  
  }
  function reply(obj){
    //弹出输入框
    $(obj).text("取消回复").attr("onclick",'').click(eval(function(){cancel(this)}));
    $(obj).parent().parent().parent("article").append('<textarea id="content" class="form-control" cols="30" rows="10" name="content" placeholder=\'您对这条评论有什么看法呢？\'></textarea>'
    +' <a class="btn  btn-primary release" style="height:30px; margin-right:5px" name="" onclick="release(this)">发表 </a>');
    reuserid=$(obj).next().val();//保存被回复人
    reusername=$(obj).next().next().val();//保存被回复人名
    // alert(reuserid);
  }
  function release(obj){
    //存入数据库中,回复
    $.ajax({
        type:'post',
        data:{'user_id':{{session()->has('userid')?session()->has('userid'):'0'}},
          're_user_id':reuserid,
          'comments_id':$(obj).parents("article").find("input[name='commentid']").val(),
          'content':$(obj).prev().val(),
          '_token':'{{csrf_token()}}' },
        url:"/MyBlog/public/reply",
        dataType:"json",
        success:function(data){
        }
      })
    var str ='<article class="excerpt excerpt-2 new" style="padding: 20px 20px 20px 25px">'+
      '<li>{{session()->has('username')?session()->has('username'):''}}<small>回复'+reusername+'：</small>'+
      '<small style="float:right" > <a onclick="_reply(this)" class="_reply"> 回复</a>'+
      '<input type="hidden" name="reuserid" value="<?=isset($_SESSION['username'])?$_SESSION['userid']:'';?>" >' +
      '<input type="hidden" name="reusername" value="<?=isset($_SESSION['username'])?$_SESSION['username']:'';?>" >' +
      '</small></li>'+
  		'<p class="meta">'+
  		'<time class="time"><i class="glyphicon glyphicon-time"></i></time>'+
  		'<p class="note">“ '+$(obj).prev().val()+' ”</p>'+
  		'</article>';
    $(obj).prev().remove();
    $(obj).parents("article").find(".reply").attr("onclick",'').click(eval(function(){reply(this)})).text("回复");
    $(obj).after(str);
    $(obj).remove();
  }
  //在评论下方回复另处理
  function _reply(obj){
    $(obj).text("取消回复").attr("onclick",'').click(eval(function(){_cancel(this)}));
    $(obj).parent().parent().parent().parent("article").append('<textarea id="content" class="form-control" cols="30" rows="10" name="content" placeholder=\'回复：\'></textarea>'
    +' <a class="btn  btn-primary release" style="height:30px; margin-right:5px" name="" onclick="_release(this)">发表 </a>');
    userid=$(obj).next().val();//保存被回复人id
    reusername=$(obj).next().next().val();//保存被回复人名
  }
  function _release(obj){
    alert("dsf");
    //存入数据库中
    $.ajax({
        type:'post',
        data:{'user_id':<?=isset($_SESSION['userid'])?$_SESSION['userid']:'0';?>,
              're_user_id':userid,
              'comments_id':$(obj).parents("article").find("input[name='commentid']").val(),
              'content':$(obj).prev().val(),
              '_token':'{{csrf_token()}}' },
        url:"/MyBlog/public/reply",
        dataType:"json",
        success:function(data){
        }
      })
    var str ='<article class="excerpt excerpt-2 new" style="padding: 20px 20px 20px 25px">'+
      '<li><small>{{session()->has('username')?session()->has('username'):''}}回复'+reusername+' ：</small>'+
      '<small style="float:right" > <a onclick="_reply(this)" class="_reply"> 回复</a>'+
      '<input type="hidden" name="reuserid" value="<?=isset($_SESSION['username'])?$_SESSION['userid']:'';?>" >' +
      '<input type="hidden" name="reusername" value="<?=isset($_SESSION['username'])?$_SESSION['username']:'';?>" >' +
      '</small></li>'+
  		'<p class="meta">'+
  		'<time class="time"><i class="glyphicon glyphicon-time"></i></time>'+
  		'<p class="note">“ '+$(obj).prev().val()+' ”</p>'+
  		'</article>';
    $(obj).prev().remove();
    $(obj).parents("article").find("._reply").attr("onclick",'').click(eval(function(){_reply(this)})).text("回复");
    $(obj).after(str);
    $(obj).remove();
  }
  function _cancel(obj){
    $(obj).text("回复").parents("article").find("textarea").remove();
    $(obj).parents("article").find(".btn").remove();
    $(obj).attr("onclick",'').click(eval(function(){_reply(this)}));
  }
  function comment(){
    @if(!session()->has('userid'))
     alert("请登录，再评论。");
     return false;
    @endif
    $("#AddComment").submit();
  }
  //折叠评论
  function zhe(obj){
    $(obj).parents("article").find("article").hide();
  }
  //展开评论
  function zhan(obj){
    $(obj).parents("article").find("article").show();
  }
  //删除评论
  function commentDel(id,obj){
    $(obj).parent().parent().parent("article").remove();
    $.ajax({
        type:'post',
        data:{'_token':'{{csrf_token()}}',_method:'DELETE' },
        url:"/MyBlog/public/comment/"+id,
        dataType:"json",
        success:function(data){
        }
  });
  }
  //删除回复
  function replyDel(id,obj)
  {  
    $(obj).parent().parent().parent("article").remove();
    $.ajax({
        type:'post',
        data:{'_token':'{{csrf_token()}}',_method:'DELETE' },
        url:"/MyBlog/public/reply/"+id,
        dataType:"json",
        success:function(data){
        }
  });
  }
</script>
@include("public.footer")