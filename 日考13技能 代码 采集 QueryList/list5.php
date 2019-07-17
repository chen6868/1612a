<?php
$pdo=new PDO('mysql:host=127.0.0.1;dbname=1612a;charset=utf8','root','root');
$data=$pdo->query('select * from news1')->fetchAll();
?>
<html>
<head>
	<title></title>
</head>
<body>
<table border='1'>
	<tr><td>ID</td><td>标题</td><td>链接</td><td>图片</td><td>简介</td><td>发布时间</td></tr>
<?php foreach ($data as $key => $value): ?>
	<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['title']?></td>
		<td><?=$value['link']?></td>
		<td><img src="<?=$value['pic']?>"></td>
		<td><?=$value['description']?></td>
		<td><?=$value['pubtime']?></td>
	</tr>
<?php endforeach ?>
</table>
</body>
</html>