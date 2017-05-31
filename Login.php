
<!DOCTYPE html>

<?php
session_start();
?>

<html lang="zh-cn">

<head>

<meta http-equiv="content-type" content="text/html;charset=utf-8">

<title>在线评测系统</title>
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="css/common.css" type="text/css" />
<!-- <style type="text/css">
    .input-field {
        margin: 10px;
    }
    .form-control2 {
        display: inline;
    }
</style> -->
<style type="text/css">
    .jumbotron {
        margin-top: 0px;
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
                        <td><label>用户名：</label></td>
                        <td><input type="text" name="username" value="" class="form-control input-field"/></td>
                    </tr>
                    <tr>
                        <td><label>密码：</label></td>
                        <td><input type="password" name="password" value="" class="form-control input-field"/></td>
                    </tr>
                    <tr>
                        <td><label>身份: </label></td>
                        <td><select name="userclass" class="form-control input-field" id="admin">
                            <option value="admin">管理员</option>
                            <option value="user" selected="true">普通用户</option>
                        </select></td>
                    </tr>
                    <input type="hidden" name="select" id="reg-log">
                    <!-- <tr>
                        <td></td>
                        <td>
                            <label><input type="radio" name="select" value="SignIn" class="form-control form-control2" checked="checked"/>登录</label>
                            <label><input type="radio" name="select" value="SignUp" class="form-control form-control2" />注册</label>
                        </td>
                    </tr> -->
                </table>
                <div style="text-align: center;">
                    <button class="btn-primary" id="login-btn">登录</button>
                    <button class="btn-primary reghide" id="register-btn">注册</button>
                    <!-- <input type="submit" name="submit" value="提交" class="btn-primary"/> -->
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $('#admin').change(function() {
        if ($(this).val() == 'admin') {
            $('#register-btn').hide();
        } else if ($(this).val() == 'user') {
            $('#register-btn').show();
        }
    });
    $('#register-btn').click(function() {
        $('#reg-log').val('SignUp');
        $('form.login').submit();
    })
    $('#login-btn').click(function() {
        $('#reg-log').val('SignIn');
        $('form.login').submit();
    })
</script>
</body>

</html>
