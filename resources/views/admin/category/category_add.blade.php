@include('public.admin.header')

		<div class="container">
			<form class="" action ='../category' method="post">
			@csrf
				<div class="form-group">
					<lable>
						分类名称
					</lable>
					<input type="text" name="name" id="name" value="" class="form-control" placeholder="请输入分类名称" />
				</div>

				<div class="form-group">
					<lable>
						英文名称
					</lable>
					<input type="text" name="sug" value="" class="form-control" placeholder="请输入英文名称" />
				</div>
				<input type="submit" id="" name="" value="创建" class="btn btn-primary" />
			</form>
		</div>

	</body>

</html>