@include('public.head')
		<section class="container">
			<div class="content-wrap">
				<div class="content">
					<div class="jumbotron">
						<h1>欢迎访问Sj博客</h1>
						<p>在这里可以看到我发表的文章。</p>
					</div>
					<div id="focusslide" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#focusslide" data-slide-to="0" class="active"></li>
							<li data-target="#focusslide" data-slide-to="1"></li>
							<li data-target="#focusslide" data-slide-to="2"></li>
						</ol>
						<div class="carousel-inner" role="listbox">
							
							<div class="item active">
								<a href="" target="_blank"><img src="/MyBlog/public/img/banner/banner_01.jpg" alt="" class="img-responsive"></a>
								
							</div>
							<div class="item">
								<a href="" target="_blank"><img src="/MyBlog/public/img/banner/banner_02.jpg" alt="" class="img-responsive"></a>
								
							</div>
							<div class="item">
								<a href="" target="_blank"><img src="/MyBlog/public/img/banner/banner_03.jpg" alt="" class="img-responsive"></a>
								
							</div>
						</div>
							
						<a class="left carousel-control" href="#focusslide" role="button" data-slide="prev" rel="nofollow"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">上一个</span> </a>
						<a class="right carousel-control" href="#focusslide" role="button" data-slide="next" rel="nofollow"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">下一个</span> </a>
					</div>

					<div class="title">
						<h3>最新发布</h3>
					</div>
                   
					@foreach($articles as $article)
					<article class="excerpt excerpt-2">
						<a class="focus" href="/MyBlog/public/articleShow/{{$article->article_id}} ?>" title="">
                        <img class="thumb" data-original="/MyBlog/public{{$article->article_thumb}}" src="/MyBlog/public/{{$article->article_thumb}}" alt=""></a>
						<header>
                            <h2><a href="/MyBlog/public/articleShow/{{$article->article_id}}" title="">{{$article->article_title}}</a></h2>
						</header>
						<p class="meta">
							<time class="time"><i class="glyphicon glyphicon-time"></i><{{$article->created_at}}</time>
							<p class="note"><?php echo ($article->article_content)?></p>
					</article>
					@endforeach
 
			
			      <nav class="pagination">
                 {{ $articles->links()}}
			      </nav> 
				</div>
			</div>
			<aside class="sidebar">
				<div class="fixed">
				@include("public.announce")
					<div class="widget widget_search">
						<form class="navbar-form" action="/MyBlog/public/" method="get">
					
							<div class="input-group">
								<input type="text" name="keyword" class="form-control" size="35" placeholder="请输入关键字" maxlength="15" autocomplete="off">
								<span class="input-group-btn">
                                   <button class="btn btn-default btn-search"  type="submit">搜索</button>
                                </span> 
			                </div> 
			                 最多点击
			                <ul>
			                  @foreach(json_decode($lists) as $list)
			                  	<li ><a href="/MyBlog/public/articleShow/{{$list->article_id}}" > {{$list->article_title}}</a></li>
			                  @endforeach
		                  
			                </ul>
			            </form>
				    </div>
				</div>
			</aside>
		</section>
@include("public.footer")