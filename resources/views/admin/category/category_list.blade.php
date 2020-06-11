@include('public.admin.header')

		<div class="container" id="list">
			<!--<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>隔壁老王在搖一搖，请看好自己的老婆！
			</div>-->
			<a href="category/create" class="btn btn-success" style="margin-bottom: 10px;">
				添加分类
			</a>
			<table class="table table-bordered table-striped">
				<tr>
					<th>
						分类id
					</th>
					<th>
						分类名称
					</th>
					<th>
						分类英文名称
					</th>
					<th>
						操作
					</th>
				</tr>
				<?php foreach($categores as $category){ ?>
				<tr>
					<td>
						<?php echo $category->category_id;?>
					</td>
					<td>
						<?php echo $category->category_name;?>
					</td>
					<td>
						<?php echo $category->category_sug;?>
					</td>
					<td>
						<a href="category/<?php echo $category->category_id?>/edit" class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil">
							</span>
						</a>
						<a class="btn btn-danger btn-xs del">
							<span class="glyphicon glyphicon-trash">
							</span>
						</a>
					</td>
				</tr>
				<?php }?>
				
			</table>
			<div style="text-align:center;"> 
			{{$categores->links()}}
		   </div>
		</div>
	</body>
	<script type="text/javascript">
		$(".del").click(function(){

			var id = $(this).parent().siblings(":first").text();
			$.ajax({
				type:"POST",
				url:'category/'+id,
				data:{_method:'DELETE','_token':'{{csrf_token()}}'  },
				dataType:"json",
				success:function(data){
					if(data.flag){
						alert("删除成功！");
						//刷新页面
					
					}else{
						alert("删除失败！");
					}

				}
			})
			
		});

		</script>
</html>
