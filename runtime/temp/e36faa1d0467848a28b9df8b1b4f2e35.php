<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:39:"application/index\view\about\index.html";i:1592538406;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\index\view\public\header.html";i:1592538099;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\index\view\public\footer.html";i:1592476974;}*/ ?>
<?php

use think\Db;

$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
$PHP_URL=basename($PHP_SELF);

$q=input('q');
$id=input('id',0);
$pid=input('pid',0);
$ty=input('ty',0);
$tty=input('tty',0);
$ttty=input('ttty',0);
$typeid=input('typeid',0);
$game_area=input('game_area',0);
$game_server=input('game_server',0);


$id=input('id',0);

if(request()->controller()=="Index"){
    $pid=0;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}elseif(request()->controller()=="About"){
    $pid=1;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}elseif(request()->controller()=="Service"){
    $pid=2;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}elseif(request()->controller()=="News"||request()->controller()=="Show"){
    $pid=3;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}elseif(request()->controller()=="Contact"){
    $pid=4;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}elseif(request()->controller()=="View"){
    $pid=14;
    $ty=0;
    $tty=input('tty',0);
    $ttty=input('ttty',0);
}

if($id){
    $bd=Db::name('news')->field("pid,ty,tty,ttty,title,seotitle,seokeywords,seodescription")->where("status=1 AND id='$id'")->find();
    if($bd){
        $id=$id;
        $vpid=$bd['pid'];
        cookie('vpid',$vpid,62400);
        $vty=$bd['ty'];
        $vtty=$bd['tty'];
        $vttty=$bd['ttty'];

        $Title=$bd['title'];
        $Seotitle=$bd['seotitle'];
        $Seokeywords=$bd['seokeywords'];
        $Seodescription=$bd['seodescription'];
    }
}elseif($pid&&$id==0){
    if($ty) $zid=$ty; else $zid=$pid;
    $vtty=$tty;
    $vttty=$ttty;
    $bd=Db::name('sort')->field("catname,seotitle,seokeywords,img1,seodescription")->where("status=1 AND id='$zid'")->find();
    if($bd){
        if($pid) $vpid=$pid;
        if($ty) $vty=$ty;else $vty=$zid;
        $banner_img=$bd['img1'];
        $Title=$bd['catname'];
        $Seotitle=$bd['seotitle'];
        $Seokeywords=$bd['seokeywords'];
        $Seodescription=$bd['seodescription'];
    }
}elseif($id==0){
    $vpid=0;
    $Seotitle=sys('sys_seotitle');
    $Seokeywords=sys('sys_seokeywords');
    $Seodescription=sys('sys_seodescription');
}
if($Custitle){
    $Seotitle=$Custitle.'_';
}else{
    if($Title) $Seotitle=$Title.'_';elseif($Seotitle) $Seotitle=$Seotitle.'_';else $Seotitle="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <meta http-equiv="Cache-Control" content="no-transform">
    <title><?php echo $Seotitle; ?><?php echo sys('sys_sitename'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta name="keywords" content="<?php echo $Seokeywords; ?>" />
    <meta name="description" content="<?php echo $Seodescription; ?>" />

    <link rel="stylesheet" href="/public/static/css/main.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/public/static/css/swiper.min.css" type="text/css">

</head>
<body>

<div class="top">
    <div class="content zj_Scrool">
        <div class="bd">
            <p>欢迎光临<?php echo sys('sys_sitename'); ?>，我们竭诚为您服务！    全国服务热线：<?php echo sys('sys_phone'); ?></p>
        </div>
    </div>
</div>

<div class="container-fluid topnav">
    <div class="content">
        <h4><a href="./"><img src="/public/static/images/logo.png"/></a></h4>
        <ul>
            <li>
                <img src="/public/static/images/con1.png"/>
                <span>营业时间<p><?php echo sys('sys_fax'); ?></p></span>
            </li>
            <li>
                <img src="/public/static/images/con2.png"/>
                <span>全国服务热线<p><?php echo sys('sys_phone'); ?></p></span>
            </li>
            <li>
                <img src="/public/static/images/con3.png"/>
                <span>公司门店地址<p><?php echo sys('sys_address'); ?></p></span>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div class="content">
        <div class="topmenu">
            <ul>
                <li <?php if(request()->controller()=="Index"): ?> class="topmenunow"<?php endif; ?> ><a href="<?php echo url('index/index/index'); ?>">首页</a></li>
                <li <?php if(request()->controller()=="About"): ?> class="topmenunow"<?php endif; ?> ><a href="<?php echo url('index/about/index'); ?>">关于我们</a></li>
                <li <?php if(request()->controller()=="Service"): ?> class="topmenunow"<?php endif; ?> ><a href="<?php echo url('index/service/index'); ?>">服务支持</a></li>
                <li <?php if(request()->controller()=="News"): ?> class="topmenunow"<?php endif; ?> ><a href="<?php echo url('index/news/index'); ?>">新闻中心</a></li>
                <li <?php if(request()->controller()=="Contact"): ?> class="topmenunow"<?php endif; ?> ><a href="<?php echo url('index/contact/index'); ?>">联系我们</a></li>
            </ul>
            <a href="/en"><span>英文</span></a>
        </div>
    </div>
</div>
<?php if(request()->controller()=="Index"): ?>
<div class="container-fluid">
    <div class="swiper-container" id="swiper1">
        <div class="swiper-wrapper">
            <?php $_result=get_news(5,13,0,0,'*',10);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <div class="swiper-slide" style="background: url(<?php echo $v['img1']; ?>) center top no-repeat;"><a href="<?php echo $v['linkurl']; ?>"></a></div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php else: ?>

<div class="container-fluid nybanner" style="background: url(<?php echo get_zd_name('img1','sort'," id=".$pid .""); ?>) center top no-repeat;">
    <a href="#"></a>
</div>
<?php endif; ?>


    <div class="container-fluid">
        <div class="content">
            <div class="gywmtit1">
                <dl>
                    <dt>
                        <h4><?php echo get_zd_name("catname","sort"," id=6 "); ?><p><?php echo get_zd_name("encatname","sort"," id=6 "); ?></p></h4>
                        <span><?php echo get_single_content(1,6,0,0,'content')['content']; ?></span>
                    </dt>
                    <dd><img src="<?php echo get_zd_name("img1","news"," pid=1 and ty=6 "); ?>"/></dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="container-fluid gywmtit2bg">
        <div class="content">
            <div class="title"><?php echo get_zd_name("catname","sort"," id=7 "); ?><p><?php echo get_zd_name("encatname","sort"," id=7 "); ?></p></div>
            <div class="gywmtit2">
                <dl>
                    <?php $_result=get_news(1,7,0,0,'*',1,0);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <dt>
                        <h4><?php echo $v['title']; ?></h4>
                        <p><?php echo $v['introduce']; ?></p>
                    </dt>
                    <?php endforeach; endif; else: echo "" ;endif; $_result=get_news(1,7,0,0,'*',1,1);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <dd>
                        <h4><?php echo $v['title']; ?></h4>
                        <p><?php echo $v['introduce']; ?></p>
                    </dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <dl style="margin-top: 130px;">
                    <?php $_result=get_news(1,7,0,0,'*',1,2);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <dt style="width: 420px;">
                        <h4><?php echo $v['title']; ?></h4>
                        <p><?php echo $v['introduce']; ?></p>
                    </dt>
                    <?php endforeach; endif; else: echo "" ;endif; $_result=get_news(1,7,0,0,'*',1,3);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <dd style="width: 420px;">
                        <h4><?php echo $v['title']; ?></h4>
                        <p><?php echo $v['introduce']; ?></p>
                    </dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="content">
            <div class="title"><?php echo get_zd_name("catname","sort"," id=8 "); ?><p><?php echo get_zd_name("encatname","sort"," id=8 "); ?></p></div>
            <div class="swiper-container" id="swiper4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="gywmtit3">
                            <ul>
                                <?php $_result=get_news(1,8,0,0,'*',3,0);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li><a><img src="<?php echo $v['img1']; ?>"/><h4><?php echo $v['title']; ?></h4></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gywmtit3">
                            <ul>
                                <?php $_result=get_news(1,8,0,0,'*',3,3);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li><a><img src="<?php echo $v['img1']; ?>"/><h4><?php echo $v['title']; ?></h4></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="gywmtit3">
                            <ul>
                                <?php $_result=get_news(1,8,0,0,'*',3,6);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li><a><img src="<?php echo $v['img1']; ?>"/><h4><?php echo $v['title']; ?></h4></a></li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid gywmtit4bg">
    <div class="content">
        <div class="title"><?php echo get_zd_name("catname","sort"," id=9 "); ?><p><?php echo get_zd_name("encatname","sort"," id=9 "); ?></p></div>
        <div class="gywmtit4">
            <ul>
                <?php $_result=get_news(1,9,0,0,'*',3,0);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('/index/view/index',"id=".$v['id'].""); ?>"><img src="<?php echo $v['img1']; ?>"/><h4><?php echo $v['title']; ?></h4></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul>
                <?php $_result=get_news(1,9,0,0,'*',4,3);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <li><a href="<?php echo url('/index/view/index',"id=".$v['id'].""); ?>"><img src="<?php echo $v['img1']; ?>"/><h4><?php echo $v['title']; ?></h4></a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>



<div class="container-fluid fooder">
    <div class="content">
        <div class="ftbd flgo">
            <img src="<?php echo sys('sys_img3'); ?>"/>
        </div>
        <div class="ftbd">
            <div class="fnav">
                <ul>
                    <li><a href="<?php echo url('index/index/index'); ?>">首页</a></li>
                    <li><a href="<?php echo url('index/about/index'); ?>">关于我们</a></li>
                    <li><a href="<?php echo url('index/service/index'); ?>">服务支持</a></li>
                    <li><a href="<?php echo url('index/news/index'); ?>">新闻中心</a></li>
                    <li><a href="<?php echo url('index/contact/index'); ?>">联系我们</a></li>
                </ul>
            </div>
        </div>
        <div class="ftbd">
            <div class="fweixin">
                <img src="<?php echo sys('sys_img4'); ?>"/>
                <p>扫一扫  关注我们</p>
            </div>
        </div>
        <div class="fcon">
            <h5>联系我们</h5>
            <p><img src="/public/static/images/bt_con1.png"/><em><?php echo sys('sys_test'); ?></em></p>
            <p>地址：<?php echo sys('sys_address'); ?></p>
            <p><?php echo sys('sys_copyright'); ?></p>
            <p>技术支持：久鑫网络</p>
        </div>
    </div>
</div>
<!--右侧悬浮菜单-->
<div class="pfu">
    <dl>
        <dt><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo sys('sys_qq'); ?>&amp;menu=yes
" target="_blank"><img src="/public/static/images/pf_con1.png"/><p>在线客服</p></a></dt>
    </dl>
    <dl class="pfuwx">
        <dt><img src="/public/static/images/pf_con2.png"/><p>微信扫描</p></dt>
        <dd><img src="<?php echo sys('sys_img4'); ?>"/></dd>
    </dl>
    <dl class="pfutel">
        <dt><img src="/public/static/images/pf_con3.png"/><p>电话</p></dt>
        <dd><img src="/public/static/images/pf_con3.png"/><em><?php echo sys('sys_test'); ?></em></dd>
    </dl>
</div>

<div id="btn" class="index_cy"></div>

<script src="/public/static/js/swiper.min.js"></script>

<script src="/public/static/js/jquery.js"></script>

<script src="/public/static/js/jquery.SuperSlide.js"></script>

<script type="text/javascript">
    var mySwiper = new Swiper('#swiper1', {
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    var mySwiper = new Swiper('#swiper2', {
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    var mySwiper = new Swiper('#swiper3', {
        autoplay: {
            delay: 4000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });
    //排行版滚动
    $(function(){
        jQuery(".zj_Scrool").slide({mainCell:".bd",autoPlay:true,effect:"leftMarquee",vis:1,interTime:70});
    });
    $(function(){
        function qiehuan(qhan,qhshow,qhon){
            $(qhan).click(function(){
                $(qhan).removeClass(qhon);
                $(this).addClass(qhon);
                var i = $(this).index(qhan);
                $(qhshow).eq(i).show().siblings(qhshow).hide();
            });
        }

    });

    //浮动客服
    $(function(){
        $('#btn').click(function(){
            $('.pfu').toggle();
            if($(this).hasClass('index_cy')){
                $(this).removeClass('index_cy');
                $(this).addClass('index_cy2');
            }else{
                $(this).removeClass('index_cy2');
                $(this).addClass('index_cy');
            }
        });
    });

    //弹窗
    var img_index = 0;
    var img_src = "";

    $(function() {
        //计算居中位置
        var mg_top = ((parseInt($(window).height()) - parseInt($(".photo-div").height())) / 2);

        $(".photo-div").css({
            "margin-top": "" + mg_top + "px"
        });
        //关闭
        $(".photo-close").click(function() {
            $(".photo-mask").hide();
            $(".photo-panel").hide();
        });
        //下一张
        $(".photo-panel .photo-div .arrow-next").click(function() {
            img_index++;
            if(img_index >= $(".demo li img").length) {
                img_index = 0;
            }
            img_src = $(".demo li img").eq(img_index).attr("src");
            img_title = $(".demo li img").eq(img_index).attr("title");
            photoView($(".demo li img"));
        });
        //上一张
        $(".photo-panel .photo-div .arrow-prv").click(function() {
            img_index--;
            if(img_index < 0) {
                img_index = $(".demo li img").length - 1;
            }
            img_src = $(".demo li img").eq(img_index).attr("src");
            img_title = $(".demo li img").eq(img_index).attr("title");
            photoView($(".demo li img"));
        });
        //如何调用？
        $(".demo li img").click(function() {
            $(".photo-mask").show();
            $(".photo-panel").show();
            img_src = $(this).attr("src");
            img_title = $(this).attr("title");
            img_index = $(this).index();
            photoView($(this));
        });

    });
    //自适应预览
    function photoView(obj) {
        if($(obj).width() >= $(obj).height()) {
            $(".photo-panel .photo-div .photo-img .photo-view-h").attr("class", "photo-view-w");
            $(".photo-panel .photo-div .photo-img .photo-view-w img").attr("src", img_src);
            var p_text = document.getElementById("p_text")
            p_text.innerHTML = img_title;
//				$(".photo-panel .photo-div .photo-img .photo-view-w p").innerText = img_title;
//				alert(img_title);
        } else {
            $(".photo-panel .photo-div .photo-img .photo-view-w").attr("class", "photo-view-h");
            $(".photo-panel .photo-div .photo-img .photo-view-h img").attr("src", img_src);
        }
        //此处写调试日志
        console.log(img_index);
    }

</script>

<script type="text/javascript">
    var mySwiper = new Swiper('#swiper1', {
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    var mySwiper = new Swiper('#swiper2', {
        autoplay: {
            delay: 3000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    var mySwiper = new Swiper('#swiper3', {
        autoplay: {
            delay: 4000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    var mySwiper = new Swiper('#swiper4', {
        autoplay: {
            delay: 4000,
            stopOnLastSlide: false,
            disableOnInteraction: false,
        },
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            bulletClass: 'my-bullet',
            //需设置.my-bullet样式
            bulletActiveClass: 'my-bullet-active',
        },
    });

    $(function(){
        //排行版滚动
        jQuery(".zj_Scrool").slide({mainCell:".bd",autoPlay:true,effect:"leftMarquee",vis:1,interTime:70});
    });
    $(function(){
        function qiehuan(qhan,qhshow,qhon){
            $(qhan).click(function(){
                $(qhan).removeClass(qhon);
                $(this).addClass(qhon);
                var i = $(this).index(qhan);
                $(qhshow).eq(i).show().siblings(qhshow).hide();
            });
        }

    });
</script>