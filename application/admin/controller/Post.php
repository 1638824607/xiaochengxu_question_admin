<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Post extends Purview {

    private $table = 'community_post';

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::name($this->table);
    }

    //首页
    public function Index(){
        $data = Db::name('community_post')
            ->alias('p')
            ->join('tp_users u','p.user_id = u.id','left')
            ->field('p.id,p.title,p.content,u.nick,p.created_at')
            ->order('p.created_at','desc')
            ->paginate(10);

        $this->assign('list',$data);
        return $this->fetch();
    }

	//删除
	public function Del(){
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($this->db->delete($id)){
 				sys_log("删除帖子:(id:$id)");
				$this->success("删除成功",url('post/index'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除帖子!');
		}
	}
}
