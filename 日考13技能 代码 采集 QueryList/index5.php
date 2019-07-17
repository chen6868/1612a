<?php
// 采集有两种方式
// 方法一：编写正则表达式，使用preg_match_all采集数据
// 方法二：使用QueryList第三方类，编写规则（基本网站源码的DOM结构），调用QueryList类的相关方法采集数据

// 方法二实现

// 1 引入类文件
include 'ql/phpquery.php';
include 'ql/querylist.php';

// 2 引入命名空间
use QL\QueryList;

// 3获取网站源码
$url='http://news.ifeng.com/mainland/';
$str=file_get_contents($url);

// 4 编写规则，这个规则是一个数组，规则的形式就是节点的DOM结构
$rules=array(
	'title'=>array('div.juti_list h3 a','text'),
	'pic'=>array('div.juti_list div.ju_pic a img','src'),
	'link'=>array('div.juti_list h3 a','href'),
	'description'=>array('div.juti_list div.clearfix div p','text'),
		// p+div 定位到与p标签同一级别的在p下方的div
	'pubtime1'=>array('div.juti_list div.clearfix div p+div div.ping03 span','text'),			// p+div 定位到与p标签同一级别的在p下方的div
	// 'pubtime2'=>array('div.juti_list div.ping03 span','text'),			// p+div 定位到与p标签同一级别的在p下方的div
	);

// 5 调用QueryList相关方法，采集数据
$data=QueryList::query($str,$rules)->getData();
// $data=QueryList::query($str,$rules)->data;
// echo '<pre/>';
// print_r($data);
// 6 入库
$pdo=new PDO('mysql:host=127.0.0.1;dbname=1612a;charset=utf8','root','root');
foreach ($data as $key => $value) {
	$title=$value['title'];
	$pic=$value['pic'];		// 图片线上链接地址
	// 下载图片到本地
	$img=file_get_contents($pic);	// 下载文件流，保存到一个变量中
	$filename='images/pic_'.$key.'.jpeg';			// 图片的本地地址及文件名 留一个问题？？能不能从$pic（图片地址）中获取图片的扩展名（jpeg jpg png gif）
	file_put_contents($filename, $img);		// 保存文件流到文件中（生成图片文件）

	$link=$value['link'];						// 标题链接（链接到详情页）
	$description=$value['description'];			// 简介
	$pubtime=$value['pubtime1'];				// 发布时间
	// 注意，在数据库中存储图片的本地地址（$filename)
	$sql="insert into news1(title,pic,link,description,pubtime) values('$title','$filename','$link','$description','$pubtime')";
	$pdo->exec($sql);
	// 当循环到第8次的时间结束循环
	if($key>6){
		break;		// 结束全部循环，退出循环体
	}
}