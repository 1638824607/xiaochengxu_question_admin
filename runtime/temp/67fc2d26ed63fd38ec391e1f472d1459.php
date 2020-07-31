<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:36:"application/admin\view\sort\add.html";i:1588818662;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\header.html";i:1588911510;s:74:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\left.html";i:1588817206;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\footer.html";i:1588130548;}*/ ?>
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
<link href="/public/static/admin/myeditor/themes/default/default.css" rel="stylesheet" type="text/css" />
<script charset="utf-8" src="/public/static/admin/myeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/public/static/admin/myeditor/lang/zh_CN.js"></script>

<script>
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager : true
        });

		<?php $__FOR_START_1191__=1;$__FOR_END_1191__=config('database.BANNER_NUM')+1;for($i=$__FOR_START_1191__;$i < $__FOR_END_1191__;$i+=1){ ?>
        K('#img<?php echo $i; ?>_btn').click(function() {
            editor.loadPlugin('image', function() {
                editor.plugin.imageDialog({
                    imageUrl : K('#img<?php echo $i; ?>').val(),
                    clickFn : function(url, title, width, height, border, align) {
                        K('#img<?php echo $i; ?>').val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
		<?php } ?>
    });
</script>




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
				<li><a href="<?php echo url('Sort/Index'); ?>">栏目列表</a></li>
				<li class="layui-this"><a href="<?php echo url('Sort/Add'); ?>">栏目添加</a></li>
			</ul>
			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<form action="" method="post" class="layui-form" onSubmit="return check_manager_add(this);">
						<input type="hidden" name="id" value="<?php echo $v['id']; ?>">
						<?php if(\think\Session::get('admin_id') == 99999999): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">所属栏目</label>
								<div class="layui-input-inline">
									<select name="pid" lay-filter="model" lay-verify="required">
										<option value="0">无(属一级栏目)</option>
										<?php if(is_array($sort) || $sort instanceof \think\Collection || $sort instanceof \think\Paginator): $i = 0; $__LIST__ = $sort;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $s['id']; ?>" <?php if($s['id'] == $v['pid']): ?> selected<?php endif; ?>><?php echo str_repeat("&nbsp;&nbsp;└",$s['count']); ?><?php echo $s['catname']; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">栏目模块</label>
								<div class="layui-input-inline">
									<select name="model_id" lay-filter="model" required lay-verify="required">
										<option value="">请选择</option>
										<?php $_result=get_mytable_list('model');if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?>
											<option value="<?php echo $s['id']; ?>|<?php echo get_model_zd($s['id'],'model_c'); ?>|<?php echo get_model_zd($s['id'],'model_a'); ?>" <?php if($s['id'] == $v['model_id']): ?> selected<?php endif; ?>><?php echo $s['model_name']; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div>
							</div>

						<?php else: ?>
							<input type="hidden" name="pid" value="<?php echo $v['pid']; ?>">
							<input type="hidden" name="model_id" value="<?php echo get_sort_zd($v['pid'],'model_id'); ?>">
							<div class="layui-form-item">
								<label class="layui-form-label">所属栏目</label>
								<div class="layui-input-inline">
									<?php echo get_sort_zd($v['pid']); ?>
								</div>
							</div>
						<?php endif; ?>



						<div class="layui-form-item">
							<label class="layui-form-label">栏目名称</label>
							<div class="layui-input-inline">
								<input type="text" name="catname" value="<?php echo $v['catname']; ?>" lay-verify="required" placeholder="请输入栏目名称" class="layui-input">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">英文名称</label>
							<div class="layui-input-inline">
								<input type="text" name="encatname" value="<?php echo $v['encatname']; ?>" placeholder="请输入英文名称" class="layui-input">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">页面标题</label>
							<div class="layui-input-inline">
								<input type="text" name="seotitle" value="<?php echo $v['seotitle']; ?>" placeholder="请输入页面标题" class="layui-input">
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">页面关键字</label>
							<div class="layui-input-inline">
								<textarea name="seokeywords"  style="width:520px;height:100px;" class="layui-textarea"><?php echo $v['seokeywords']; ?></textarea>
							</div>
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">页面描述</label>
							<div class="layui-input-inline">
								<textarea name="seodescription"  style="width:520px;height:100px;" class="layui-textarea"><?php echo $v['seodescription']; ?></textarea>
							</div>
						</div>


						<?php if(is_array($list2) || $list2 instanceof \think\Collection || $list2 instanceof \think\Paginator): $i = 0; $__LIST__ = $list2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo $v1['varinfo']; ?></label>
								<div class="layui-input-inline">
									<div class="layui-input-inline">
										<input type="text" name="<?php echo $v1['varname']; ?>" id="<?php echo $v1['varname']; ?>" value="<?php echo $v1['varvalue']; ?>" class="layui-input">
									</div>
									<input type="button" id="<?php echo $v1['varname']; ?>_btn" value="选择图片" class="layui-btn"/>
								</div>
							</div>
						<?php endforeach; endif; else: echo "" ;endif; if(\think\Session::get('admin_id') == 99999999): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">所属模板</label>
								<div class="layui-input-inline">
									<input type="text" name="templet" id="templet" value="<?php echo $v['templet']; ?>" required lay-verify="required" placeholder="请输入所属模板" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">控制器</label>
								<div class="layui-input-inline">
									<input type="text" name="sort_c" id="sort_c" value="<?php echo $v['sort_c']; ?>" required lay-verify="required" placeholder="请输入控制器" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">操作方法</label>
								<div class="layui-input-inline">
									<input type="text" name="sort_a" id="sort_a" value="<?php echo $v['sort_a']; ?>" required lay-verify="required" placeholder="请输入操作方法" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">图片数量</label>
								<div class="layui-input-inline">
									<input type="text" name="imgnum" value="<?php echo $v['imgnum']; ?>" placeholder="请输入图片数量" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">图片尺寸</label>
								<div class="layui-input-inline">
									<input type="text" name="imgsize" value="<?php echo $v['imgsize']; ?>" placeholder="请输入图片尺寸 多个用,分割" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">图片名称</label>
								<div class="layui-input-inline">
									<input type="text" name="imgname" value="<?php echo $v['imgname']; ?>" placeholder="请输入图片名称 多个用,分割" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">多图尺寸</label>
								<div class="layui-input-inline">
									<input type="text" name="titleimgsize" value="<?php echo $v['titleimgsize']; ?>" placeholder="请输入多图上传尺寸" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">自定义参数</label>
								<div class="layui-input-inline">
									<input type="text" name="sort_url" id="sort_url" value="<?php echo $v['sort_url']; ?>" placeholder="格式:参数/参数值/参数/参数值" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">外部跳链接</label>
								<div class="layui-input-inline">
									<input type="text" name="outlinkurl" value="<?php echo $v['outlinkurl']; ?>" placeholder="请输入外部跳链接" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">前台文件名</label>
								<div class="layui-input-inline">
									<input type="text" name="inlinkurl" value="<?php echo $v['inlinkurl']; ?>" placeholder="请输入前台文件名" class="layui-input">
								</div>
							</div>

							<div class="layui-form-item">
								<label class="layui-form-label">子栏目权限</label>
								<div class="layui-input-block">
									<input type="radio" name="isopen" value="1" title="开放"  <?php echo get_my_checked($v['isopen'],1); ?>>
									<input type="radio" name="isopen" value="0" title="关闭"  <?php echo get_my_checked($v['isopen'],0); ?>>
								</div>
							</div>
						<?php else: ?>
							<input type="hidden" name="templet" value="<?php echo $v['templet']; ?>">
							<input type="hidden" name="sort_c" value="<?php echo $v['sort_c']; ?>">
							<input type="hidden" name="sort_a" value="<?php echo $v['sort_a']; ?>">
							<input type="hidden" name="imgnum" value="<?php echo $v['imgnum']; ?>">
							<input type="hidden" name="titleimgsize" value="<?php echo $v['titleimgsize']; ?>">
							<input type="hidden" name="imgsize" value="<?php echo $v['imgsize']; ?>">
							<input type="hidden" name="imgname" value="<?php echo $v['imgname']; ?>">
							<input type="hidden" name="sort_p" value="<?php echo $v['sort_p']; ?>">
							<input type="hidden" name="outlinkurl" value="<?php echo $v['outlinkurl']; ?>">
							<input type="hidden" name="inlinkurl" value="<?php echo $v['inlinkurl']; ?>">
							<input type="hidden" name="isopen" value="<?php echo get_sort_zd($v['pid'],'isopen'); ?>">
						<?php endif; $__FOR_START_12593__=1;$__FOR_END_12593__=config('database.BANNER_NUM')+1;for($i=$__FOR_START_12593__;$i < $__FOR_END_12593__;$i+=1){ $zd="img$i";?>
							<div class="layui-form-item">
								<label class="layui-form-label"><?php echo get_banner_imgname($i); ?></label>
								<div class="layui-input-inline">
									<input type="text" name="img<?php echo $i; ?>" id="img<?php echo $i; ?>" value="<?php echo $v[$zd]; ?>" placeholder="请上传配置图片"  class="layui-input">
								</div>
								<button type="button" id="img<?php echo $i; ?>_btn" class="layui-btn" data-des="ico">
									<i class="layui-icon">&#xe67c;</i>上传图片
								</button>
								<font color="red">图片大小:<?php echo get_cfg_var("post_max_size"); ?>内,图片尺寸：<?php echo get_banner_imgsize($i); ?>px</font>
							</div>
						<?php } ?>


						<div class="layui-form-item">
							<label class="layui-form-label">栏目排序</label>
							<div class="layui-input-inline" style="width: 120px;">
								<input type="text" name="disorder" value="<?php echo $v['disorder']; ?>" placeholder="请输入栏目排序" class="layui-input" style="width: 120px;">
							</div>
							数字越小越在前
						</div>

						<div class="layui-form-item">
							<label class="layui-form-label">状态</label>
							<div class="layui-input-block">
								<input type="radio" name="status" value="1" title="启用"  <?php echo get_my_checked($v['status'],1); ?>>
								<input type="radio" name="status" value="0" title="禁用"  <?php echo get_my_checked($v['status'],0); ?>>
							</div>
						</div>

						<div class="layui-form-item">
							<div class="layui-input-block">
								<button class="layui-btn" lay-submit name="dosave">立即提交</button>
								<button type="reset" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</div>

					</form>
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
<script>
    layui.use('form', function(){
        var form = layui.form;
        form.on('select(model)', function(data){
            var v=data.value;
            strs=v.split("|");
            var module_id=$("#module_id").find("option:selected").attr("title");
            if(module_id>0){
                $(".show").show();
            }else{
                $(".show").hide();
            }
            $("#templet").val(strs[1]);
            $("#sort_c").val(strs[1]);
            $("#sort_a").val(strs[2]);
        });
    });

</script>
</body>
</html>