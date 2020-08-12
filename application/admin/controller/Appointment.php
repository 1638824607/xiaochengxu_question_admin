<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Appointment extends Purview {

    private $table = 'community_advisory_order';

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::name($this->table);
    }

    //首页
    public function Index(){
        $start_time = input('start_time','');
        $end_time = input('end_time','');

		$query = DB::name('community_advisory_order o')
            ->field('o.id,u.id as user_id,u.nick,u.user_name,u.phone,o.order_at,a.name advisory_name,a.job,o.status order_status')
            ->join('users u','o.user_id=u.id')
            ->join('community_advisory a','o.advisory_id=a.id');
		if($start_time)
        {
            $sql = sprintf('o.order_at between "%s" AND "%s"',$start_time,$end_time);
            $query->where($sql);
        }
        $list = $query->paginate(20);
        $page = $list->render();
        $list = $list->all();
        foreach($list as $k=>$v){
             if($v['order_status'] == 1)
             {
                 $list[$k]['order_status'] = '正常';
             }else{
                 $list[$k]['order_status'] = '已取消';
             }
        }
        $this->assign('list',$list);
        $this->assign('page',$page);

        return $this->fetch();
    }

	//删除
	public function Del(){
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($this->db->delete($id)){
 				sys_log("删除用户:(id:$id)");
				$this->success("删除成功",url('/Admin/Appointment/index/pid/24/ty/25'));
				exit();
			}else{
				$this->error("删除失败");
			}
		}else{
			$this->error('请选择删除用户!');
		}
	}
}
