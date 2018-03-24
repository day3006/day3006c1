<?php

/**
 * 这个页面是真正的功能上面的实现
 */


namespace heart\view;

class Base{

	//为了使用后面的__tostring()这个方法我们，我们想让make，with两个方法里面的内容可以在__tostring里面可以使用
	//所以我们设置类的属性接受make，with里面的内容

	private $href;

	//这里给设置一个空数组是为了后边没有调用这个方法或者是没有参数传输过来的时候防止extr会报错；
	private $data=[];



	public function make($sql=''){
		//echo 11;
		$sql=$sql?:ACTION;
		//这里我们使用前面的boot里面对类的实例化的时候
		//这样使用的条件：1，文件夹命名需要跟着类名走，文件的命名需要跟着方法名
		$this->href =  '../app/'.MODEL.'/view/'.CONTROLLER.'/'.$sql.'.php';
		return $this;
	}

	public function with($num){
		$this->data=$num;
		return $this;
	}

	public function __toString ()
	{
		extract ($this->data);
		require_once $this->href;



		return '';
	}

}