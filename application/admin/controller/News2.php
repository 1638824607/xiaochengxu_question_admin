<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;

class News extends Purview {

    //显示
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db=Db::name('news');
        $id=input('id',0);
        $pid=input('pid',0);
        $ty=input('ty',0);
        $tty=input('tty',0);
        $ttty=input('ttty',0);
        $q=input('q');

        $sqlkey="id>0";
        if($ttty>0){
            $zid=$ttty;
            $sqlkey.=" AND tty={$ttty}";
        }elseif($tty>0){
            $zid=$tty;
            $sqlkey.=" AND tty={$tty}";
        }elseif($ty>0){
            $zid=$ty;
            $sqlkey.=" AND ty={$ty}";
        }elseif($pid>0){
            $zid=$pid;
            $sqlkey.=" AND pid={$pid}";
        }else{
            $zid=0;
        }

        if($q) $sqlkey.=" AND title like '%".$q."%'";
        $vs['pid']=$pid;
        $vs['ty']=$ty;
        $vs['tty']=$tty;
        $vs['ttty']=$ttty;
        $vs['zid']=$zid;
        $vs['listurl']=url('News/Index',"pid={$pid}&ty={$ty}&tty={$tty}&ttty={$ttty}");
        $vs['addurl']=url('News/Add',"pid={$pid}&ty={$ty}&tty={$tty}&ttty={$ttty}");
        $vs['catname']=get_sort_zd($zid);
        $vs['imgnum']=get_sort_zd($zid,'imgnum');

        $list = $db->where($sqlkey)->order("istop desc,disorder desc,id desc")->paginate(20);
        $this->assign('vs',$vs);
        $this->assign('list',$list);

