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

class Knowledgereadcate extends Purview
{

    public function index()
    {
        $where= [];
        $list = Db::name('knowledge_read_cate')->where($where)->order('sort desc,id desc')->paginate(20)->each(function($v, $key){
            return $v;
        });
        $this->assign('list',$list);


        return $this->fetch();
    }

    public function add_knowledge_read_cate()
    {
        if($this->request->isPost()){

            if(empty($this->request->param('title'))){
                $this->error('标题必须传');
            }
            if($this->request->param('sort') <= 0){
                $this->error('排序值必须大于等于1');
            }

            if($this->request->param('sort') > 99999){
                $this->error('排序值不能大于99999');
            }
            if(!is_numeric($this->request->param('sort'))){
                $this->error('排序值必须为数字');
            }

            $data['title'] = $this->request->param('title');

            $data['sort'] = $this->request->param('sort',0);
            $res = Db::name('knowledge_read_cate')->insert($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败,请重试');
            }
        }else{

            return $this->fetch();
        }
    }

    public function edit_knowledge_read_cate()
    {
        if($this->request->isPost()){
            if(empty($this->request->param('title'))){
                $this->error('标题必须传');
            }
            if($this->request->param('sort') <= 0){
                $this->error('排序值必须大于等于1');
            }

            if($this->request->param('sort') > 99999){
                $this->error('排序值不能大于99999');
            }
            if(!is_numeric($this->request->param('sort'))){
                $this->error('排序值必须为数字');
            }
            $info = Db::name('knowledge_read_cate')->where(array('title'=>trim($this->request->param('title'))))->find();
            if($info){
                $this->error('类型名称已存在,不能重复添加');
            }
            $data['title'] = $this->request->param('title');
            $data['sort'] = $this->request->param('sort',0);

            $res = Db::name('knowledge_read_cate')->where(array('id'=>$this->request->param('id')))->update($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败,请重试');
            }
        }else{

            if(empty($this->request->param('id'))){
                $this->error('信息不存在');
            }
            $info = Db::name('knowledge_read_cate')->where(array('id'=>$this->request->param('id')))->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }

    public function del_knowledge_read_cate()
    {
        if(empty($this->request->param('id'))){
            $this->error('信息不存在');
        }
        $res = Db::name('knowledge_read_cate')->where(array('id'=>$this->request->param('id')))->delete();
        if($res){
            $this->success('操作成功',url('index'));
        }else{
            $this->error('操作失败,请重试');
        }
    }
}