<?php

namespace app\home\controller;

use heart\core\Controller;
use heart\model\Model;
use heart\view\View;
use system\model\Student;
use system\model\Student1;

class IndexController extends Controller {

	public function index(){

		//echo 'home controller index';


		//这里是对heart\view里面的类的调用，我设置两个类，View的功能主要是对我们在调用方法的时候
		//当没有这个方法的时候我们里面定义__call,__callstatic对没有这个方法的的触动调用里面的内容，
		//这样让我们的方法能够在外面的调用更加的自由可以用静态的调用也可以用实例化的方式进行调用。
		//View::make();

		//(new View())->make();

		//View::with();


		//因为make是用于模板的调用，而with是用于参数的分配工作。
		//按照程序的运行是先有参数后加载模板的方式，在这里我们想让调用部分不分先后
		//我在base类里面设置一个__tostring()将里面的函数排序出来，而在外面都可以调用的。
		//我们想用这个方法就需要echo 它所在的对象。而对象返回需要用到返回值return来进行
		//我们从base的方法make，with中开始return 到View中的方法RunParse再到View中的方法__callstatic让后返回到我们这个位置
		//我们是在boot里面对对象进行echo输出的。
		//我们在这边设置的成员变量也是一样一层层到达base类中的with方法的中的。
		$hd = [1,2,3];

		return View::make()->with(compact ('hd'));



		//Model::query('select * from student');
		//Model::exec('update student1 set birthday=20011113 where id=1');

	}


	public function add(){

		//实验我们在controller里面的方法使用

		//$this->runParse ('?s=home/index/index')->message ('修改成功11');
		//$this->message ('修改成功11')->runParse ();
		//$this->runParse ()->message ('修改成功11');
		//在这里我们需要验证模板加载文件


		//echo '我是add';

		//这里是我们实验helper.php里面的c函数的功能
		//p (c ());//全部的文件已经可以取出来了

		//p (c('database'));
		//p (c('database.host'));


		//这个是来实验model里面的方法是否能够正常的运行

		//Model::select();

		//p(Student1::select());

		//这里是通过不同的类(在system/model中的类对heart/model里面base方法的调用来实现对数据的读取)
		//p(Student::select());
		//$res=Student1::where('sex="男"')->name('id,name')->select();
		//p ($res);


		//这里是找到我们的primary key  找到单一一个内容
		//p(Student1::find(1));//结果能够正常的显示出来

		//p(date('y/m/d h/i/s'));//验证我们的时区是否设置正确

		//$res = Student1::limit(1)->orderby('age desc')->name('name,age')->select();
		//p ($res);

//		$res =Student1::where('name="牛夫人"')->update('sex="女"');

		//p ($res);




	}

}


