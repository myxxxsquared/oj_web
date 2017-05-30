<!DOCTYPE html>

<?php 

session_start();
if(! $_SESSION["user"]){
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
<h1> 状态列表 </h1>
<p>
欢迎你，<?php echo $_SESSION["user"]; ?> 
<a href="index1.php">首页</a>
<a href="Logout.php">注销</a>
</p>
<table>
<caption>状态列表</caption>
<tr><th>提交号</th><th>题目号</th><th>用户</th><th>提交时间</th><th>结果</th><th>运行时间</th><th>内存用量(字节)</th></tr>
<?php
$link=mysql_connect('localhost:3306','root','phisics')or die("数据库连接失败");
//连接数据库
mysql_select_db('OJ',$link);//选择数据库
mysql_query("set names utf8");//设置编码格式

$q="select * from Submit";//设置查询指令
$result=mysql_query($q);//执行查询
while($row=mysql_fetch_assoc($result))//将result结果集中查询结果取出一条
{
	$format = '<tr>
	<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>
	</tr>';

	printf($format, $row["submitId"], $row["problemId"], $row["userId"], $row["submitTime"], $row["result"], $row["runTime"], $row["memUsed"]);
}
?>

</table>


</body>

</html>