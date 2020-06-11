@include('public.admin.header')

		<div class="container">
			<form  method="post" action="../user" id="form-user-add">
				@csrf

				<div class="form-group">
					<lable>
						用户名
					</lable>
					<input type="text" name="username" value="" class="form-control" placeholder="请输入用户" />
				</div>
				<div class="form-group">
					<lable>
						密码
					</lable>
					<input type="text" name="password" id="password" value="" class="form-control" placeholder="请输入密码" />
				</div>
				<div class="form-group">
					<lable>
						确认密码
					</lable>
					<input type="text" name="password1" value="" class="form-control" placeholder="请输入密码" />
				</div>
				<div class="form-group">
					<lable>
						角色
					</lable>
					<select class="form-control" name="role">
					    <option value="2">请选择</option>
						<option value="1" >管理员</option>
						<option value="2" >用户</option>
						
					
					</select>
				</div>
				<input type="submit" id="" name="" value="创建" class="btn btn-primary" />
			</form>
		</div>
		<script type="text/javascript">
	$(function(){
		$("#form-user-add").validate({
		rules:{
			name:{
				required:true,
				minlength:4,
				maxlength:16
			},
			password:{
				required:true,
			},
			password1:{
				required:true,
				equalTo: "#password"
			},
			sex:{
				required:true,
			},
			email:{
				required:true,
				email:true,
			},
			adminRole:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "hello" ,
				dataType:'json',
				success: function(data){
				
					parent.layer.msg(data.msg, {time: 3000}, function () {
                                 
							  
                            });
                         ///   return;
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
			
		}
	});

	})
	
	</script>
	</body>

</html>