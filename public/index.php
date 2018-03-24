<?php

/**
 * 网站单一入口文件
 */



//这里是对我们autoload.php这个文件加载
//而在在composer.josn文件中对autoload的内容进行配置
//1是 files内容的配置 以数组的方式进行
//2是 psr-4文件的设置 以{}的方式进行的

include_once '../vendor/autoload.php';

//这是对\heart\core空间里面的Boot静态变量的调用方法run
//这里是对后面内容的启动

\heart\core\Boot::run();












