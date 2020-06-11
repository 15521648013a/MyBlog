
@include('public.admin.header')
		<div class="container" id="list">
			<!--<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>
			</div>-->
			<a href="user/create" class="btn btn-success" style="margin-bottom: 10px;">
				添加用户
			</a>
			<table class="table table-bordered table-striped">
				<tr>
					<th>
						用户id
					</th>
					<th>
						用户名
					</th>
					<th>
						角色
					</th>
					<th>
						创建时间
					</th>
					<th>
						操作
					</th>
				</tr>
				<?php foreach($users as $user){ ?>
				<tr>
					<td>
						<?php echo $user->userid;?>
					</td>
					<td>
						<?php echo $user->username;?>
					</td>
				    <td>
				    	<?php echo $user->role?>
				    		
				    </td>
					<td>
				    	<?php echo $user->created_at?>
				    		
				    </td>
					<td>
						
					  
						<a href="<?php echo 'user/'.$user->userid."/edit" ?>" class="btn btn-primary btn-xs">
							<span class="glyphicon glyphicon-pencil">
							</span>
						</a>
						<a  class="del btn btn-danger btn-xs">
							<span class="glyphicon glyphicon-trash">
							</span>
						</a>
					</td>
				</tr>
				<?php }?>
				
			</table>
			<div style="text-align:center;"> 
			{{$users->links()}}
		   </div>
		</div>
	</body>
	<script type="text/javascript">
		$(".del").click(function(){

			var id = $(this).parent().siblings(":first").text();
			$.ajax({
				type:"POST",
				url:'user/'+id,
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
