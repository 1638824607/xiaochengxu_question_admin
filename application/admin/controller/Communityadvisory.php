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

class Communityadvisory extends Purview
{

    public function index()
    {
        $where = [];
        if($this->request->param('q')){
            $kwd = trim($this->request->param('q'));
            $where['name|tel'] = ['like', "%{$kwd}%"];
        }
        $list = Db::name('community_advisory')->where($where)->order('id desc')->paginate(20)->each(function($v,$key){
          return $v;
        });
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function add_community_advisory()
    {
        if($this->request->isPost()){

            $data = [];
            if(empty($this->request->param('name'))){
                $this->error('老师姓名不能为空');
            }

            if(empty($this->request->param('avatar'))){
                $this->error('老师头像不能为空');
            }

            $data['name'] = $this->request->param('name');
            $data['avatar'] = $this->request->param('avatar');
            $data['job'] = $this->request->param('job');
            $data['org'] = $this->request->param('org');
            $data['tel'] = $this->request->param('tel');
            $data['desc'] = $this->request->param('desc');
            $data['created_at'] = date('Y-m-d H:i:s',time());

            $res = Db::name('community_advisory')->insert($data);
            if($res){

                $this->success('操作成功',url('index',['pid'=>24,'ty'=>44]));
            }else{
                $this->error('操作失败');
            }
        }else{

            return $this->fetch();
        }
    }

    public function edit_community_advisory()
    {
        if($this->request->isPost()){
            $data = [];
            if(empty($this->request->param('id'))){
                $this->error('数据不存在!');
            }
            if(empty($this->request->param('name'))){
                $this->error('老师姓名不能为空');
            }

            if(empty($this->request->param('avatar'))){
                $this->error('老师头像不能为空');
            }
            $data['name'] = $this->request->param('name');
            $data['avatar'] = $this->request->param('avatar');
            $data['job'] = $this->request->param('job');
            $data['org'] = $this->request->param('org');
            $data['tel'] = $this->request->param('tel');
            $data['desc'] = $this->request->param('desc');
            $data['updated_at'] = date('Y-m-d H:i:s',time());

            $res = Db::name('community_advisory')->where('id',$this->request->param('id'))->update($data);
            if($res){

                $this->success('操作成功',url('index',['pid'=>24,'ty'=>44]));
            }else{
                $this->error('操作失败');
            }
        }else{
            if(empty($this->request->param('id'))){
                $this->error('数据不存在!');
            }
            $info = Db::name('community_advisory')->where('id',$this->request->param('id'))->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    public function del_community_advisory()
    {
       $id = $this->request->param('id');
        if(empty($id)){
            $this->error('老师信息不存在');
        }
        $res = Db::name('community_advisory')->where('id',$id)->delete();
        if($res){
            $this->success('操作成功',url('index'));
        }else{
            $this->error('操作失败');
        }
    }




}
