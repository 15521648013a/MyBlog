<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ToolsController extends Controller
{
   //文件上传
   function upLoadFile(){
    $filesName = $_FILES['file']['name'];  //�ļ�������
	$filesTmpName = $_FILES['file']['tmp_name'];  //��ʱ�ļ�������
	$filePath = "./img/".date("Ymd",time()).rand(1,50).$filesName; //�ļ�·��
 

 
 
	//$file = basename($_POST['file']);  //php��basename() �����ɻ�ȡ�ļ���
	while(file_exists($filePath))
	{$filePath = "./img/".date("Ymd",time()).rand(1,50).$filesName;}

     move_uploaded_file($filesTmpName, $filePath);
	
	
	$json_array = array('name'=>$username,'age'=>$age ,'sex'=>$sex,'file'=>$filePath); //ת������������
 
	$json= json_encode($json_array);  //������ת����json����
	echo   $json;
   }
}