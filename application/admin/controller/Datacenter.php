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
        Config::set('default_return_type', 'json');
        $totalUserNum =  $this->dUsers->count();
        $returnData = [
            'totalUserNum'=>$totalUserNum,
            'activeUsersNum'=>998,
            'todayAnswerNum'=>22,//今日答题用户数
        ];

        return $returnData;
	}
}
