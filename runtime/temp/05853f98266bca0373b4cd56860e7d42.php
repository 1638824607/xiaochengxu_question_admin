<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"F:\phpStudy\PHPTutorial\WWW\think5\public/../application/index\view\index\index.html";i:1589168346;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\index\view\public\header.html";i:1589168005;s:76:"F:\phpStudy\PHPTutorial\WWW\think5\application\index\view\public\footer.html";i:1588832068;}*/ ?>
<?php $Custitle='自定义标题';

$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
$PHP_URL=basename($PHP_SELF);

$id=input('id',0);
$pid=input('pid',0);
$ty=input('ty',0);
$tty=input('tty',0);
$ttty=input('ttty',0);

if($id){
 	$bd=Db::name('news')->field("pid,ty,tty,ttty,title,seotitle,seokeywords,seodescription")->where("status=1 AND id=<?php echo $id; ?>")->find();
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
    //if($pid&&$ty)$zid=$ty;elseif($pid&&empty($zid)) $zid=$pid;
    //if($ty) $zid=$ty; else $zid=get_nextid($pid);
    if($ty) $zid=$ty; else $zid=$pid;
    $vtty=$tty;
    $vttty=$ttty;
    $bd=Db::name('sort')->field("catname,seotitle,seokeywords,img1,seodescription")->where("status=1 AND id=<?php echo $zid; ?>")->find();
    if($bd){
        if($pid) $vpid=$pid;
        if($ty) $vty=$ty;else $vty=$zid;
        $banner_img=$bd['img1'];
        $Title=$bd['catname'];
        $Seotitle=$bd['seotitle'];
        $Seokeywords=$bd['seokeywords'];
        $Seodescription=$bd['seodescription'];
    }
    //print_r($bd);
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
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $Seotitle; ?><?php echo sys('sys_sitename'); ?></title>
    <meta name="keywords" content="<?php echo $Seokeywords; ?>" />
    <meta name="description" content="<?php echo $Seodescription; ?>" />
    <meta name="viewport" content="width=device-width">
    <link href="static/css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="static/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="static/js/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="static/js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="static/js/jquery.superslide.js"></script>
    <script src="static/js/common.js" type="text/javascript"></script>
</head>
<body>
header<br>

    <?php $_result=get_news(2,12,0,0,'*',1);if(is_array($_result) || $_result instanceof \think\Collection || $_result instanceof \think\Paginator): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
       标题:<?php echo $v['title']; ?><br>
    <?php endforeach; endif; else: echo "" ;endif; ?>
footer