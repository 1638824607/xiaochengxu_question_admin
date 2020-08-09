<?php
/**
 * Created by PhpStorm.
 * User: 吾道建站
 * Date: 20/7/6
 * Time: 00:02
 * (吾道建站)保留在任何时刻，对代码内容进行添加、修改的权利
 * (吾道建站)对本代码可能出现的内容错误及缺失不承担任何责任。对此进行的更正将合并到此代码的最新版本中
 * 本代码的最终解释权归属于(吾道建站)
 * 版权所有：吾道建站 @2020
 * 吾道建站合作联系方式 微信:18226849637   QQ:730249592  备注: 吾道建站
 * 吾道建站座右铭:客户即合理 存在即合理
 */
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;

class Trainday extends Purview
{

    //111
    public function index()
    {


        $list = Db::name('train_day')->order('id desc')->paginate(20)->each(function($v, $key){
//            if($v['image']){
//                $v['image'] = str_replace('Uploads','uploads',$v['image']);
//            }
            if($v['cate_id']){
               $train_day_cate = Db::name('train_day_cate')->where(array('id'=>$v['cate_id']))->find();
                if($train_day_cate){
                    $v['train_day_cate_name'] = $train_day_cate['title'];
                }else{
                    $v['train_day_cate_name'] = '';
                }
            }else{
                $v['train_day_cate_name'] = '';
            }
            return $v;
        });
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add_train_day()
    {
        if($this->request->isPost()){

            $data = [];

            if(empty($this->request->param('cate_id'))){
                $this->error('静心分类不存在');
            }
            if(empty($this->request->param('title'))){
                $this->error('静心标题不存在');
            }
            if(empty($this->request->param('image'))){
                $this->error('静心图片不存在');
            }
            $data['cate_id'] = $this->request->param('cate_id');
            $data['title'] = $this->request->param('title');
            $data['desc'] = $this->request->param('desc');
            $data['image'] = $this->request->param('image');
            $data['introduction'] = $this->request->param('introduction');
            $data['created_at'] = date('Y-m-d H:i:s',time());


            $res = Db::name('train_day')->insert($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败!');
            }

        }else{

            $list = Db::name('train_day_cate')->select();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function eidt_train_day()
    {
        if($this->request->isPost()){

            $data = [];

            if(empty($this->request->param('title'))){
                $this->error('静心标题不存在');
            }
            if(empty($this->request->param('image'))){
                $this->error('静心图片不存在');
            }
            $data['title'] = $this->request->param('title');
            $data['desc'] = $this->request->param('desc');
            $data['image'] = $this->request->param('image');
            $data['introduction'] = $this->request->param('introduction');
            $data['updated_at'] = date('Y-m-d H:i:s',time());


            $res = Db::name('train_day')->where('id',$this->request->param('id'))->update($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败!');
            }

        }else{
            $info = Db::name('train_day')->where('id',$this->request->param('id'))->find();
            $this->assign('info',$info);
            $list = Db::name('train_day_cate')->select();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function del_train_day()
    {
        if(empty($this->request->param('id'))){
            $this->error('静心id不存在');
        }
        $res = Db::name('train_day')->where('id',$this->request->param('id'))->delete();
        if($res){
            $this->success('操作成功!',url('index'));
        }else{
            $this->error('操作失败!');
        }
    }


    public function train_day_step_index()
    {
        $where = [];
        $day_id = $this->request->param('day_id');
//        var_dump($day_id);
        if(empty($day_id)){
            $this->error('数据不存在');
        }
        $where['day_id'] = $day_id;
        $list = Db::name('train_day_step')->where($where)->order('id desc')->paginate(20)->each(function($v,$key){
//            var_dump(Db::name('train_day_step')->getLastSql());
            if($v['day_id']){
                $train_day = Db::name('train_day')->where(array('id'=>$v['day_id']))->find();
                if($train_day){
                   $v['day_title'] = $train_day['title'];
                }else{
                    $v['day_title'] = '';
                }
            }else{
                $v['day_title'] = '';
            }
            return $v;
        });

        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add_train_day_step()
    {
        if(empty($this->request->param('day_id'))){
            $this->error('所属静心信息不存在!');
        }
        if($this->request->isPost()){

            $data = [];

            if(empty($this->request->param('title'))){
                $this->error('所属静心步骤标题不能为空!');
            }

            if(empty($this->request->param('duration'))){
                $this->error('时长不能为空!');
            }

            if(empty($this->request->param('image'))){
                $this->error('音乐地址不能为空!');
            }

            $data['day_id'] = $this->request->param('day_id');
            $data['title'] = $this->request->param('title');
            $data['duration'] = $this->request->param('duration');
            $data['src'] = $this->request->param('image');
            $data['created_at'] = date('Y-m-d H:i:s',time());


            $res = Db::name('train_day_step')->insert($data);
            if($res){

                $this->success('操作成功!',url('train_day_step_index',['day_id'=>$this->request->param('day_id'),'pid'=>43,'ty'=>45]));
            }else{
                $this->error('操作失败!');
            }

        }else{

            return $this->fetch();
        }
    }

    public function edit_train_day_step()
    {
        if($this->request->isPost()){
            $data = [];
            if(empty($this->request->param('id'))){
                $this->error('静心步骤id不存在');
            }
            if(empty($this->request->param('title'))){
                $this->error('所属静心步骤标题不能为空!');
            }
            if(empty($this->request->param('duration'))){
                $this->error('时长不能为空!');
            }
            if(empty($this->request->param('image'))){
                $this->error('音乐地址不能为空!');
            }
            $data['title'] = $this->request->param('title');
            $data['duration'] = $this->request->param('duration');
            $data['src'] = $this->request->param('image');

            $data['updated_at'] = date('Y-m-d H:i:s',time());

            $res = Db::name('train_day_step')->where('id',$this->request->param('id'))->update($data);
            if($res){
                $this->success('操作成功!',url('train_day_step_index',['day_id'=>$this->request->param('day_id'),'pid'=>43,'ty'=>45]));
            }else{
                $this->error('操作失败!');
            }

        }else{
            if(empty($this->request->param('id'))){
                $this->error('静心步骤id不存在');
            }
            $info = Db::name('train_day_step')->where('id',$this->request->param('id'))->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    public function del_train_day_step()
    {

        if(empty($this->request->param('id'))){
            $this->error('静心步骤id不存在');
        }
        $res = Db::name('train_day_step')->where('id',$this->request->param('id'))->delete();
        if($res){
            $this->success('操作成功!',url('train_day_step_index',['day_id'=>$this->request->param('day_id'),'pid'=>43,'ty'=>45]));
        }else{
            $this->error('操作失败!');
        }

    }
}