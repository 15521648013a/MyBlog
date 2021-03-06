@include('public.admin.header')
<div class="container" id="list">
			<div class="alert alert-warning alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>xxxxxxx！
			</div>
			<table class="table table-bordered table-striped">
				<a href="article/createView" class="btn btn-success" style="margin-bottom: 10px;">添加文章</a>
				<tr>
					<th>文章id</th>
					<th><span class="glyphicon glyphicon-picture" aria-hidden='true'></span></th>
					<th>文章标题</th>
					<th>文章分类</th>
					<th>文章发布时间</th>
					<th>操作</th>
				</tr>
				<?php foreach($rows as $row){ ?>
				<tr>
					<td><?php echo $row->article_id?></td>
					<td><img src=".<?php echo $row->article_thumb?>" class="img-rounded"/></td>
					<td><?php echo $row->article_title?></td>
					<td><?php echo $row->article_category?></td>
					<td><?php echo$row->created_at?></td>
					<td>
						<a href="article/<?php echo $row->article_id?>/edit" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
						<a   class="del btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
		<script type="text/javascript">
		$(".del").click(function(){

			var id = $(this).parent('td').siblings(":first").text();
			//alert(id);
			$.ajax({
				type:"POST",
				url:'article/'+id,
				data:{_method:'DELETE','_token':'{{csrf_token()}}'  },
				dataType:"json",
				success:function(data){
					if(data.flag){
						alert("删除成功！");
						//刷新页面
						$(this).parents('tr').remove();
					}else{
						alert("删除失败！");
					}

				}
			})
			
		});

		</script>
@include('public.admin.footer')