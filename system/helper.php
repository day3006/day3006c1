<?php

/**
 * 这是设置一个打印的函数方法
 *
 * @param $var
 */
function p($var){
	//这里是对格式的设置
	echo '<pre style="background: gray; padding:10px;width:90%;border-radius: 5px;">';
	//判断传输过来的数据类型用不同的打印方式显示出来
	if(is_bool ($var)|| is_null ($var)){
		var_dump ($var);
	}else{
		print_r ($var);
	}
	echo '</pre>';
}


/**
 * 设置常量用来检查是不是$_SERVER里面的post的请求方式。
 */

define ('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?true:false);



function c($var=null){

	//当参数为空的时候我们是将文件中所有的内容全部取出来放回到函数调用的部分
	if (is_null ($var)){
		//echo 1;die;//这里是为了验证程序是否走到这里
		$data=[];
		$files = glob ('../system/config/*');

		//p ($files);die;//可以查看到所有的文件

		//现在我们只需要将每条数据最后的内容提取出来
		foreach($files as $file){
			$file = basename ($file);
			//p ($file);//这是通过basename目录中的一个方法将最终的文件打印出来、

			//接下来是将文件的名字截取出来
			$position = strpos ($file,'.');
			//p ($position);//这里是显示我们小点所在的位置

			//现在需要对我们的内容进行截取位置已经知道
			$name = substr ($file,0,$position);
			//p($name);//每一个文件的名字取出来之后我们就可以将所有的数据都放到我们设置的数组中

			//取出数据
			$content = include '../system/config/'.$file;
			//p ($content);//每个文件中的数据都取出来了

			$data[$name]=$content;
		}
		return $data;
	}

	//将上面传输过来的值进行拆分
	$info = explode ('.',$var);

	//p ($info);//这里显示我们多参数的时候我们进行拆分
	//p (count($info));//显示我们用这个是不是能够进行统计

	//通过统计判断传输过来的参数是几位

	if (count ($info)==1){
		//首先我们需要判断这个文件是否存在
		$file = '../system/config/'.$var.'.php';
		//p ($file);//查看我们的内容格式是不是正确

		return is_file ($file)?include $file:null;


	}

	if (count($info)==2){

		$file = '../system/config/'.$info[0].'.php';

		if (is_file ($file)){
			$data= include $file;
			//p ($data);//这里是显示我们这个文件在存在的时候返回的数据
			return isset($data[$info[1]])?$data[$info[1]]:null;
		}


	}



}








