
<!DOCTYPE html>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>




</script>


<link rel="stylesheet" href="sub/css/style.css" type="text/css" />

</head>

<body>

<div class="wrapper">
<div class="loginBox">
<h1> 用户登录 </h1>

<form action="check_session_login.php" method="post" name="login_form" onsubmit=" return encrypt();" class="login">

    
    <div class="loginBoxCenter">
    用户名：<input type="text" name="username" value=""/>
    <br />
    密码：<input type="password" name="password" value=""/>
    <br />
    身份: <select name="userclass">
    <option value="admin">管理员</option>
    <option value="user">用户</option>
    </select><br />

    <label><input type="radio" name="select" value="SignIn">登录</label>
    <label><input type="radio" name="select" value="SignUp">注册</label>

    <input type="submit" name="submit" value="提交" class="loginBtn"/>
    </div>
    </div>
</form>

</div>

</body>

</html>