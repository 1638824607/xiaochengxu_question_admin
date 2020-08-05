<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Manager extends Purview {

	//显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db=Db::name('manager');

		$list = $db->paginate(20);
 		$this->assign('list',$list);
        return $this->fetch();
    }
 
	
	//添加&&编辑
    public function Add(){
        $db=Db::name('manager');
		$id=input('id',0);
  		$v=$db->find($id);
  		if($v){
        }else{
            $v['status']=1;
        }
 		if($this->request->isPost()){
            $_POST['password']=md5(input('post.password'));
            $_POST['sendtime']=time();
            Cache::set("role_{$id}",$_POST);//存入缓存
            if($id){
                if($db->update($_POST)!== false){
                    sys_log("编辑系统用户:{$_POST['username']}(id:$id)");
                    $this->success("编辑成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }else{
                $username=$_POST['username'];
                $count=$db->where("username='$username'")->count();
                if($count){
                    $this->error("用户名已存在,请重新输入",Cookie::get('Jumpurl'));
                    exit();
                }
                if($id=$db->insert($_POST)){
                    sys_log("添加系统用户:{$_POST['username']}(id:$id)");
                    $this->success("添加成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }
            $this->error($db->getError());
		}
        $this->assign("v",$v);
        return $this->fetch();
    }

    //更新
    public function Person(){
        $db=Db::name('manager');
        $oldpwd=md5(input('post.oldpwd'));
        $admin_id=Session::get('admin_id');
        $v=$db->find($admin_id);
        $count=$db->where("id={$admin_id} AND password='$oldpwd'")->count();
        if($this->request->isPost()){
            if($count<1){
                $this->error("原密码错误！");
            }
            $_POST['id']=$admin_id;
            $_POST['password']=md5(input('post.newpwd'));
            $_POST['sendtime']=time();
            if($db->update($_POST)!== false){
                sys_log("修改密码:{$_POST['username']}(id:$admin_id)");
                $this->success("修改成功！",url('Manager/Person'));
                exit();
            }
            $this->error($db->getError());
        }
        $this->assign("v",$v);
        return $this->fetch();
    }

	//审核
	public function Audit($id){
        $db=Db::name('manager');
		$list=$db->field("status")->find($id);
		$status=$list['status'];
		$_POST['id']=$id;
		$_POST['status']= $status ? 0 : 1;
        if($db->update($_POST)!== false){
            sys_log("审核系统用户:(id:$id)");
            $this->success("审核成功",Cookie::get('Jumpurl'));
            exit();
        }
		$this->error($db->getError());
	}
	
	//删除
	public function Del(){
        $db=Db::name('manager');
		$id=input('id',0);
		if($id){
            Cache::rm("role_{$id}");//删除缓存
			if($db->delete($id)){
 				sys_log("删除系统用户:(id:$id)");
				$this->success("删除成功",Cookie::get('Jumpurl'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除信息!');
		}
	}

	/*
	 * 个人中心
	 */
	public function info()
    {

        $user =Session::get('userinfo');
        $this->assign('info',$user);
        return $this->fetch();
    }

}
?>