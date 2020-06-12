<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" href="/MyBlog/public/css/bootstrap.css" />
		<script type="text/javascript" src="{{ asset('js/jquery.js')}}" ></script>
		<script type="text/javascript" src="{{ asset('js/bootstrap.js')}}" ></script>
		<script type="text/javascript" src="{{ asset('js/jquery.validation/1.14.0/jquery.validate.js')}}" charset="UTF-8"></script>
		<script type="text/javascript" src="{{ asset('js/jquery.validation/1.14.0/messages_zh.js')}}" charset="UTF-8"></script>
		<style>
			#list th,#list tf{
				vertical-align:middle;
			}
			#list img{
				max-height: 30px;
			}
			body{
				padding-top: 70px;
			}
		</style>
	</head>
	<body>
	@include('components._message')
		<nav class="nav navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{asset('')}}" style="padding-top: 10px;"><img src="{{asset('img/timg.jpg')}}" class="img-circle" style="max-height: 35px;"/></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
					    <li><a href="/MyBlog/public/admin/user">
								用户
							</a>
						</li>
						<li><a href="{{asset('admin/category')}}">文章分类</a></li>
						<li><a href="{{asset('admin/article')}}">文章</a></li>
						<li><a href="{{asset('admin/announce')}}">
								公告
							</a></li>
						
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle='dropdown'>
								{{session("username")}}
								<span class="caret"></span></a>
							<ul class="dropdown-menu">
									<li><a href="register.php">注册</a></li>
								<li><a href="{{asset('loginOut')}}">退出</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>