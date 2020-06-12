<!doctype html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sj</title>
		<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
		<!-- <link rel="stylesheet" type="text/css" href="/MyBlog/public/css/nprogress.css"> -->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css')}}">
		<link rel="apple-touch-icon-precomposed" href="{{ asset('img/icon/icon.png')}}">
		<link rel="shortcut icon" href="{{ asset('img/icon/favicon.ico')}}">
		<script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
		<!-- <script src="js/nprogress.js"></script> -->
		<!-- <script src="js/jquery.lazyload.min.js"></script> -->
		<!--[if gte IE 9]>
  <script src="{{ asset('js/jquery-1.11.1.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/html5shiv.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/respond.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/selectivizr-min.js')}}" type="text/javascript"></script>
<![endif]-->
		<!--[if lt IE 9]>
  <script>window.location.href='upgrade-browser.html';</script>
<![endif]-->
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js/jquery.ias.js')}}"></script>
	</head>
	<body class="user-select">
		<header class="header">
			<nav class="navbar navbar-default" id="navbar">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
						<h1 class="logo hvr-bounce-in"><a href="{{ asset('admin/article')}}" title=""><img src="{{asset('img/timg.jpg')}}" alt="" style="height: 60px;"></a></h1>						
					</div>
					<div class="collapse navbar-collapse" id="header-navbar">
						<ul class="nav navbar-nav navbar-right">
							<li class="hidden-index {{isset($category)?'':'active'}} ">
								<a data-cont="Sj" href="{{ asset('')}}">首页</a>
							</li>
							<?php $cat=isset($category)?$category:'';?>
                            @foreach ($categories as $category)
		 					<li class="{{$cat==$category->category_id ?'active':''}}">
		                        <a href="{{ asset('articleCategory')}}/{{$category->category_id}}">{{$category->category_name}}</a>
							</li>
							@endforeach
							<li class="dropdown">
							    <a href="#" class="dropdown-toggle" data-toggle='dropdown'>
							    	{{session('username')}}
							    	<span class="caret"></span></a>
							    <ul class="dropdown-menu">
								    <li><a href="{{ asset('login')}}">登录</li>
							    	<li><a href="register.php">注册</a></li>
							    	<li><a href="{{ asset('loginOut')}}">退出</a></li>
							    </ul>
						    </li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