        $templet=get_sort_zd($zid,'templet');//获取当前模板名称
        return $this->fetch("{$templet}/Index");
    }

    //删除&&更新排序
    public function Action(){
        $db=Db::name('news');
        $tableprefix=config('database.prefix');
        if($this->request->isPost()){
            $act=input('post.act');
            $checkid=input('checkid/a');
            if($act=='sorting'){
                for($i=0;$i<count($checkid);$i++) {
                    $zd="sorting_".$checkid[$i];
                    $v=$_POST[$zd];
                    $db->execute("update {$tableprefix}news set disorder='$v' where id='{$checkid[$i]}'");
                    sys_log("信息排序更新:(id:$checkid[$i])");
                }
                $this->success("信息排序更新成功",Cookie::get('Jumpurl'));
            }elseif($act=='alldel') {
                for($i=0;$i<count($checkid);$i++) {
                    Db::execute("delete from  {$tableprefix}news where id='{$checkid[$i]}'");
                    sys_log("删除信息:(id:$checkid[$i])");
                }
                $this->success("信息删除成功",Cookie::get('Jumpurl'));
            }
        }
    }

    //添加&&编辑
    public function Add(){
        $db=Db::name('news');
        $id=input('id',0);
        $pid=input('pid',0);
        $ty=input('ty',0);
        $tty=input('tty',0);
        $ttty=input('ttty',0);
        $v=$db->find($id);
        $tableprefix=config('database.prefix');
        if($v){
            $pid=$v['pid'];
            $ty=$v['ty'];
            $tty=$v['tty'];
            $ttty=$v['ttty'];
        }
        if($ttty>0){
            $zid=$ttty;
            $sqlkey=" AND tty={$ttty}";
        }elseif($tty>0){
            $zid=$tty;
            $sqlkey=" AND tty={$tty}";
        }elseif($ty>0){
            $zid=$ty;
            $sqlkey=" AND ty={$ty}";
        }elseif($pid>0){
            $zid=$pid;
            $sqlkey=" AND pid={$pid}";
        }
        if($v['id']){
            $v['pid']=$v['pid'];
            $v['ty']=$v['ty'];
            $v['tty']=$v['tty'];
            $v['ttty']=$v['ttty'];
        }else{
            $v['pid']=$pid;
            $v['ty']=$ty;
            $v['tty']=$tty;
            $v['ttty']=$ttty;
        }
        $v['catname']=get_sort_zd($zid);
        $catname=$v['catname'];
        $v['zid']=$zid;
        $v['imgnum']=get_sort_zd($zid,'imgnum')+1;
        if($this->request->isPost()){
            if(input('post.isgood'))$_POST['isgood']=1;else $_POST['isgood']=0;
            if(input('post.istop'))$_POST['istop']=1;else $_POST['istop']=0;
            $_POST['sendtime']=time();
            $_POST['status']=1;

            if ($id) {
                if ($db->update($_POST) !== false) {

                    $images = $_POST['images'];
                    $ids_arr = $_POST['ids'];
                    $title_arr = $_POST['titles'];
                    $remark_arr = $_POST['remark'];
                    if ($images) {
                        $strings = explode('|', $images);
                        foreach ($strings as $k => $v) {
                            $vv = str_replace(".", "_", $v);
                            //$bt=$_POST[$vv];
                            $bt = $title_arr[$k];
                            $remark = $remark_arr[$k];
                            $pic = str_replace("/Manage/Admin/Public/myeditor/php/../../../../..", "", $v);
                            if ($pic && $bt && $remark) {
                                $sqla = "insert into {$tableprefix}titlepic set pid='$id',title='$bt',remark='$remark',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            } elseif ($pic && $bt && empty($remark)) {
                                $sqla = "insert into {$tableprefix}titlepic  set pid='$id',title='$bt',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            } elseif ($pic && empty($bt) && empty($remark)) {
                                $sqla = "insert into {$tableprefix}titlepic  set pid='$id',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            }
                        }
                    }

                    if ($ids_arr) {
                        $count = count($ids_arr);
                        for ($k = 0; $k < $count; $k++) {
                            $myid = $ids_arr[$k];
                            $bt = $title_arr[$k];
                            $remark = $remark_arr[$k];
                            $sqla = "update {$tableprefix}titlepic  set pid='$id',title='$bt',remark='$remark',status=1,sendtime='" . time() . "' where id={$myid}";
                            $db->execute($sqla);
                        }
                    }

                    sys_log("编辑{$catname}栏目内容:{$v['title']}(id:$id)");
                    $this->success("修改成功", Cookie::get('Jumpurl'));
                    exit();
                }
            } else {
                if ($id = $db->insert($_POST)) {
                    $images = $_POST['images'];
                    if ($images) {
                        $strings = explode('|', $images);
                        $title_arr = $_POST['titles'];
                        $remark_arr = $_POST['remark'];
                        foreach ($strings as $k => $v) {
                            $vv = str_replace(".", "_", $v);
                            //$bt=$_POST[$vv];
                            $bt = $title_arr[$k];
                            $remark = $remark_arr[$k];
                            $pic = str_replace("/Manage/Admin/Public/myeditor/php/../../../../..", "", $v);
                            if ($pic && $bt && $remark) {
                                $sqla = "insert into {$tableprefix}titlepic set pid='$id',title='$bt',remark='$remark',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            } elseif ($pic && $bt && empty($remark)) {
                                $sqla = "insert into {$tableprefix}titlepic set pid='$id',title='$bt',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            } elseif ($pic && empty($bt) && empty($remark)) {
                                $sqla = "insert into {$tableprefix}titlepic set pid='$id',img1='$pic',status=1,sendtime='" . time() . "'";
                                $db->execute($sqla);
                            }
                        }
                    }

                    sys_log("添加{$v['catname']}栏目内容:{$v['title']}(id:$id)");
                    $this->success("添加成功", Cookie::get('Jumpurl'));
                    exit();
                }
            }

            $this->error($db->getError());
        }

        $vs['listurl']=url('News/Index',"pid={$pid}&ty={$ty}&tty={$tty}&ttty={$ttty}");
        $vs['addurl']=url('News/Add',"pid={$pid}&ty={$ty}&tty={$tty}&ttty={$ttty}");

        $model_id=get_sort_zd($zid,'model_id');//获取当前栏目模块id
        $model_fields=get_model_zd($model_id,'model_fields');
        $arr=explode(",",$model_fields);
        $this->assign("arr",$arr);
        $this->assign("v",$v);
        $this->assign("vs",$vs);
        $templet=get_sort_zd($zid,'templet');//获取当前模板名称
        return $this->fetch("{$templet}/Add");

    }


    //审核
    public function Audit($id){
        $db=Db::name('news');
        $list=$db->field("status")->find($id);
        $status=$list['status'];
        $_POST['id']=$id;
        $_POST['status']= $status ? 0 : 1;
        if($db->update($_POST)!== false){
            sys_log("审核新闻:(id:$id)");
            $this->success("审核成功",Cookie::get('Jumpurl'));
        }
        $this->error($db->getError());
    }

    //删除
    public function Del(){
        $db=Db::name('news');
        $id=input('id',0);
        if($id){
            if($db->delete($id)){
                sys_log("删除新闻:(id:$id)");
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
    public function Titlepic(){
        $db=Db::name('titlepic');
        $id=input('id',0);
        if($id){
            $img=get_zd_name("img1","titlepic","id={$id}");
            if($img){
                @unlink(".".$img);
            }
            $db->delete($id);
        }
    }
    //单页面
    function Single(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
        $db=Db::name('news');
        $id=input('id',0);
        $pid=input('pid',0);
        $ty=input('ty',0);
        $tty=input('tty',0);
        $ttty=input('ttty',0);
        $tableprefix=config('database.prefix');
        if($ttty>0){
            $zid=$ttty;
            $sqlkey=" AND tty={$ttty}";
        }elseif($tty>0){
            $zid=$tty;
            $sqlkey=" AND tty={$tty}";
        }elseif($ty>0){
            $zid=$ty;
            $sqlkey=" AND ty={$ty}";
        }elseif($pid>0){
            $zid=$pid;
            $sqlkey=" AND pid={$pid}";
        }
        $v=$db->where("status=1{$sqlkey}")->find();
        if($v['id']){
        }else{
            $v['pid']=$pid;
            $v['ty']=$ty;
            $v['tty']=$tty;
            $v['ttyt']=$ttty;
            $v['title']=get_sort_zd($zid);
        }

        $v['catname']=get_sort_zd($zid);
        $catname=$v['catname'];
        $v['zid']=$zid;
        $v['imgnum']=get_sort_zd($zid,'imgnum')+1;
        if($this->request->isPost()){
            $_POST['sendtime']=time();
            $_POST['status']=1;
            if($id){
                if($db->update($_POST)!== false){
                    $images=$_POST['images'];
                    $ids_arr=$_POST['ids'];
                    $title_arr=$_POST['titles'];
                    $remark_arr=$_POST['remark'];
                    if($images){
                        $strings = explode('|',$images);
                        foreach ($strings as $k=>$v){
                            $vv=str_replace(".", "_", $v);
                            //$bt=$_POST[$vv];
                            $bt=$title_arr[$k];
                            $remark=$remark_arr[$k];
                            $pic=str_replace("/Manage/Admin/Public/myeditor/php/../../../../..", "", $v);
                            if($pic&&$bt&&$remark){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',title='$bt',remark='$remark',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }elseif($pic&&$bt&&empty($remark)){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',title='$bt',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }elseif($pic&&empty($bt)&&empty($remark)){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }
                        }
                    }

                    if($ids_arr){
                        $count =count($ids_arr);
                        for ($k=0;$k<$count;$k++){
                            $myid=$ids_arr[$k];
                            $bt=$title_arr[$k];
                            $remark=$remark_arr[$k];
                            $sqla="update {$tableprefix}titlepic set pid='$id',title='$bt',remark='$remark',status=1,sendtime='".time()."' where id={$myid}";
                            $db->execute($sqla);
                        }
                    }

                    sys_log("编辑{$catname}栏目内容:{$_POST['title']}(id:$id)");
                    $this->success("修改成功",cookie('Jumpurl'));
                    exit();
                }
            }else{
                if($id=$db->insert(input('post.'))){
                    $images=$_POST['images'];
                    $title_arr=$_POST['titles'];
                    $remark_arr=$_POST['remark'];
                    if($images){
                        $strings = explode('|',$images);
                        foreach ($strings as $k=>$v){
                            $vv=str_replace(".", "_", $v);
                            //$bt=$_POST[$vv];
                            $bt=$title_arr[$k];
                            $remark=$remark_arr[$k];
                            $pic=str_replace("/Manage/Admin/Public/myeditor/php/../../../../..", "", $v);
                            if($pic&&$bt&&$remark){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',title='$bt',remark='$remark',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }elseif($pic&&$bt&&empty($remark)){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',title='$bt',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }elseif($pic&&empty($bt)&&empty($remark)){
                                $sqla="insert into {$tableprefix}titlepic set pid='$id',img1='$pic',status=1,sendtime='".time()."'";
                                $db->execute($sqla);
                            }
                        }
                    }
                    sys_log("添加{$v['catname']}栏目内容:{$v['title']}(id:$id)");
                    $this->success("添加成功",cookie('Jumpurl'));
                    exit();
                }
            }
            //$this->error($db->getError());
        }

        $model_id=get_sort_zd($zid,'model_id');//获取当前栏目模块id
        //echo $model_id;
        $model_fields=get_model_zd($model_id,'model_fields');
        $arr=explode(",",$model_fields);
        //print_r($arr);
        $this->assign("arr",$arr);
        $this->assign("v",$v);
        $templet=get_sort_zd($zid,'templet');//获取当前模板名称
        return $this->fetch("{$templet}/Single");
    }
}
?>