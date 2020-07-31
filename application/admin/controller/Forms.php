<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Forms extends Purview {
	//显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db = Db::name('forms');

		$list = $db->paginate(20);
 		$this->assign('list',$list);
        return $this->fetch();
    }


    //添加
    public function Add(){
        $db = Db::name('forms');
        $tableprefix=config('database.prefix');
        $id=input('id',0);
        $v=$db->find($id);
        if($v){

        }else{

        }
		if($this->request->isPost()){
   			$_POST['status']=1;
   			$_POST['sendtime']=time();

            if($id){
                if($db->update($_POST)!== false){
                    $title=input('title');
                    $tablename=input('tablename');
                    $oldtablename=input('oldtablename');
                    $sqls="rename table `{$tableprefix}{$oldtablename}` to `{$tableprefix}{$tablename}`";
                    $db->execute($sqls);

                    $sqlss="ALTER TABLE  `{$tableprefix}{$tablename}` CHANGE  `id` `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT  '{$title}表'";
                    $db->execute($sqlss);

                    Cache::set("forms_{$id}",$_POST);//存入缓存
                    sys_log("编辑表单名称:{$title}(id:$id)");
                    $this->success("编辑成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }else{
                if($id=$db->insert($_POST)){
                    $title=input('title');
                    $tablename=input('tablename');

                    //生成表单缓存
                    $form=Db::name('forms')->where("status=1")->select();
                    foreach ((array)$form as $k => $v){
                        Cache::set("forms_{$v['id']}",$v);//存入缓存
                    }

                    $sqls="CREATE TABLE `{$tableprefix}{$tablename}` (
                          `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '{$title}表',
                          `ip` varchar(15) NOT NULL DEFAULT '' COMMENT 'ip地址',
                          `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
                          `sendtime` varchar(10) NOT NULL DEFAULT '' COMMENT '操作时间',
                          PRIMARY KEY (`id`),
                          KEY `{$tablename}` (`status`)
                        ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
                    $db->execute($sqls);

                    sys_log("添加表单名称:{$title}(id:$id)");
                    $this->success("添加成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }

			$this->error($db->getError());	
		}
        $this->assign("v",$v);
        return $this->fetch();
    }

    //显示
    public function Fields($typeid){
        Cookie::set('Jumpurls',$_SERVER['REQUEST_URI']);
        $tablename=get_forms_zd($typeid);
        $table=config('database.prefix').$tablename;
        $list=Db()->query("SHOW FULL COLUMNS from `{$table}`");
        $field = Db()->query("select COLUMN_NAME from information_schema.COLUMNS where table_name = '{$table}'");
        //print_r($field[count($field)-4]);
        foreach ($list as $k=>$v){
            $arr=explode("_",$v['Comment']);
            $list[$k]['title']=$arr[0];
            $list[$k]['tip']=$arr[1];
        }
        $arrs=$field[count($field)-4];
        $end= $arrs['COLUMN_NAME'];
        //echo $end;
        Cookie::set('zd',$end);
        $this->assign('list',$list);
        return $this->fetch();
    }

    //显示
    public function Infos($typeid){
        $tablename=get_forms_zd($typeid);
        $db = Db::name($tablename);
        $list = $db->order('id desc')->paginate(20);
        foreach ($list as $k=>$v){
            if($v['status']==1) $status="<a href=\"/Admin-Forms-Audit-typeid-{$typeid}-id-{$v['id']}.html\"><img width=\"16\" height=\"16\" border=\"0\" alt=\"已启用\" src=\"/Manage/Admin/Public/images/p.png\"/></a>
";else $status="<a href=\"/Admin-Forms-Audit-typeid-{$typeid}-id-{$v['id']}.html\"><img width=\"16\" height=\"16\" border=\"0\" alt=\"已查封\" src=\"/Manage/Admin/Public/images/x.png\"/></a>";
            $list[$k]['status']=$status;
            $list[$k]['sendtime']=date('Y-m-d',$v['sendtime']);
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

//添加
    public function InfoAdd($typeid){
        if($this->request->isPost()){
            $tablename=get_forms_zd($typeid);
            $db=Db::name($tablename);
            $_POST['sendtime']=time();
            $_POST['ip']=$_SERVER['REMOTE_ADDR'];
            $_POST['status']=1;
            if($id=$db->insert($_POST)){
                $this->success("添加成功",url("Forms/Infos?typeid={$typeid}"));
                exit();
            }
            $this->error($db->getError());
        }
        $this->assign("list");
        return $this->fetch('Forms/InfoAdd');
    }

    //添加
    public function FieldAdd(){
        $zd=Cookie::get('zd');
        $typeid=input('typeid',0);
        if($this->request->isPost()){
            $act=input('act');
            $tablename=input('table');
            $name=trim(input('name'));
            $title=trim(input('title'));
            $tip=trim(input('tip'));
            $typeid=input('typeid',0);
            $db=Db::name($tablename);
            //echo $db;
            $table=config('database.prefix').$tablename;

            if($act=='up'){
                $oldname=trim(input('oldname'));
                $sqls="ALTER TABLE  `{$table}` CHANGE  `{$oldname}` `{$name}` VARCHAR( 300 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '' COMMENT '{$title}_{$tip}'";
                //exit($sqls);
                $db->execute($sqls);
                $this->success("修改成功",Cookie::get('Jumpurls'));
                exit();
            }else{
                $sqls="ALTER TABLE  `{$table}` ADD `{$name}` VARCHAR( 300 ) NOT NULL DEFAULT  '' COMMENT  '{$title}_{$tip}' AFTER `{$zd}`";
                //exit($sqls);
                $db->execute($sqls);
                $this->success("添加成功",Cookie::get('Jumpurls'));
                exit();
            }

            $this->error(M()->getError());
        }
        $this->assign("list");
        return $this->fetch('Forms/FieldAdd');
    }

    //更新
    public function FieldUpdate($typeid){
        $tablename=get_forms_zd($typeid);
        if($this->request->isPost()){
            $oldname=trim(input('oldname'));
            $name=trim(input('name'));
            $title=trim(input('title'));
            $tip=trim(input('tip'));
            $pid=I('typeid',0);
            $sqls="ALTER TABLE  `{$tableprefix}{$tablename}` CHANGE  `{$oldname}` `{$name}` VARCHAR( 300 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT  '' COMMENT '{$title}_{$tip}'";
            //exit($sqls);
            M()->execute($sqls);
            $this->success("修改成功",url("Forms/Fields?typeid={$typeid}"));
            exit();
            $this->error(M()->getError());
        }
        return $this->fetch();
    }

    //更新
    public function FieldDel($typeid){
        if($this->request->isGet()){
            $tablename=get_forms_zd($typeid);
            $db=Db::name($tablename);
            $table=config('database.prefix').$tablename;
            $zd=input('zd',0);
            $sqls=" ALTER TABLE `{$table}` DROP `{$zd}`";
            $db->execute($sqls);
            $this->success("删除成功",Cookie::get('Jumpurls'));
            exit();
            $this->error(M()->getError());
        }
        return $this->fetch();
    }
	
	//审核
	public function Audit($typeid,$id){
        $tablename=get_forms_zd($typeid);
        $db = Db::name('manager');
		$list=$db->field("status")->find($id);
		$status=$list['status'];
		$_POST['id']=$id;
		$_POST['status']= $status ? 0 : 1;
        if($db->update($_POST)!== false){
            sys_log("审核表单:(id:$id)");
            $this->success("审核成功",url("Forms/Infos?typeid={$typeid}"));
            exit();
        }
		$this->error($db->getError());
	}
	
	//删除
	public function FormsDel(){
        $db = Db::name('forms');
		$id=input('id',0);
		if($id){
            $tablename=get_forms_zd($id);
            $tableprefix=config('database.prefix');
			if($db->delete($id)){
                $sqls=" DROP TABLE `{$tableprefix}{$tablename}`";
                if($db->execute($sqls)){
                    Cache::rm("forms_{$id}");//删除缓存
                }

                sys_log("删除表单:(id:$id)");
				$this->success("删除成功",Cookie::get('Jumpurl'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除信息!');
		}
	}

    //删除
    public function InfoDel($typeid){
        $tablename=get_forms_zd($typeid);
        $db = Db::name($tablename);
        $did=input('checkid');
        if(!empty($did) && is_array($did)){
            $id=implode(",",$did);
            if($db->delete($id)){
                $this->success("删除成功！",url("Forms/Infos?typeid={$typeid}"));
            }else{
                $this->error("删除失败！");
            }
        }else{
            $this->error('请选择删除信息!');
        }
    }

    public function Action(){
        $typeid=input('typeid',0);
        $tablename=get_forms_zd($typeid);
        $db = Db::name($tablename);
        if($this->request->isPost()){
            $act=input('post.act');
            $checkid=input('post.checkid/a');
            if($act=='alldel') {
                for($i=0;$i<count($checkid);$i++) {
                    $db->delete($checkid[$i]);
                }
                $this->success("删除成功",Cookie::get('Jumpurl'));
            }
        }
    }
}
?>