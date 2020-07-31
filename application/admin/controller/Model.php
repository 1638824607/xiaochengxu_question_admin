<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Model extends Purview {

	//显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db=Db::name('model');

		$list = $db->order('disorder asc,id asc')->paginate(20);

 		$this->assign('list',$list);
        return $this->fetch();
    }
 
	
	//添加&&编辑
    public function Add(){
        $db=Db::name('model');
		$id=input('id',0);
 		$model_fields=config('database.model_fields');
 		$v=$db->find($id);
 		if($v){

        }else{
            $v['status']=1;
            $v['disorder']=$db->max('disorder')+5;
        }
		$arr=get_frm_out_put($model_fields,"model_fields","checkbox",$v['model_fields'],"","");
		if($this->request->isPost()){

  			$_POST['model_fields']=implode(",",input('model_fields/a'));
			if (in_array("10",input('model_fields/a'))) $_POST['ispic']=1;else $_POST['ispic']=0;
            Cache::set("model_{$id}",$_POST);//存入缓存
            if($id){
                if($db->update($_POST)!== false){
                    sys_log("编辑模块名称:{$_POST['model_name']}(id:$id)");
                    $this->success("编辑成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }else{
                if($id=$db->insert($_POST)){
                    sys_log("添加模块名称:{$_POST['model_name']}(id:$id)");
                    $this->success("添加成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }
			$this->error($db->getError());
		}
        $this->assign("v",$v);
		$this->assign("model_fields",$arr);
        return $this->fetch();
    }
	

	//审核
	public function Audit($id){
        $db=Db::name('model');
		$list=$db->field("status")->find($id);
		$status=$list['status'];
		$_POST['id']=$id;
		$_POST['status']= $status ? 0 : 1;
        if($db->update($_POST)!== false){
            sys_log("审核模块:(id:$id)");
            $this->success("审核成功",Cookie::get('Jumpurl'));
            exit();
        }
		$this->error($db->getError());
	}
	
	//删除
	public function Del(){
        $db=Db::name('model');
		$id=input('id',0);
		if($id){
            Cache::rm("model_{$id}");//删除缓存
			if($db->delete($id)){
 				sys_log("删除模块:(id:$id)");
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