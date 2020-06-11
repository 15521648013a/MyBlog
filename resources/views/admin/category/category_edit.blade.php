
@include("public.admin.header")		
		<div class="container">
			<form action='../{{$category->category_id}}' method="POST">
			@csrf
			<input type="hidden" name="_method"  value="PATCH">
				<div class="form-group">
					<lable>
						分类名称
					</lable>
					<input type="text" name="name" id="name" value="<?php echo $category->category_name?>" class="form-control" placeholder="请输入分类名称" />
				</div>
				
				<div class="form-group">
					<lable>
						英文名称
					</lable>
					<input type="text" name="sug" value="<?php echo $category->category_sug?>" class="form-control" placeholder="请输入英文名称" />
				</div>
				<input type="submit" id="" name="" value="保存" class="btn btn-primary"/>
			</form>
		</div>
		
	</body>
	<script type="text/javascript">
	

		</script>
</html>
