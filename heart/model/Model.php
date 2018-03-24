<?php

namespace heart\model;

class Model{

	public function __call ( $name , $arguments )
	{
		return self::RunParse ($name , $arguments);
	}



	public static function __callStatic ( $name , $arguments )
	{
		return self::RunParse ($name , $arguments);
	}


	public static  function RunParse($name , $arguments ){

		//为了获得每实例化的时候调用到的类名使用了一个函数get_called_class ()来获取这个函数的名字
		//后期的所有调用数据库的方法都是通过在system/model里面的类名的调用，我们将这个获得类名在实例化的时候直接给到里面


		return call_user_func_array ([new Base(get_called_class ()),$name],$arguments);

	}

}

