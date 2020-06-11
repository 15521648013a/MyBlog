<!DOCTYPE HTML>
<html>
	<head>
		<title>管理员登录</title>
	</head>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<style type="text/css">
		.b1{
			width: 40%;
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);
			padding: 10px;
		}
	</style>
	<body>
		<div class="container">
			<div class="container b1">
				<form method="post" action="./_add">
                @csrf
					<h3 class="text-center">登录</h3>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-user"></span>
							</div>
							<input type="text" class="form-control" name="username">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<span class="glyphicon glyphicon-lock"></span>
							</div>
							<input type="password" class="form-control" name="password">
						</div>
					</div>
					<input type="submit" name="" id="" value=" 登录 " class="btn btn-primary" />
					
				</form>
			</div>
		</div>
	</body>
</html>