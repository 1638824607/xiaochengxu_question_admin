<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;

class Admin extends Purview {
 	public function head(){
        return $this->fetch();
    }

    public function left(){
		$db=Db::name('sort');
		if(Session::get('admin_role_auth_ids')==0&&Session::get('admin_role_auth_ac')==0) $wheres="";else $wheres=" AND id in(".Session::get('admin_role_auth_ids').")";
		$list1=$db->field("*")->where("pid=0 AND status=1{$wheres}")->order('disorder')->select();
		$arr1=$db->field('id')->where("pid=0")->select();
 		$pids=$db->sonPath(0);
 		$tys=$db->sonPath($pids);

		$list2=$db->field("*")->where("status=1 AND pid in(".$pids."){$wheres}")->order('disorder')->select();
		$list3=$db->field("*")->where("status=1 AND pid in(".$tys."){$wheres}")->order('disorder')->select();

		foreach($list2 as $key2=>$arr2){
			$count=$db->where("pid={$arr2['id']}")->count();
 			$list2[$key2]['count']=$count;
		}

		$this->assign("list1",$list1);
 		$this->assign("list2",$list2);
 		$this->assign("list3",$list3);
        return $this->fetch();
    }
    public function main(){
        return $this->fetch();
    }

    public function Index(){

        $info = array(
            '服务器名'=>$_SERVER["SERVER_NAME"],
            '服务器IP'=>gethostbyname($_SERVER['SERVER_NAME']),
            '服务器端口'=>$_SERVER["SERVER_PORT"],
            '网站文档目录'=>$_SERVER["DOCUMENT_ROOT"],
            '浏览器信息'=>substr($_SERVER['HTTP_USER_AGENT'], 0, 40),
            '通信协议'=>$_SERVER['SERVER_PROTOCOL'],
            '请求方法'=>$_SERVER['REQUEST_METHOD'],

            '服务器时间'=>date("Y年m月d日H点i分s秒"),
            'PHP版本'=>PHP_VERSION,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '操作系统'=>PHP_OS,
            '脚本超时时间'=>get_cfg_var("max_execution_time").'秒',
            '站点物理路径'=>realpath("../"),
            '脚本上传文件大小限制'=>get_cfg_var("upload_max_filesize")?get_cfg_var("upload_max_filesize"):"不允许上传附件",
            'POST提交内容限制'=>get_cfg_var("post_max_size"),
            '服务器语种'=>getenv("HTTP_ACCEPT_LANGUAGE"),
            '脚本运行时可占最大内存'=>get_cfg_var("memory_limit")?get_cfg_var("memory_limit"):"无",
            '剩余空间'=>round((disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
        );
        $this->assign('list',$info);
        return $this->fetch();
    }

    public function logout(){
        Session::set('admin_id',null);
        Session::set('admin_username',null);
        Session::set('admin_userpwd',null);
        Session::set('admin_role_name',null);
 		$this->success("退出成功",URL("login/index"));
		exit();
     }
}
?>