<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"application/admin\view\model\index.html";i:1588919818;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\header.html";i:1588911510;s:74:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\left.html";i:1588817206;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\footer.html";i:1588130548;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>久鑫网络后台管理系统</title>
    <link rel="stylesheet" href="/public/static/admin/layui/css/layui.css?v=v2.3.0">
    <link rel="stylesheet" href="/public/static/admin/font-awesome/css/font-awesome.min.css?V4.7.0" type="text/css">
    <link rel="stylesheet" href="/public/static/admin/css/comm.css?v=v1.3.6">
    <link href="/public/static/admin/css/jquery.treetable.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/public/static/admin/js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="/public/static/admin/js/jquery.treetable.js"></script>
    <script type="text/javascript" src="/public/static/admin/js/checkform.js"></script>

</head>

<body class="layui-layout-body">

<div class="layui-layout layui-layout-admin">
	<div class="layui-header">
    <div class="layui-logo">
        <a href="/" target="_blank" title="<?php echo sys('sys_sitename'); ?>后台管理系统">
            <?php echo sys('sys_sitename'); ?>后台管理
        </a>
    </div>

    <ul class="menu">
        <li class="menu-ico" title="显示或隐藏侧边栏"><i class="fa fa-bars" aria-hidden="true"></i></li>
    </ul>

    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item layui-hide-xs">
             您好，<?php echo \think\Session::get('admin_username'); ?>
        </li>


        <li class="layui-nav-item layui-hide-xs">
            <a href="javascript:;">
                <i class="fa fa-cog" aria-hidden="true"></i> 系统配置</a>
                <dl class="layui-nav-child">

                    <?php if(\think\Session::get('admin_role_auth_ids') == 0): ?>
                        <dd><a href="<?php echo url('Settings/Index'); ?>"><i class="fa fa-sliders" aria-hidden="true"></i>系统设置</a></dd>
                        <dd ><a href="<?php echo url('Sort/Index'); ?>"><i class="fa fa-bars" aria-hidden="true"></i>栏目管理</a></dd>
                        <dd ><a href="<?php echo url('Role/Index'); ?>"><i class="fa fa-hand-stop-o" aria-hidden="true"></i>系统角色</a></dd>
                        <dd ><a href="<?php echo url('Manager/Index'); ?>"><i class="fa fa-users" aria-hidden="true"></i>系统用户</a></dd>
                        <dd ><a href="<?php echo url('Backup/Index'); ?>"><i class="fa fa-database" aria-hidden="true"></i>数据备份</a></dd>
                        <dd ><a href="<?php echo url('Logs/Index'); ?>"><i class="fa fa-history" aria-hidden="true"></i>系统日志</a></dd>
                        <dd ><a href="<?php echo url('Sort/Make'); ?>"><i class="fa fa-database" aria-hidden="true"></i>更新缓存</a></dd>
                    <?php else: ?>
                        <if condition="in_array(9901,$qxid)"><dd><a href="<?php echo url('Settings/Index'); ?>"><i class="fa fa-sliders" aria-hidden="true"></i>系统设置</a></dd></if>
                        <if condition="in_array(9903,$qxid)"><dd><a href="<?php echo url('Sort/Index'); ?>"><i class="fa fa-bars" aria-hidden="true"></i>栏目管理</a></dd></if>
                        <if condition="in_array(9904,$qxid)"><dd><a href="<?php echo url('Role/Index'); ?>"><i class="fa fa-hand-stop-o" aria-hidden="true"></i>系统角色</a></dd></if>
                        <if condition="in_array(9905,$qxid)"><dd><a href="<?php echo url('Manager/Index'); ?>"><i class="fa fa-users" aria-hidden="true"></i>系统用户</a></dd></if>
                        <if condition="in_array(9907,$qxid)"><dd><a href="<?php echo url('Backup/Index'); ?>"><i class="fa fa-database" aria-hidden="true"></i>数据备份</a></dd></if>
                        <if condition="in_array(9906,$qxid)"><dd><a href="<?php echo url('Logs/Index'); ?>"><i class="fa fa-history" aria-hidden="true"></i>系统日志</a></dd></if>
                        <if condition="in_array(9908,$qxid)"><dd><a href="<?php echo url('Sort/Make'); ?>"><i class="fa fa-database" aria-hidden="true"></i>更新缓存</a></dd></if>
                    <?php endif; if(\think\Session::get('admin_id') == 99999999): ?>
                        <dd ><a href="<?php echo url('Model/Index'); ?>"><i class="fa fa-codepen" aria-hidden="true"></i>模型管理</a></dd>
                        <dd ><a href="<?php echo url('Forms/Index'); ?>"><i class="fa fa-database" aria-hidden="true"></i>表单管理</a></dd>
                    <?php endif; ?>


                </dl>
        </li>


        <li class="layui-nav-item layui-hide-xs">
            <a href="javascript:;">
                <i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo \think\Session::get('admin_role_name'); ?></a>
                <dl class="layui-nav-child">
                    <dd><a href="/" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> 网站首页</a></dd>
                    <dd><a href="<?php echo url('Manager/Person'); ?>"><i class="fa fa-address-card-o" aria-hidden="true"></i> 密码修改</a></dd>
                    <dd><a href="<?php echo url('Admin/Logout'); ?>" onClick="return confirm('确定退出系统吗？\n退出后自动关闭窗口！');"><i class="fa fa-sign-out" aria-hidden="true"></i> 退出登陆</a></dd>
                </dl>
        </li>
    </ul>
