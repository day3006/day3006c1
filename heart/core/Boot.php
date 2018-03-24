<?php

/**
 * 这里的类是对我们后边的内容进行启动
 */

namespace heart\core;


class Boot{

	/**
	 * 这里是我们大总管方法可以调用其他方法的内容
	 */
	public static function run(){
		//p (1);
		//设置内容项
		self::init();

		//这里是跟app文件里面的内容关联
		//主要还是用我们以前模板的加载页面的内容

		self::apprun ();

	}

	/**
	 *模板的加载方法，主要是关联app文件里面类和方法
	 *
	 */
	private static function apprun(){

		//模板的加载
		//1,首先我们判断从地址栏里面接受过来的内容是否存在，
		//2,给我们的模板设置一个默认值在上面没有参数传输过来的时候我们可以按照默认值进行
		//3,我们在这里定义一个变量?s=admin\index\index 这种传参方式，

		if(isset($_GET['s'])){
			//设置一个变量$s来接受我们在地址栏里面传输过来的值
			$s=$_GET['s'];

			//我们将传输过来的值进行用explode的关键字进行拆分
			$row = explode ('/',$s);

			//p ($row);die;//这里是验证我们这样的方式是不是可以接受到我们值

			//定义变量$m,$c,$a来接受我们从地址栏传输过来分解过后的内容
			//这是我们对应的命名空间
			$m=$row[0];
			//这是我们对应的类名
			$c=$row[1];
			//这是我们对应方法的调用
			$a=$row[2];


		}else{
			//这里是对默认值的设置
			$m='home';
			$c='index';
			$a='index';

		}

		//常量的设置，主要是让后面heart/core/Controller->message()进行页面信息显示的时候能够根据我们地址栏的请求进行跳转

		define ('MODEL',$m);
		define ('CONTROLLER',$c);
		define ('ACTION',$a);


		//这是对前面参数的拼接
		$controller='\app\\'.$m.'\controller\\'.ucfirst ($c).'Controller';
		//echo $controller;die;
		//(new $controller())->$a();


		//我们使用原来的一个调用方法
		echo call_user_func_array ([new $controller,$a],[]);

	}



	/**
	 * 这个网站的内容配置项
	 *
	 */
	private static function init(){
		//echo 2;//这是验证内容是否加载

		//设置头部文件
		header ("content-type:text/html;charset=utf8");

		//设置我们的时区位置

		date_default_timezone_set(c('timezone.timezone'));

		//对我们的session,
		session_id()|| session_start ();
	}

}











