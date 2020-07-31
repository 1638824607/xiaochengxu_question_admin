<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:39:"application/admin\view\login\index.html";i:1588911502;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>欢迎使用后台管理系统</title>
	<link rel="stylesheet" href="/public/static/admin/layui/css/layui.css?V2.3.0">
	<link rel="stylesheet" href="/public/static/admin/font-awesome/css/font-awesome.min.css?V4.7.0" type="text/css">
	<link rel="stylesheet" href="/public/static/admin/css/login.css?V1.1.6">
	<script type="text/javascript" src="/public/static/admin/js/jquery-1.12.4.min.js"></script>
</head>
<body>

<div class="user-login" >
	<div class="user-login-main">
		<div class="user-login-header">
			<h2>
				欢迎使用后台管理系统
			</h2>
		</div>

		<form action="<?php echo url('Login/Action'); ?>"  onsubmit="return false" class="layui-form" id="dologin">
			<div class="user-login-box">
				<div class="layui-form-item">
					<label class="user-login-icon layui-icon layui-icon-username"></label>
					<input name="username" id="username" type="text" lay-verify="required" placeholder="用户名" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-item">
					<label class="user-login-icon layui-icon layui-icon-password"></label>
					<input name="password" id="password" type="password" lay-verify="required" placeholder="密码" autocomplete="off" class="layui-input">
				</div>
				<div class="layui-form-item">
					<button class="layui-btn layui-btn-fluid" lay-submit lay-filter="login-submit" name="dologin" >登 入</button>
				</div>
				<div style="color:red;" id="note"></div>
			</div>
		</form>
	</div>

	<div class="layui-trans user-login-footer">
		<p>© 版权所有 2015-2025 </p>
		<p> <span><a href="http://www.9-xin.com" target="_blank">技术支持:久鑫网络</a></span></p>
	</div>

</div>

<script type="text/javascript" src="/public/static/admin/layui/layui.all.js?V2.3.0"></script>
<script type="text/javascript" src="/public/static/admin/js/mylayui.js?V1.1.6"></script>
<script type="text/javascript" src="/public/static/admin/js/md5.js"></script>
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</body>
</html>