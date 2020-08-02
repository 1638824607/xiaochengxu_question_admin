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
use think\Session;

class Knowledgeread extends Purview
{

    public function index()
    {
        $where= [];
        $list = Db::name('knowledge_read')->where($where)->order('sort desc,id desc')->paginate(20)->each(function($v, $key){
            $src_type = array('','图片类型','视频类型');
            $knowledge_read_cate = Db::name('knowledge_read_cate')->where(array('id'=>$v['cate_id']))->find();
            if($knowledge_read_cate){
                $v['cate_name'] = $knowledge_read_cate['title'];
            }else{
                $v['cate_name'] = '';
            }
            $v['src_type_desc'] = $src_type[$v['src_type']];

            return $v;
        });
        $this->assign('list',$list);

        return $this->fetch();
    }

    public function add_knowledge_read()
    {
        if($this->request->isPost()){

            if(empty($this->request->param('image'))){
                $this->error('图片必须传');
            }
            if(empty($this->request->param('src_type'))){
                $this->error('上传的类型必须选择');
            }
            if(empty($this->request->param('cate_id'))){
                $this->error('类型必须选择');
            }

            $data['src'] = $this->request->param('image');
            $data['cate_id'] = $this->request->param('cate_id');

            $data['title'] = $this->request->param('title');
            $data['desc'] = $this->request->param('desc');
            $data['content'] = $this->request->param('content');
            $data['src_type'] = $this->request->param('src_type');
            $data['sort'] = $this->request->param('sort',0);
            $data['create_time'] = date('Y-m-d H:i:s',time());
            $data['admin_user_id'] = Session::Get('admin_id');

            $res = Db::name('knowledge_read')->insert($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败,请重试');
            }
        }else{
            $where= [];
            $list = Db::name('knowledge_read_cate')->where($where)->order('sort desc,id desc')->paginate(20)->each(function($v, $key){
                return $v;
            });
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function edit_knowledge_read()
    {
        if($this->request->isPost()){

            if(empty($this->request->param('image'))){
                $this->error('图片必须传');
            }
            if(empty($this->request->param('src_type'))){
                $this->error('上传的类型必须选择');
            }
            if(empty($this->request->param('cate_id'))){
                $this->error('类型必须选择');
            }

            $data['src'] = $this->request->param('image');
            $data['cate_id'] = $this->request->param('cate_id');

            $data['title'] = $this->request->param('title');
            $data['desc'] = $this->request->param('desc');
            $data['content'] = $this->request->param('content');
            $data['src_type'] = $this->request->param('src_type');
            $data['sort'] = $this->request->param('sort',0);
            $data['update_time'] = date('Y-m-d H:i:s',time());

            $res = Db::name('knowledge_read')->where(array('id'=>$this->request->param('id')))->update($data);
            if($res){
                $this->success('操作成功',url('index'));
            }else{
                $this->error('操作失败,请重试');
            }
        }else{

            if(empty($this->request->param('id'))){
                $this->error('信息不存在');
            }
            $info = Db::name('knowledge_read')->where(array('id'=>$this->request->param('id')))->find();
            $this->assign('info',$info);
            $where= [];
            $list = Db::name('knowledge_read_cate')->where($where)->order('sort desc,id desc')->paginate(20)->each(function($v, $key){
                return $v;
            });
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function del_knowledge_read()
    {
        if(empty($this->request->param('id'))){
            $this->error('信息不存在');
        }
        $res = Db::name('knowledge_read')->where(array('id'=>$this->request->param('id')))->delete();
        if($res){
            $this->success('操作成功',url('index'));
        }else{
            $this->error('操作失败,请重试');
        }
    }
}