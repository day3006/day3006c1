<?php

/**
 * 这个页面主要是将我们的实际请求能够不同的方式实现出来
 */


namespace heart\view;

class View{

	public function __call ( $name , $arguments )
	{
		//p($arguments);die;
		//echo 11;die;
		return self::RunParse ($name , $arguments);
	}


	public static function __callStatic ( $name , $arguments )
	{
		//p($arguments);die;//这里是查看从indexcontroller/index()方法里面的传输过来的参数
		return self::RunParse ($name , $arguments);
	}


	public static function RunParse($name , $arguments){
		//正常的情况下，我们的call_user_func_array([],[])是这样书写的，
		//而在这个地方，我们第二个参数没有加数组的外壳，是因为我们在上面接受过来的数组自动加了一层，所以在这边我不写这个[]括号自动的去除一层数组

		return call_user_func_array ([new Base(),$name],$arguments);



	}

}