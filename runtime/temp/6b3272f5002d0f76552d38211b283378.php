<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:39:"application/admin\view\News\Single.html";i:1591600356;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\header.html";i:1588911510;s:74:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\left.html";i:1588817206;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\admin\view\Public\footer.html";i:1588130548;}*/ ?>
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
<script charset="utf-8" src="/public/static/admin/myeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/public/static/admin/myeditor/lang/zh_CN.js"></script>
<script>
    KindEditor.ready(function(K) {
        var editor1 = K.create('.editor_id', {
            filterMode: false,//是否开启过滤模式
            cssPath : '/public/static/admin/myeditor/plugins/code/prettify.css',
            uploadJson : '/public/static/admin/myeditor/php/upload_json.php',
            fileManagerJson : '/public/static/admin/myeditor/php/file_manager_json.php',
            allowFileManager : true,
            afterBlur : function() {
                this.sync();
                K.ctrl(document, 13, function() {
                    K('form[name=formlist]')[0].submit();
                });
                K.ctrl(this.edit.doc, 13, function() {
                    K('form[name=formlist]')[0].submit();
                });
            }
        });

        var editor = K.editor({
            allowFileManager : true
        });
        <?php $__FOR_START_10749__=1;$__FOR_END_10749__=$v['imgnum'];for($i=$__FOR_START_10749__;$i < $__FOR_END_10749__;$i+=1){ ?>
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
		<?php } if(in_array(11,$arr)): ?>
            K('#insert_file1').click(function() {
                editor.loadPlugin('insertfile', function() {
                    editor.plugin.fileDialog({
                        fileUrl : K('#file1').val(),
                        clickFn : function(url, title) {
                            K('#file1').val(url);
                            editor.hideDialog();
                        }
                    });
                });
            });
		<?php endif; if(in_array(16,$arr)): ?>
            K('#images').click(function() {
                editor.loadPlugin('multiimage', function() {
                    editor.plugin.multiImageDialog({
                        clickFn : function(urlList) {
                            var div = K('#imagesview');
                            div.html('');
                            var urls = '';
                            K.each(urlList, function(i, data) {
                                div.append('<div style="width: 100px; float:left; padding-right: 10px;"><img src="' + data.url + '" width="100"><br><input type="text" placeholder="输入图片标题"  name="titles[]" class="layui-input"><br><input type="text" placeholder="输入图片描述"  name="remark[]" class="layui-input"></div>');
                                urls = urls+data.url+'|';
                            });

                            $("#imgurl").val(urls);
                            editor.hideDialog();
                        }
                    });
                });
            });
		<?php endif; ?>
    });


    $(document).ready(function(){
        $(".delete").click(function(){
            var v=this.title;
            $.get('/Admin-News-Titlepic-id-'+v+".html",null,function(data){
                $(".img"+v).remove();
            });
        })
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
				<li class="layui-this" lay-id="t1"><?php echo $v['catname']; ?>编辑</li>
			</ul>

 			<div class="layui-tab-content">
				<div class="layui-tab-item layui-show">
					<form action="" method="post" class="layui-form" lay-filter="content" id="edit">
						<input type="hidden" name="id" value="<?php echo $v['id']; ?>">
						<input type="hidden" name="pid" value="<?php echo $v['pid']; ?>">
						<input type="hidden" name="ty" value="<?php echo $v['ty']; ?>">
						<input type="hidden" name="tty" value="<?php echo $v['tty']; ?>">
						<input type="hidden" name="ttty" value="<?php echo $v['ttty']; ?>">

						<?php if(in_array(1,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">信息标题</label>
								<div class="layui-input-inline">
									<input type="text" name="title" value="<?php echo $v['title']; ?>" required lay-verify="required" placeholder="请输入内容标题" class="layui-input">
								</div>

								<?php if(in_array(3,$arr)): ?><input type="checkbox" class="checkbox" lay-skin='primary' name="isgood" value="1" title="推荐" {my:get_my_checked($v['isgood'],1)}><?php endif; if(in_array(4,$arr)): ?><input type="checkbox" class="checkbox" lay-skin='primary' name="istop" value="1" title="置顶" {my:get_my_checked($v['istop'],1)}><?php endif; ?>

							</div>
						<?php endif; if(in_array(2,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">信息标签</label>
								<div class="layui-input-inline">
									<input type="text" name="tags" value="<?php echo $v['tags']; ?>" placeholder="请输入信息标签" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(5,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">外部链接</label>
								<div class="layui-input-inline">
									<input type="text" name="linkurl" value="<?php echo $v['linkurl']; ?>" placeholder="请输入外部链接" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(6,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">内容摘要</label>
								<div class="layui-input-inline">
									<textarea name="introduce" style="width:520px;height:100px;" class="layui-textarea"><?php echo $v['introduce']; ?></textarea>
								</div>
							</div>
						<?php endif; if(in_array(7,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">SEO关键字</label>
								<div class="layui-input-inline">
									<input type="text" name="seokeywords" value="<?php echo $v['seokeywords']; ?>" placeholder="请输入SEO关键字" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(8,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">SEO描述</label>
								<div class="layui-input-inline">
									<textarea name="seodescription" style="width:520px;height:100px;" class="layui-textarea"><?php echo $v['seodescription']; ?></textarea>
								</div>
							</div>
						<?php endif; if(in_array(9,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">内容详情</label>
								<div class="layui-input-block">
									<textarea class="editor_id" name="content" style="width:667px;height:350px;"><?php echo $v['content']; ?></textarea>
								</div>
							</div>
						<?php endif; if(in_array(10,$arr)): ?>
							<for start="1" end="$v['imgnum']">
							<?php $zd="img$i";?>
							<div class="layui-form-item">
								<label class="layui-form-label">{my:get_imgname($i,$v['pid'],$v['ty'],$v['tty'])}</label>
								<div class="layui-input-inline">
									<input type="text" name="img<?php echo $i; ?>" id="img<?php echo $i; ?>" value="<?php echo $v[$zd]; ?>" placeholder="请上传配置图片"  class="layui-input">
								</div>
								<button type="button" id="img{my$i}_btn" class="layui-btn" data-des="ico">
									<i class="layui-icon">&#xe67c;</i>上传图片
								</button>
								<font color="red">图片大小:<?php echo get_cfg_var("post_max_size"); ?>内,图片尺寸：<?php echo get_imgsize($i,$v['pid'],$v['ty'],$v['tty']); ?>px</font>
							</div>
							</for>
						<?php endif; if(in_array(16,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">批量上传</label>
								<button type="button" id="images" class="layui-btn" data-des="pics">
									<i class="layui-icon">&#xe67c;</i>上传多图
								</button>
								<font color="red">图片大小:<?php echo get_cfg_var("post_max_size"); ?>内,图片尺寸：<?php echo get_sort_zd($v['zid'],'titleimgsize'); ?>px</font>
							</div>
							<input type="hidden" name="images" value="" id="imgurl">
							<div id="imagesview" class="pic addedit">
								<?php $_result=get_titlepic($v['id']);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
								<div style="margin-right:8px; position:relative;display:inline-block;" class="img<?php echo $vv['id']; ?>">
									<a href='<?php echo get_img($vv['img1']); ?>' target='_blank' >
										<img width="150" src="<?php echo get_img($vv['img1']); ?>">
									</a>
									<input type="hidden" value="<?php echo $vv['id']; ?>"  name="ids[]">
									<br><input type="text" value="<?php echo $vv['title']; ?>" placeholder="输入图片标题"  name="titles[]" class="layui-input">
									<br><input type="text" value="<?php echo $vv['remark']; ?>" placeholder="输入图片描述"  name="remark[]" class="layui-input">
									<span class="titlepicdel" title="<?php echo $vv['id']; ?>" style="position: absolute;right:0; top:0;display:inline-block; width:20px; height:20px; background:#000; color:#FFF;line-height:20px; font-size:20px; text-align:center;cursor:pointer;">×</span>
								</div>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</div>
						<?php endif; if(in_array(11,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">文件上传</label>
								<div class="layui-input-inline">
									<input type="text" name="file1" id="file1" value="<?php echo $v['file1']; ?>" placeholder="请选择文件上传" class="layui-input">
								</div>
								<button type="button" id="insert_file1" class="layui-btn" data-des="enclosure">
									<i class="layui-icon">&#xe67c;</i>上传附件
								</button>

								<font color="#FF0000">文件大小:<?php echo get_cfg_var("post_max_size"); ?></font>
							</div>
						<?php endif; if(in_array(12,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">来源</label>
								<div class="layui-input-inline">
									<input type="text" name="source" value="<?php echo $v['source']; ?>" placeholder="请输入来源" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(13,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">作者</label>
								<div class="layui-input-inline">
									<input type="text" name="author" value="<?php echo $v['author']; ?>" placeholder="请输入作者" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(14,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">价格</label>
								<div class="layui-input-inline">
									<input type="text" name="price" value="<?php echo $v['price']; ?>" placeholder="请输入价格" class="layui-input">
								</div>
							</div>
						<?php endif; if(in_array(15,$arr)): ?>
							<div class="layui-form-item">
								<label class="layui-form-label">人气</label>
								<div class="layui-input-inline">
									<input type="text" name="hits" value="<?php echo $v['hits']; ?>" placeholder="请输入人气" class="layui-input">
								</div>
							</div>
						<?php endif; ?>

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

	<!--感谢网友大淘的贡献-->
	<style>.placeHolder {border:dashed 2px gray; }</style>
	<script type="text/javascript" src="js/jscolor.js"></script>

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
