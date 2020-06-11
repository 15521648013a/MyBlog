@include('public.admin.header')

		<div class="container">
			<form  method="post" action="../{{$user->userid}}" id="form-user-add">
				@csrf
				<input type="hidden" name="_method"  value="PATCH">
				<div class="form-group">
					<lable>
						用户名
					</lable>
					<input type="text" name="username" value="{{$user->username}}" class="form-control" placeholder="请输入用户" />
				</div>
				<div class="form-group">
					<lable>
						密码
					</lable>
					<input type="password" name="password" id="password" value="{{$user->password}}" class="form-control" placeholder="请输入密码" />
				</div>
				<div class="form-group">
					<lable>
						确认密码
					</lable>
					<input type="password" name="password1" value="{{$user->password}}" class="form-control" placeholder="请输入密码" />
				</div>
				<div class="form-group">
					<lable>
						角色
					</lable>
					<select class="form-control" name="role" id="role">
					    <option value="0">请选择</option>
						<option value="1" >管理员</option>
						<option value="2" >用户</option>
					</select>
				</div>
				<input type="submit" id="" name="" value="更新" class="btn btn-primary" />
			</form>
		</div>
		<script type="text/javascript">
	$(function(){
		$("#role").val('{{$user->role}}');
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