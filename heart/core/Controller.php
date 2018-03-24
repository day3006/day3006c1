<?php

/**
 * 这边是公共功能,主要是成功的信息提醒，以及页面的跳转功能
 */


namespace heart\core;


class Controller{


	private $url;

	/**
	 * 这个页面是我们加载模板页面的内容
	 * 为了不让我们这里的内容写死，我们需要将前面的内容进行调整1，在boot页面将我们变量的改变的地方将三个变量变成三个常量也方便我们的调用
	 * 2，
	 */
	public function message($mess){

		//echo 'message';die;//在home/indexcontroller/index中验证我们的继承是不是能够正常的使用
		p ($this->url);

		include 'view/message.php';
		return $this;
	}


	/**
	 * 这个函数主要是将页面进行跳转的。
	 */
	public function runParse($url=''){


		//进入之后我们需要判断是不是有参数传输过来了

		if ($url){

			$this->url=$url;

		}else{
			$this->url='javascript:history.back();';
		}
		return $this;
	}

}








