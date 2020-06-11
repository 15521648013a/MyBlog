
@include('public.admin.header')
		<div class="container" id="list">
			<!--<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>
			</div>-->
			<a href="announce/create" class="btn btn-success" style="margin-bottom: 10px;">
				添加公告
			</a>
			<table class="table table-bordered table-striped">
				<tr>
					<th>
						公告id
					</th>
					<th>
						公告内容
					</th>
					<th>
						公告发布/修改时间
					</th>
					<th>
						操作
					</th>
				</tr>
				<?php foreach($announces as $announce){ ?>
				<tr>
					<td>
						<?php echo $announce->announce_id;?>
					</td>
					<td>
						<?php echo $announce->announce_content;?>
					</td>
				    <td>
				    	<?php echo $announce->created_at?>
				    		
				    </td>
					<td>
						
					  
						<a href="<?php echo 'announce/'.$announce->announce_id."/edit" ?>" class="btn btn-primary btn-xs">
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
			{{$announces->links()}}
		   </div>
		</div>
	</body>
	<script type="text/javascript">
		$(".del").click(function(){

			var id = $(this).parent().siblings(":first").text();
			$.ajax({
				type:"POST",
				url:'announce/'+id,
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
