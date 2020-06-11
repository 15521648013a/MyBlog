@include('public.admin.header')

		<div class="container">
			<form class="" action ="../announce"method="post">
				@csrf

				<div class="form-group">
					<lable>
						公告内容
					</lable>
					<input type="text" name="content" value="" class="form-control" placeholder="请输入公告" />
				</div>
				<input type="submit" id="" name="" value="创建" class="btn btn-primary" />
			</form>
		</div>

	</body>

</html>