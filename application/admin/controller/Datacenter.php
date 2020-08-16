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
        $sql = sprintf("select count(1) as total  from ( select 1 from tp_login_log where login_time > '%s' GROUP BY user_id )as tmp",date('Y-m-d',strtotime('-4day',strtotime($nowDate))));
        $activeUsersNum = DB::query($sql)[0]['total'];

        $returnData = [
            'totalUserNum'=>$totalUserNum,//用户总数
            'activeUsersNum'=>$activeUsersNum,//活跃用户数
            'todayAnswerNum'=>$todayAnswerNum,//今日答题用户数
        ];

        return $returnData;
	}

	// 获取每日用户统计
    public function getStatUserPage()
    {

        $page = input('page',1);
        $size = input('size',10);
        $data = [];
        $start_time = input('start_time','2020-07-01');
        $end_time = input('end_time',date('Y-m-d'));
        $curr_date = date('Y-m-d H:i:s');
        $now_time = date('Ymd');
        $find = DB::name('stat_users_day')->order('day','desc')->find();
        if($find['day'] != $now_time)
        {
            // 新增用户
            $sql = "select count(1) as total , DATE_FORMAT(created_at,'%Y%m%d') as day  from tp_users group by DATE_FORMAT(created_at,'%Y%m%d') ";
            $user_data = DB::name('users')->query($sql);
            $user_data = array_column($user_data,null,'day');
            if(!$find)
            {
                $find['day'] = '2020-07-01';
            }
            $format_date = date('Y-m-d',strtotime('+1day',strtotime($find['day'])));
            $date = implode('',explode('-',$format_date));
            $index = 1;

            // 活跃用户
            $sql = "select count(1) as total , DATE_FORMAT(login_time,'%Y%m%d') as day  from tp_login_log group by DATE_FORMAT(login_time,'%Y%m%d') ";
            $login_log = DB::query($sql);
            $login_log = array_column($login_log,null,'day');
            while($date <= $now_time)
            {
                if($index > 50)
                {
                    exit('err');
                }
                // 答题用户
                $sql = sprintf(" select count(1) as total from (select distinct user_id from (select  user_id from tp_knowledge_health_record   where created_at >= '%s'  AND created_at <= '%s' group by user_id union all  select user_id from tp_knowledge_match_record where created_at >= '%s'  AND created_at <= '%s' group by user_id ) as tmp )as t ",$format_date,$format_date .' 23:59:59',$format_date,$format_date. ' 23:59:59');
                $answer_num = DB::query($sql)[0]['total'];
                $row = [
                    'day'=>$format_date,
                    'new_users_num'=>isset($user_data[$date]) ? $user_data[$date]['total'] : 0,
                    'active_users_num'=>isset($login_log[$date]) ? $login_log[$date]['total'] : 0,
                    'answer_users_num'=>$answer_num,
                    'created_at'=>$curr_date
                ];
                array_unshift($data,$row);
                $date = date('Ymd',strtotime('+1day',strtotime($format_date)));
                $format_date = date('Y-m-d',strtotime('+1day',strtotime($format_date)));
                $index++;

            }
            DB::name('stat_users_day')->insertAll($data,true);
        }
        if(input('is_download'))
        {
            $fileName = '用户统计_'. date('YmdHi') . '.csv';
            header('Content-type: application/octet-stream; charset=utf-8');
            header('Content-Disposition: attachment; filename=' .$fileName);
            $list =  DB::name('stat_users_day')
                ->field('day,new_users_num,active_users_num,answer_users_num')
                ->where('day','>=',$start_time)
                ->where('day','<=',$end_time)
                ->order('day','asc')->select();
            $header = ['时间', '新增用户', '活跃用户', '答题用户'];
            foreach($header as $k=>$v)
            {
                $header[$k] = iconv("UTF-8", "GB2312//IGNORE", $v);
            }
            $result = '';
            $result .= '"'.implode('","', $header).'"' . PHP_EOL;
            echo $result;
            foreach($list as $key=>$item)
            {
                $item = array_map(function($v){
                    return iconv("UTF-8", "GB2312//IGNORE", $v);
                },$item);
                $content = '"'.implode('","', $item).'"' . PHP_EOL;
                echo $content;
            }
            exit;
        }else{
            Config::set('default_return_type', 'json');
            return DB::name('stat_users_day')->paginate($size,false,['page'=>$page])->toArray();
        }

    }

}