</div>

<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <!-- 左侧导航区域 -->
        <ul class="layui-nav layui-nav-tree" id="nav" lay-shrink="all">
            <?php $_result=get_mytable_list('sort',' AND pid=0','id,catname');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
            <li class="layui-nav-item nav-item<?php if($v1['id']==input('pid',0)){?> layui-nav-itemed<?php }?>">
                <a class="" href="javascript:;"><i class="fa fa-globe" aria-hidden="true"></i><?php echo $v1['catname']; ?></a>
                <?php $_result=get_mytable_list('sort',' AND pid='.$v1['id'].'','id,catname');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($i % 2 );++$i;
                        $count2=get_count("sort",'status=1 AND pid='.$v2['id'].'');
                         if($count2) $url2="javascript:;";else $url2=url('Sort/Action',array('pid'=>$v1['id'],'ty'=>$v2['id']));
                    ?>
                    <dl class="layui-nav-child ">
                        <dd <?php if($v2['id']==input('ty',0)){?>class="layui-nav-itemed"<?php }?>>
                            <a href="<?php echo $url2;?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $v2['catname']; ?></a>
                        <?php if($count2){$_result=get_table_list('sort',' AND pid='.$v2['id'].'','id,catname,sort_a,sort_c');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;?>
                            <dl class="layui-nav-child">
                                <dd <?php if($v3['id']==input('tty',0)){?>class="layui-nav-itemed"<?php }?>>
                                    <a href="<?php echo URL('Sort/Action',"pid=".$v1['id']."&ty=".$v2['id']."&tty=".$v3['id']."")?>"><i class="fa fa-file-text-o" aria-hidden="true"></i><?php echo $v3['catname']; ?></a>
                                </dd>
                            </dl>
                            <?php endforeach; endif; else: echo "" ;endif; }?>
                        </dd>
                    </dl>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

	<div class="layui-body">
	<div class="layui-tab layui-tab-brief" lay-filter="tab">
		<ul class="layui-tab-title">
			<li class="layui-this"><a href="<?php echo url('Model/Index'); ?>">模型列表</a></li>
			<li><a href="<?php echo url('Model/Add'); ?>">模型添加</a></li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<table class="layui-table">
					<thead>
					<tr>
						<th>序号|ID</th>
						<th>名称</th>
						<th>字段</th>
						<th>状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
						<tr>
							<td><?php echo $i; ?>|<?php echo $v['id']; ?></td>
							<td><?php echo $v['model_name']; ?></td>
							<td><?php echo get_model_name($v['model_fields']); ?></td>
							<td>
								<?php if($v['status']==1){?>
								<a href='<?php echo url('Model/Audit',"id=".$v['id'].""); ?>'><i class='fa fa-toggle-on' title="点击关闭"></i></a>
								<?php }else{?>
								<a href='<?php echo url('Model/Audit',"id=".$v['id'].""); ?>'><i class='fa fa-toggle-off' title="点击开启"></i></a>
								<?php }?>
							</td>
							<td>
								<a href='<?php echo url('Model/Add',"id=".$v['id'].""); ?>'  class='layui-btn layui-btn-xs'>修改</a>
								<a href='<?php echo url('Model/Del',"id=".$v['id'].""); ?>' onclick='return confirm("您确定要删除模块么？")' class='layui-btn layui-btn-xs layui-btn-danger' title='删除'>删除</a>
							</td>
						</tr>
					<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<div class="page">
					<?php echo $list->render(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

	<div class="layui-footer">
	<!-- 底部固定区域 -->
	&copy; <a href="../" target="_blank"><?php echo sys('sys_sitename'); ?> 版权所有</a> - <a href="http://www.9-xin.com" target="_blank">技术支持:久鑫网络 JXCMS V0.0.1</a>
 </div>
<script type="text/javascript" src="/public/static/admin/layui/layui.all.js?v=v2.4.5"></script>
<script type="text/javascript" src="/public/static/admin/js/comm.js?v=v1.3.6"></script>
<script type="text/javascript" src="/public/static/admin/js/mylayui.js?v=v1.3.5"></script>

<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</div>

</body>
</html>
