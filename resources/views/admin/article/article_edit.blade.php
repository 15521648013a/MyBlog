
 <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>


@include("public.admin.header")
     
		<div class="container">
			<form action="saveEdit" method="post">
				<div class="form-group">
				    @csrf
					<lable>
						文章标题
					</lable>
					<input type="text" name="title"  value="<?php echo $article->article_title?>" class="form-control" placeholder="请输入文章标题" />
				</div>
				
				<div class="form-group">
					<lable>
						文章分类
					</lable>
					<select class="form-control" name="article_category_id">
						<option>请选择</option>
						<?php foreach($article_categories as $category){ ?>
						<option value="<?php echo $category->category_id?>" 
						<?php if($article->article_category_id == $category->category_id) { ?>
						selected
						<?php } ?> >
						<?php echo $category->category_name ?>
						</option>
						<?php }?>
					</select>
				</div>

				<div class="form-group">
					<lable>
						文章配图
					</lable>
					<input type="file" name="file" id="file" accept="image/gif,image/png,image/jpg,image/jpeg"><br>	
					<input type="text" name="thumb" id="pei" value="<?php echo $article->article_thumb?>" class="form-control" placeholder="请输入配图URL" />

				</div>
				
				<div class="form-group">
					<lable>
						文章详情
					</lable>
					<script type="text/plain" name="content" id="editor" name="content" ><?php echo $article->article_content ?></script>
				</div>
				<input type="submit" id="" name="" value="保存" class="btn btn-primary" />
			</form>
		</div>

		<script src="/laravel/public/ext/ueditor/ueditor.config.js" type="text/javascript" charset="utf-8"></script>
		<script src="/laravel/public/ext/ueditor/ueditor.all.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			UE.getEditor("editor", {
				toolbars: [
					[
						'bold', //加粗
						'indent', //首行缩进
						'snapscreen', //截图
						'italic', //斜体
						'underline', //下划线
						'strikethrough', //删除线
						'subscript', //下标
						'selectall', //全选
						'horizontal', //分隔线
						'removeformat', //清除格式
						'unlink', //取消链接
						'fontfamily', //字体
						'fontsize', //字号
						'paragraph', //段落格式
						'simpleupload', //单图上传
						'edittable', //表格属性
						'link', //超链接
						'emotion', //表情
						'spechars', //特殊字符
						'searchreplace', //查询替换
						'map', //Baidu地图
						'justifyleft', //居左对齐
						'justifyright', //居右对齐
						'justifycenter', //居中对齐
						'justifyjustify', //两端对齐
						'forecolor', //字体颜色
						'backcolor', //背景色
						'template', //模板
					]
				],
				initialFrameHeight:250
			});
		
            $(function () {
               //失去焦点
            	$("#file").change(function() {
            		 
            	 
            
            	 //提交实践
            
            		 var file1 = document.getElementById('file').files[0]; //获取文件路径名，注意了没有files[1]这回事，已经试过坑
            		 //var file1 = $("#file")[0].files[0];  //这句跟上一面那句作用一
            		  var formData = new FormData();
            		  formData.append('file',file1);   formData.append('_token','{{csrf_token()}}'); 
            		  $.ajax({
            			type: "POST",
            			url: "../upLoadFile",  //同目录下的php文件
            		    data:formData,
            		    dataType:"json", //声明成功使用json数据类型回调
            
            		   //如果传递的是FormData数据类型，那么下来的三个参数是必须的，否则会报错
            			cache:false,  //默认是true，但是一般不做缓存
            			processData:false, //用于对data参数进行序列化处理，这里必须false；如果是true，就会将FormData转换为String类型
            			contentType:false,  //一些文件上传http协议的关系，自行百度，如果上传的有文件，那么只能设置为false
            
            			success: function(msg){  //请求成功后的回调函数
            			 //alert(msg);
            			// $("#result").append("<div> 你的名字是"+msg.file+"，性别："+msg.sex+"，年龄："+msg.age+"</div>");
            			  //$('#result').append("<img src = "+msg.file+">");
            			 //$("#pei").value("dsf");
            			 //document.getElementById("pei").value = msg.file;
            			 // $('#result').append("<img src = "+msg.file+">");
            			 $("#pei").val(msg.filePath) ;
            		   }
            	   });
            
            	   });
            
            	
            
             });
            
</script>
@include("public.admin.footer")