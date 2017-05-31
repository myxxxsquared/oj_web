<!DOCTYPE html>

<?php

session_start();
if(! $_SESSION["user"] && ! $_SESSION["admin"]){
	header("location:Login.php");
}

?>

<html lang="zh-cn">

<head>

<link rel="stylesheet" href="css/style2.css" type="text/css" />
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/common.css" type="text/css" />

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
<?php
if (! $_SESSION["admin"]) {
    include('nav1.php');
} else {
    include('nav2.php');
}
?>
<div class="jumbotron">
<div class="container">
<h2> 提交列表 </h2>
<p>
欢迎你，<?php echo $_SESSION["user"]; ?>
</p>

<div class="container" style="margin-top: 20px;">
<table class="table table-striped">
<tr>
    <th>题目号</th>
    <th>用户</th>
    <th>提交时间</th>
    <th>结果</th>
    <th>运行时间 (ms)</th>
    <th>内存用量 (Byte)</th>
    <th>源代码</th>
</tr>
<?php

require_once("mysqliconn.php");
$q="SELECT * FROM Submit ORDER BY submitId DESC LIMIT 30";
$result = $dbConnection->query($q);

$format = '<tr>
	<td><a href="ProblemShow.php?problemId=%s">%s</a></td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
	</tr>';
    
while($row=$result->fetch_assoc())
{
    if ($row['userId'] == $_SESSION['user'] || $_SESSION['admin']) {
        # $view_src = "<a href='dat/submissions/" . $row["submitId"] . "/src.cpp'>View</a>";
        $view_src = "<a href='ViewSrc.php?submitId=" . $row["submitId"] . "'>View</a>";
    } else {
        $view_src = "";
    }
	printf($format, $row["problemId"], $row["problemId"], $row["userId"],
           $row["submitTime"], $row["result"], $row["runTime"],
           $row["memUsed"], $view_src);
}

$stmt->close();
$dbConnection->close();

?>

</table>
</div>
</div>
</div>
<script type="text/javascript">
    $('#nav-status').addClass('active');
</script>
</body>

</html>
