<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class User extends Purview {

	//显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
		$db=Db::name('role');

		$list = $db->paginate(20);
 		$this->assign('list',$list);

        return $this->fetch();
    }
 
	
	//添加&&编辑
    public function Add(){
//        $db=Db::name('role');
//		$id=input('id',0);
//  		$v=$db->find($id);
//  		if($v){
//            $v['role_auth_ids']=explode(",",$v['role_auth_ids']);
//        }else{
//            $v['status']=1;
//            $v['role_auth_ids']=array();
//        }
// 		if($this->request->isPost()){
//  		    $auth_ids=implode(",",input('post.role_auth_ids/a'));//把数组分割成字符串
//            if($auth_ids){
//                $pids=role_auth_ids($auth_ids);
//                $_POST['role_auth_ids']=$auth_ids.$pids;
//            }
//            $_POST['sendtime']=time();
//
//            if($id){
//                if($db->update($_POST)!== false){
//                    Cache::set("role_{$id}",$_POST);//存入缓存
//                    sys_log("编辑角色名称:{$_POST['role_name']}(id:$id)");
//                    $this->success("编辑成功",Cookie::get('Jumpurl'));
//                    exit();
//                }
//            }else{
//                if($id=$db->insert($_POST)){
//                    Cache::set("role_{$id}",$_POST);//存入缓存
//                    sys_log("添加角色名称:{$_POST['role_name']}(id:$id)");
//                    $this->success("添加成功",Cookie::get('Jumpurl'));
//                    exit();
//                }
//            }
//
//			$this->error($db->getError());
//		}
//
//        $this->assign("v",$v);
//        return $this->fetch();
    }
	

	//审核
	public function Audit($id){
//        $db=Db::name('role');
//		$list=$db->field("status")->find($id);
//		$status=$list['status'];
//		$_POST['id']=$id;
//		$_POST['status']= $status ? 0 : 1;
//        if($db->update($_POST)!== false){
//            sys_log("审核角色:(id:$id)");
//            $this->success("审核成功",Cookie::get('Jumpurl'));
//            exit();
//        }
//		$this->error($db->getError());
	}
	
	//删除
	public function Del(){
//        $db=Db::name('role');
//		$id=input('id',0);
//		if($id){
//            Cache::rm("role_{$id}");//删除缓存
//			if($db->delete($id)){
// 				sys_log("删除角色:(id:$id)");
//				$this->success("删除成功",Cookie::get('Jumpurl'));
//				exit();
//			}else{
//				$this->error("删除失败");
//			}
//		}else{
//			$this->error('请选择删除信息!');
//		}
	}
}
?>