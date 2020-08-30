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


class Knowledgehealth extends Purview
{
    public function index()
    {
        $kwd   = input('kwd');
        $where = [];

        if(! empty($kwd)) {
            $where['title'] = ['like', "%{$kwd}%"];
        }

        $list = KnowledgeHealthModel::with(['question'])->where($where)->order('hot desc')->order('sort desc')->paginate(20);

        $this->assign('list', $list);
        $this->assign('kwd', $kwd);
        $this->assign('questionType', KnowledgeHealthQuestionModel::$questionType);
        return $this->fetch();
    }


    public function add()
    {
        if ($this->request->isPost()) {
            $data['title']              = $this->request->param('title');
            $data['desc']               = $this->request->param('desc');
            $data['src_type']           = $this->request->param('src_type');
            $data['src']                = $this->request->param('src');
            $data['introduce']          = $this->request->param('introduce');
            $data['introduce_src_type'] = $this->request->param('introduce_src_type');
            $data['introduce_src']      = $this->request->param('introduce_src');
            $data['duration']           = $this->request->param('duration');
            $data['sort']               = $this->request->param('sort');
            $data['hot']                = $this->request->param('hot');

            $res = Db::name('knowledge_health')->insert($data);

            if ($res) {
//                $manager = Db::name('manager')->where(array('id'=>Session('admin_id')))->find();
//                Db::name('manager')->where(array('id'=>Session('admin_id')))->update(array('timu_num'=>$manager['timu_num']+1));
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
            $data['title']              = $this->request->param('title');
            $data['desc']               = $this->request->param('desc');
            $data['src_type']           = $this->request->param('src_type');
            $data['src']                = $this->request->param('src');
            $data['introduce']          = $this->request->param('introduce');
            $data['introduce_src_type'] = $this->request->param('introduce_src_type');
            $data['introduce_src']      = $this->request->param('introduce_src');
            $data['duration']           = $this->request->param('duration');
            $data['sort']               = $this->request->param('sort');
            $data['hot']                = $this->request->param('hot');

            $res = Db::name('knowledge_health')->where(array('id' => $this->request->param('id')))->update($data);
            $this->success('操作成功', url('index'));
        } else {
            $id = input('id');
            if (empty($id)) {
                $this->error('信息不存在');
            }
            $info = Db::name('knowledge_health')->where(array('id' => $this->request->param('id')))->find();
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
        $res = Db::name('knowledge_health')->where(array('id' => $id))->delete();
        if ($res) {
            Db::name('knowledge_health_question')->where(array('health_id' => $id))->delete();
            $this->success('操作成功', url('index'));
        } else {
            $this->error('操作失败,请重试');
        }
    }

    public function add_question()
    {

        if ($this->request->isPost()) {
            $data['health_id'] = $this->request->param('health_id');
            $data['title']    = $this->request->param('title');
            $data['desc']     = $this->request->param('desc');
            $data['number']   = $this->request->param('number');
            $data['type']     = $this->request->param('src_type');
            $data['answer']   = $this->request->param('answer');
            $data['question'] = $this->request->param('question/a');

            if (empty($data['health_id'])) {
                $this->error('未找到测评记录');
            }

            if (empty($data['title']) || empty($data['desc'])
                || empty($data['type']) || empty($data['number'])
                || empty($data['question'])) {
                $this->error('请输入完整');
            }

            if ($data['type'] == 1 && empty($data['answer'])) {
                $this->error('请输入选择题答案');
            }

            $data['options']    = implode('|', array_filter($data['question']));
            $data['type']       = $data['type'] == 1 ? '选择' : '问答';
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');

            $res = Db::name('knowledge_health_question')->insert($data);

            if ($res) {
                $this->success('操作成功', url('index'));
            } else {
                $this->error('操作失败,请重试');
            }
        }

        $healthId = input('health_id');

        if (empty($healthId)) {
            $this->error('请选择测评');
        }

        $healthInfo = Db::name('knowledge_health')->where('id', $healthId)->find();

        if (empty($healthInfo)) {
            $this->error('测评不存在');
        }

        $this->assign('healthInfo', $healthInfo);
        return $this->fetch();
    }

    public function edit_question()
    {

        if ($this->request->isPost()) {
            $data['id']       = $this->request->param('id');
            $data['title']    = $this->request->param('title');
            $data['desc']     = $this->request->param('desc');
            $data['number']   = $this->request->param('number');
            $data['type']     = $this->request->param('src_type');
            $data['answer']   = $this->request->param('answer');
            $data['question'] = $this->request->param('question/a');

            if (empty($data['title']) || empty($data['desc'])
                || empty($data['type']) || empty($data['number'])
                || empty($data['question'])) {
                $this->error('请输入完整');
            }

            if ($data['type'] == 1 && empty($data['answer'])) {
                $this->error('请输入选择题答案');
            }

            $data['options']    = implode('|', array_filter($data['question']));
            $data['type']       = $data['type'] == 1 ? '选择' : '问答';
            $data['updated_at'] = date('Y-m-d H:i:s');

            $res = Db::name('knowledge_health_question')->where(['id' => $data['id']])->update($data);

            if ($res !== false) {
                $this->success('操作成功', url('index'));
            } else {
                $this->error('操作失败,请重试');
            }
        }

        $id = input('id');

        if (empty($id)) {
            $this->error('请选择题目');
        }

        $healthQuesiontInfo = Db::name('knowledge_health_question')->where('id', $id)->find();

        if (empty($healthQuesiontInfo)) {
            $this->error('题目不存在');
        }

        $healthInfo = Db::name('knowledge_health')->where('id', $healthQuesiontInfo['health_id'])->find();

        $this->assign('healthhInfo', $healthInfo);
        $this->assign('healthQuestionInfo', $healthQuesiontInfo);
        return $this->fetch();
    }

    public function del_question()
    {
        $id = input('id');

        if (empty($id)) {
            $this->error('信息不存在');
        }
        $res = Db::name('knowledge_health_question')->where(array('id' => $id))->delete();
        if ($res) {
            $this->success('操作成功', url('index'));
        } else {
            $this->error('操作失败,请重试');
        }
    }
}