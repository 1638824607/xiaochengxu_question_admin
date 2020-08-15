<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Comment extends Purview {

    private $table = 'community_post_comment';

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::name($this->table);
    }

    //首页
    public function Index(){
        $post_id = input('post_id',0);
        $kwd = input('kwd','');
        $where = [];
        if($post_id)
        {
            $where['post_id'] = $post_id;
        }
        if($kwd)
        {
            $where['c.content'] = ['like',"%{$kwd}%"];
        }
        $query = Db::name('community_post_comment')
            ->alias('c')
            ->join('tp_users u','c.user_id = u.id','left')
            ->join('tp_community_post p','c.post_id = p.id','left')
            ->field('c.id,c.content,c.created_at,user_name,nick,title');
         if($where)
         {
            $query->where($where);
         }

        $data = $query->order('c.created_at','desc')
        ->paginate(10,false,['query'=>request()->param()]);

         $info = Db::name('community_post')->where('id', $post_id)->find();


        $this->assign('list',$data);
        $this->assign('info',$info);
        $this->assign('kwd',$kwd);
        return $this->fetch();
    }

	//删除
	public function Del(){
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($this->db->delete($id)){
 				sys_log("删除用户:(id:$id)");
                if(!empty($_SERVER["HTTP_REFERER"])){
                    $url = $_SERVER["HTTP_REFERER"];
                    $host = parse_url($url);
                    $jumpUrl = url($host['path']);
                    $this->success("删除成功",$jumpUrl);
                }
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
