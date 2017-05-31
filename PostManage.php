<!DOCTYPE html>

<?php 

die("abandoned file");

session_start();
if(! $_SESSION["admin"]){
	header("location:Login.php");
}





?>

<html lang="zh-cn">

<head>

<link rel="stylesheet" href="css/style2.css" type="text/css" />
<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>

<script type="text/javascript"> 
function del(){ 
	if(confirm("确定删除？")){ 
		return true; 
	} 
		return false; 
} 
</script> 

</head>

<body>
<h1> 讨论管理 </h1>
<p>
<a href="index2.php">首页</a>
<a href="Logout.php">注销</a>
</p>


<form action="PostManage.php" method="GET">
题号：<input type="text" name="problemId" value="" />
<input type="submit" value="查询"/>
</form>

<table>
<caption>讨论列表</caption>
<tr><th>编号</th><th>标题</th><th>作者</th><th>操作</th></tr>
<?php
$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
//连接数据库
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

$q="select * from `Post`";//设置查询指令

if($_GET['problemId'] && $_GET['problemId']!=""){
	$q= sprintf("select * from `Post` WHERE `problemId` = '%s'", $_GET['problemId']);
}



$result=mysql_query($q);//执行查询
while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
	$format = '
	<tr>
	<td>%s</td>
	<td><a href="PostShow.php?postId=%s">%s</a></td>
	<td>%s</td>
	<td><a href="PostDelete.php?postId=%s>删除</a></td>
	</tr>
	';

	printf($format, $row["postId"], $row["postId"],  $row["postTitle"],  $row["userId"],  $row["postId"] );
}
?>

</table>


</body>

</html>