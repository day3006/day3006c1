<?php

namespace heart\model;

use PDO;
use Exception;

class Base{

	//为了让实例化的的对象能够在类里面都运行，我们设置一个属性
	//这个为什么不需要初始化赋值，因为我们在这里使用的时候__construct首先运行

	/**
	 * 这个区域专门用来设置类的属性区域
	 * @var
	 */
	/***********************************/
	//实例化数据库的时候为了让实例化的数据库能够在类里面全都可以使用
	private static $pdo;

	//在外边用类名(跟数据库里面的数据表的名字一致)方便获取不同表里面的数据
	private static $model;

	//这是条件的的方法，为了在后面都可以使用我们封装了一个方法并将数据拼接到我们的get方法里面
	private static $where;

	//这里是用来排序的条件添加
	private static $orderby;

	//这里是用来截取数据的内容的
	private static $limit;

	//这里是用来判断需要显示的内容的
	private static $name;

	//
	private static $groupby;

	/***********************************/
	/**
	 * 这里是专门为了启动的时候能够连接到数据库里面的内容
	 *
	 * Base constructor.
	 *
	 * @throws Exception 异常抛出
	 */
	public function __construct ($model='')
	{
		//为了简化里面的内容我们将数据库的链接专门设置一个静态的方法
			self::construct ();
			self::$model = strtolower (ltrim (strrchr  ($model,'\\'),'\\'));



	}

	/**
	 * 这个函数是为了拼接到我们select里面进行分组内容
	 * @param $groupby
	 */
	public function groupby($groupby){

		self::$groupby = $groupby?' group by '.$groupby:'';
		return $this;
	}

	/**
	 * 这个是
	 * @param $where 判断的条件
	 *
	 * @return $this 返回我们的类对象
	 */
	public function where($where){

		self::$where =$where?' where '.$where:'';
		//p (self::$where);die;
		return $this;
	}


	public function update($update){

		//在这里拼接我们的sql的语言
		$sql = 'update '.self::$model.' set '.$update.self::$where.self::$orderby.self::$limit;

		//p ($sql);die;

		return $this->exec ($sql);
	}


	/**
	 * 这是数据的截取
	 * @param $limit
	 *
	 * @return $this
	 */
	public function limit($limit){
		self::$limit=$limit?' limit '.$limit:'';
		return $this;
	}

	public function orderby($orderby){
		self::$orderby = $orderby?' order by '.$orderby:'';
		return $this;
	}


	public function name($name){

		self::$name = $name?' '.$name.' ':null;
		return $this;
	}

	/**
	 * 这个函数是用来获取所有的数据
	 *
	 * @throws Exception 异常
	 */
	public function select(){

		//这个函数的作用就是为了获取数据表里面所有的数据

		//因为我们后期需要改正的内容比较的多，所以我们将sql语句设置在外面
		try{
			//这里是专门为了拼接sql的语句
			//我们为了让所有的类方法名对应数据库里面的table的名字
			if (is_null(self::$name)){
				$sql = 'select * from '.self::$model.self::$where.self::$orderby.self::$limit;
			}else{
				$sql = 'select '.self::$name.' from '.self::$model.self::$where.self::$orderby.self::$limit;
			}

			//p ($sql);die;

			//这是类里面query方法的调用
			return $this->query ($sql);

		}catch (Exception $e){
			throw new Exception($e->getMessage ());
		}


	}

	/**
	 * 这个函数是给整数查询相应的id的单一一条内容
	 * @param $pri
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function find($pri){

		//调用getPriFile的方法获取表里面primary key的名字
		$pris=$this->getPriFile ();

		//p($pris);die;//显示我们的内容是否能够传输过来
		//在这里设置好我们的sql位置
		$sql = 'select * from '.self::$model.' where '.$pris.'='.$pri;

		//p($sql);die;//这里显示我们拼接的sql的语言是否正确；

		return $this->query ($sql);
	}


	/**
	 * 这里是对我们primary key名字的获取
	 * @throws Exception
	 */
	public function getPriFile(){

		$res = $this->query ('desc '.self::$model);

		//p($res);die;
		foreach ($res as $v){

			if ($v['Key']=='PRI'){
				return $v['Field'];
			}
		}



	}


	/**
	 *
	 * 这个函数里面的内容就是专门来跟数据库进行联系的
	 * @throws Exception
	 */
	private  static function construct(){
		try{
			$dsn='mysql:host='.c('database.host').';dbname='.c('database.dbname').'';
			//链接数据库
			self::$pdo = new PDO($dsn,'root','root');

			//设置字符集
			self::$pdo->query ('set names utf8');

			//设置错误模式，exception


		}catch (Exception $e){
			//这种错误的抛出模式可以将我们php中的所的路径都显示出来
			throw new Exception($e->getMessage ());
		}

	}

	/**
	 * 这个是作为又返回级的函数的调用方法
	 * @param $sql         这句是需要给的sql的语句
	 *
	 * @throws Exception   异常
	 */
	public function query($sql){

		try{
			//这里是运行query的sql里面的代码，返回的是一个对象
			//如果想将里面取出来的内容传输到前面我们实例化调用的地方需要经过好几个函数一路穿行过去；
			return self::$pdo->query ($sql)->fetchAll (PDO::FETCH_ASSOC);

			//p ($this->pdo->query ($sql)->fetchAll (PDO::FETCH_ASSOC));//显示我们有返回值的调用query这个函数用fetchAll将我们查找的所有内容全都调出来


		}catch (Exception $e){
			throw new Exception($e->getMessage ());
		}

	}

	/**
	 *这里是对没有返回级的语句的操作
	 *
	 * @param $mess      接受过来的sql语句
	 *
	 * @return int       返回影响的条数
	 * @throws Exception 异常
	 */

	public function exec($mess){
		try{

			return self::$pdo->exec ($mess);

			//p ($this->pdo->exec ($mess));die;

		}catch (Exception $e){
			throw new Exception($e->getMessage ());
		}
	}
}



