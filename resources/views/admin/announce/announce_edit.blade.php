@include('public.admin.header')
		
		<div class="container">
			<form action='../{{$announce->announce_id}}' method="post">
			@csrf
			<input type="hidden" name="_method"  value="PATCH">
				<div class="form-group">
					<lable>
						输入文字
					</lable>
					<textarea  name="content" value="<?php echo $announce->announce_content?>" class="form-control" placeholder="请输入英文名称" ></textarea >
				</div>
				<input type="submit" id="" name="" value="保存" class="btn btn-primary"/>
			</form>
		</div>
		
	</body>
</html>
