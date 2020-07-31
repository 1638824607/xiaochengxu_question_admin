<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cache;

class Settings extends Purview {
    //显示
    public function Index(){
		$db=Db::name('config');
 		$list1=$db->where("typeid=1")->select();
 		$list2=$db->where("typeid=2")->select();
		$list3=$db->where("typeid=3")->select();
		$list4=$db->where("typeid=4")->select();
        $list6=$db->where("vartype=2")->select();
 		$this->assign("list1",$list1);
		$this->assign("list2",$list2);
		$this->assign("list3",$list3);
		$this->assign("list4",$list4);
        $this->assign("list6",$list6);
        return $this->fetch();
    }
	
	//添加
	public function Add(){
        $db=Db::name('config');
		if($this->request->isPost()){
			$_POST['typeid']=1;
            if($id=$db->insert($_POST)){
                sys_log("添加配置信息:(id:$id)");
                $this->success("添加成功",url("Settings/Index"));
                exit();
            }
			$this->error($db->getError());
		}
	}
	
	//更新
	public function Update(){
        $db=Db::name('config');
        $tableprefix=config('database.prefix');
 		foreach($_POST as $k=>$v){
			$sql="UPDATE {$tableprefix}config SET `varvalue`='$v' WHERE varname='$k'";
			if(Db()->execute($sql)){
 			} 
			if($k<>'dosubmit') Cache::set($k,$v);
		}
		sys_log("编辑配置信息");
		$this->success("修改成功",url("Settings/Index"));
		exit();
	}
	
	//获取地图
	public function Map(){
		$result=input('result');
 		if($this->request->isPost()){
			echo "<script>window.opener.document.myform3.sys_ll.value='".$result."'</script>";
			echo "<script language=\"javascript\">
			window.alert(\"筛选成功!\");
			window.close();
			</script>";
		}
        return $this->fetch();
	}
	
}

?>