<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class User extends Purview {

	//首页
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
		$db=Db::name('users');

		$list = $db->paginate(20);
        $page = $list->render();
        $list = $list->all();
        foreach($list as $k=>$v){
            $list[$k]['wechat'] = 'wx';
        }
        $this->assign('list',$list);
        $this->assign('page',$page);

        return $this->fetch();
    }
 
	
	//详情
    public function info(){
        $db=Db::name('users');
        $id=input('id',0);
        if($id)
        {
            $userRow = $db->find($id);
            return $this->fetch();
        }else{
            $this->error('请选择用户!');
        }
    }
	
	//删除
	public function Del(){
        $db=Db::name('users');
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($db->delete($id)){
 				sys_log("删除用户:(id:$id)");
				$this->success("删除成功",Cookie::get('Jumpurl'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除用户!');
		}
	}
}
