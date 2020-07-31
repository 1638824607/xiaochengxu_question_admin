<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Sort extends Purview {

    //显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db=Db::name('sort');
        $tableprefix=config('database.prefix');
        $list = get_tree();
        if($this->request->isPost()){
            $sorting_arr=input('sorting');
            $checkid=input('checkid/a');
            for($i=0;$i<count($checkid);$i++) {
                $zd="sorting_".$checkid[$i];
                $v=$_POST[$zd];
                $db->execute("update {$tableprefix}sort set disorder='$v' where id='{$checkid[$i]}'");
                sys_log("更新栏目排序:(id:$checkid[$i])");
            }
            $this->success("栏目排序更新成功",Cookie::get('Jumpurl'));
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    //生成缓存
    public function Make(){
        //生成模型缓存
        $model=Db::name('model')->where("status=1")->select();
        foreach ((array)$model as $k => $v){
            Cache::set("model_{$v['id']}",$v);//存入缓存
        }

        //生成角色缓存
        $role=Db::name('role')->where("status=1")->select();
        foreach ((array)$role as $k => $v){
            Cache::set("role_{$v['id']}",$v);//存入缓存
        }

        //生成管理员缓存
        $manager=Db::name('manager')->where("status=1")->select();
        foreach ((array)$manager as $k => $v){
            Cache::set("manager_{$v['id']}",$v);//存入缓存
        }

        //生成栏目缓存
        $sort=Db::name('sort')->where("status=1")->select();
        foreach ((array)$sort as $k => $v){
            Cache::set("sort_{$v['id']}",$v);//存入缓存
        }

        //生成表单缓存
        $form=Db::name('forms')->where("status=1")->select();
        foreach ((array)$form as $k => $v){
            Cache::set("forms_{$v['id']}",$v);//存入缓存
        }

        //生成系统配置缓存
        $sort=Db::name('config')->select();
        foreach ((array)$sort as $k => $v){
            Cache::set("{$v['varname']}",$v['varvalue']);//存入缓存
        }

        $this->success("缓存更新成功",Cookie::get('Jumpurl'));
    }

    //添加&&编辑
    public function Add(){
        $db=Db::name('sort');
        $id=input('id',0);
        $pid=input('pid',0);
        $v=$db->find($id);
        if($v){
			if($v['pid'])
			$v['pidcatname']=get_sort_zd($v['pid']);
			else
			$v['pidcatname']="一级栏目";	
        }else{
            $v=$db->find($pid);
            $v['pidcatname']=get_sort_zd($pid);
            $v['catname']='';
            $v['id']=0;
            $v['pid']=$pid;
            $v['isopen']=0;
            $v['status']=1;
            $v['disorder']=$db->max('disorder')+5;
        }
        if($this->request->isPost()){
            $model_arr=explode("|",input('model_id'));
            $_POST['model_id']=$model_arr[0];
            $_POST['sendtime']=time();

            if($id){
                if($db->update($_POST)!== false){
                    Cache::set("sort_{$id}",$_POST);//存入缓存
                    sys_log("编辑分类名称:{$_POST['catname']}(id:$id)");
                    $this->success("编辑成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }else{
                if($id=$db->insert($_POST)){
                    Cache::set("sort_{$id}",$_POST);//存入缓存
                    sys_log("添加分类名称:{$_POST['catname']}(id:$id)");
                    $this->success("添加成功",Cookie::get('Jumpurl'));
                    exit();
                }
            }
            $this->error($db->getError());
        }
        $this->assign("v",$v);
        $this->assign("sort",get_tree());
        return $this->fetch();
    }

    //审核
    public function Audit($id){
        $db=Db::name('sort');
        $list=$db->field("status")->find($id);
        $status=$list['status'];
        $_POST['id']=$id;
        $_POST['status']= $status ? 0 : 1;
        if($db->update($_POST)!== false){
            sys_log("审核栏目:(id:$id)");
            $this->success("审核成功",Cookie::get('Jumpurl'));
            exit();
        }
        $this->error($db->getError());
    }

    //删除
    public function Del(){
        $db=Db::name('sort');
        $id=input('id',0);
        if($id){
            Cache::rm("sort_{$id}");//删除缓存
            if($db->delete($id)){
                sys_log("删除栏目:(id:$id)");
                $this->success("删除成功",Cookie::get('Jumpurl'));
                exit();
            }else{
                $this->error("删除失败");
            }
        }else{
            $this->error('请选择删除信息!');
        }
    }


    //动作
    public function Action(){
        $db=Db::name('sort');
        if($this->request->isGet()){
            $pid=input('pid',0);
            $ty=input('ty',0);
            $tty=input('tty',0);
            $ttty=input('ttty',0);

            if($ttty>0){
                $zid=$ttty;
            }elseif($tty>0){
                $zid=$tty;
            }elseif($ty>0){
                $zid=$ty;
                Session::set('gty',$ty);
            }elseif($pid>0){
                $zid=$pid;
                Session::set('gpid',$pid);
            }
            $v=$db->field('sort_c,sort_a,sort_url')->where("status=1 AND id={$zid}")->find();
            if($v){
                $sort_c=$v['sort_c'];
                $sort_a=$v['sort_a'];
                $sort_url=$v['sort_url'];
                if($sort_url){
                    $url="/admin/{$sort_c}/{$sort_a}/{$sort_url}";
                }else{
                    $url="/admin/{$sort_c}/{$sort_a}";
                }
                if($pid&&$ty&&$tty) $url="{$url}/pid/{$pid}/ty/{$ty}/tty/{$tty}";
                elseif($pid&&$ty&&$tty==0) $url="{$url}/pid/{$pid}/ty/{$ty}";
            }
            echo $url;

            $this->redirect($url);
            exit();
        }
    }
}

?>