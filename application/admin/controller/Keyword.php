<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Config;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class Keyword extends Purview {

    private $mkeyword;

    public function __construct()
    {
        parent::__construct();
        $this->mkeyword = DB::name('keyword');
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

	/*
	 * 获取关键词
	 */
    public function getListPage()
    {

        $page = input('page',1);
        $size = input('size',10);
        Config::set('default_return_type', 'json');
        $query = $this->mkeyword
            ->field('k.id,k.content,k.created_at,k.user_id,m.username as user_name')
            ->alias('k')
            ->join('manager m','m.id=k.user_id','left');
        $start_time = input('start_time');
        $end_time = input('end_time');

        if($start_time)
        {
            $query->whereBetween('k.created_at',[$start_time,$end_time]);
        }
        return $query->order('k.id','desc')
            ->paginate($size,false,['page'=>$page])->toArray();
    }

    /*
     * 删除
    */
    public function Del(){
        Config::set('default_return_type', 'json');
        $id=input('id',0);
        if($id){
            if($this->mkeyword->delete($id)){
                return ['status'=>1,'msg'=>'成功'];
            }else{
                return ['status'=>0,'msg'=>'删除失败'];
            }
        }else{
            return ['status'=>0,'msg'=>'请选择删除!'];
        }
    }

    /*
     * 添加
     */
    public function add()
    {
        Config::set('default_return_type', 'json');
        $content = input('content');
        $user =Session::get('userinfo');
        if($content == '')
        {
            return ['status'=>0,'msg'=>'关键词不能为空!'];
        }
        $date = date('Y-m-d H:i:s');
        $data = [
            'content'=>$content,
            'created_at'=>$date,
            'update_at'=>$date,
            'user_id'=>$user['id'],
        ];
        $res = $this->mkeyword->insertGetId($data);
        if($res)
        {
            return ['status'=>1,'msg'=>'添加成功!','data'=>array_merge($data,['id'=>$res,'user_name'=>$user['username']])];
        }
        return ['status'=>0,'msg'=>'添加失败!'];

    }

}
