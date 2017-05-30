
<!DOCTYPE html>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<style type="text/css">
    .input-field {
        margin: 10px;
    }
    .form-control2 {
        display: inline;
    }
</style>

</head>

<body>

<div class="jumbotron">
    <div class="container">
        <h2 class="text-center">用户登录</h2>
        <form action="check_session_login.php" method="post" name="login_form" onsubmit="return encrypt();" class="login">
            <div class="form-group">
                <table align="center">
                    <tr>
                        <td>用户名：</td>
                        <td><input type="text" name="username" value="" class="form-control input-field"/></td>
                    </tr>
                    <tr>
                        <td>密码：</td>
                        <td><input type="password" name="password" value="" class="form-control input-field"/></td>
                    </tr>
                    <tr>
                        <td>身份: </td>
                        <td><select name="userclass" class="form-control input-field">
                            <option value="admin">管理员</option>
                            <option value="user">用户</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <label><input type="radio" name="select" value="SignIn" class="form-control form-control2" />登录</label>
                            <label><input type="radio" name="select" value="SignUp" class="form-control form-control2" />注册</label>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="提交" class="form-control"/></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

</body>

</html>
