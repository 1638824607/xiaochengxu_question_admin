<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Config;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Datacenter extends Purview {

    private $table = 'appointment';
    private $dUsers;

    public function __construct()
    {
        parent::__construct();
        $this->db = Db::name($this->table);
        $this->dUsers = DB::name('users');
    }

    // 首页
    public function Index(){
        return $this->fetch();
    }
 

	// 获取统计数据
	public function getStatData(){
        $nowDate = date('y-m-d');
        Config::set('default_return_type', 'json');
        $totalUserNum =  $this->dUsers->count();
        $sql = sprintf(" select count(1) as total from (select distinct user_id from (select  user_id from tp_knowledge_health_record where created_at >= %s group by user_id union all  select user_id from tp_knowledge_match_record where created_at >= 2020-08-01 group by user_id ) as tmp )as t ",$nowDate);
        $todayAnswerNum = DB::query($sql)[0]['total'];

        $returnData = [
            'totalUserNum'=>$totalUserNum,//用户总数
            'activeUsersNum'=>0,//活跃用户数
            'todayAnswerNum'=>$todayAnswerNum,//今日答题用户数
        ];

        return $returnData;
	}

	// 获取每日用户统计
    public function getStatUserPage()
    {
        Config::set('default_return_type', 'json');
        $page = input('page',1);
        $size = input('size',10);
        return DB::name('stat_users_day')->paginate($size,false,['page'=>$page])->toArray();

    }

}
