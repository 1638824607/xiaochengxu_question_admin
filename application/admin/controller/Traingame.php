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
use app\admin\model\KnowledgeHealthModel;
use app\admin\model\KnowledgeHealthQuestionModel;
use think\Db;

class Traingame extends Purview
{
    public function index()
    {
        $list = Db::name('train_game')->order('id desc')->paginate(20);

        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if ($this->request->isPost()) {
            $data['title']        = $this->request->param('title');
            $data['desc']         = $this->request->param('desc');
            $data['image']        = $this->request->param('image');
            $data['introduction'] = $this->request->param('introduction');
            $data['guide']        = $this->request->param('guide');
            $data['duration']     = $this->request->param('duration');
            $data['sort']         = $this->request->param('sort');
            $data['created_at']   = date('Y-m-d H:i:s');

            $res = Db::name('train_game')->insert($data);
            if ($res) {
                $this->success('操作成功', url('index'));
            } else {
                $this->error('操作失败,请重试');
            }
        }

        return $this->fetch();
    }

    public function edit()
    {
        if ($this->request->isPost()) {
            $data['title']        = $this->request->param('title');
            $data['desc']         = $this->request->param('desc');
            $data['image']        = $this->request->param('image');
            $data['introduction'] = $this->request->param('introduction');
            $data['guide']        = $this->request->param('guide');
            $data['duration']     = $this->request->param('duration');
            $data['sort']         = $this->request->param('sort');
            $data['updated_at']   = date('Y-m-d H:i:s');

            $res = Db::name('train_game')->where(array('id' => $this->request->param('id')))->update($data);
            if ($res !== false) {
                $this->success('操作成功', url('index'));
            } else {
                $this->error('操作失败,请重试');
            }
        } else {
            $id = input('id');
            if (empty($id)) {
                $this->error('信息不存在');
            }
            $info = Db::name('train_game')->where(array('id' => $this->request->param('id')))->find();
            $this->assign('info', $info);
            return $this->fetch();
        }
    }

    public function del()
    {
        $id = input('id');
        if (empty($id)) {
            $this->error('信息不存在');
        }
        $res = Db::name('train_game')->where(array('id' => $id))->delete();
        if ($res) {
            $this->success('操作成功', url('index'));
        } else {
            $this->error('操作失败,请重试');
        }
    }
}