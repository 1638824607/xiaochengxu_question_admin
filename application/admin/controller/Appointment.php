<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Appointment extends Purview {

    private $table = 'appointment';

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::name($this->table);
    }

    //首页
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
		$list = $this->db->paginate(20);
        $page = $list->render();
        $list = $list->all();
        foreach($list as $k=>$v){
            $list[$k]['wechat'] = 'wx';
        }
        $this->assign('list',$list);
        $this->assign('page',$page);

        return $this->fetch();
    }
 
	
	//详情
    public function info(){
        if($this->request->isPost())
        {
            // 更新
            $id = input('id');
            $updateData = [
                'nick'=>input('nick'),
                'phone' => input('phone'),
                'wechat' => input('wechat'),
                'status' => input('status'),
                'publish_article_num' => input('publish_article_num'),
                'do_question_num' => input('do_question_num'),
                'game_accuracy' => input('game_accuracy'),
            ];
            $res = $this->db->where('id',$id)->update($updateData);
            $this->success('操作成功',url('index'));

        }else{
            // 展示

            $id=input('id',0);
            if($id)
            {
                $userRow = $this->db->find($id);
                $this->assign('info',$userRow);
                return $this->fetch();
            }else{
                $this->error('请选择用户!');
            }
        }

    }
	
	//删除
	public function Del(){
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($this->db->delete($id)){
 				sys_log("删除用户:(id:$id)");
				$this->success("删除成功",Cookie::get('Jumpurl'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除用户!');
		}
	}
}