<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;

class Logs extends Purview {

	//显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db = Db::name('logs');
		$list = $db->order('id desc')->paginate(20);
  		
 		$this->assign('list',$list);
         return $this->fetch();
    }

	//删除
	public function Del(){
		$db=Db::name('logs');
		$id=input('id');
		if($id){
            F("model_{$id}",NULL,TEMP_PATH);//删除缓存
			if($db->delete($id)){
 				sys_log("删除日志:(id:$id)");
				$this->success("删除成功",Cookie::get('Jumpurl'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除信息!');
		}
	}
}
?>