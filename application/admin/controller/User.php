<?php
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;
use think\Session;
use think\Cookie;
use think\Cache;

class User extends Purview {

	//首页
    public function Index(){
        Cookie::set('Jumpurl',$_SERVER['REQUEST_URI']);
		$db=Db::name('users');

        $kwd = trim(input('kwd',''));
        if($kwd)
        {
            # phone nick user_name
            $list = $db
                ->whereOr('phone', 'like', "%{$kwd}%")
                ->whereOr('nick', 'like', "%{$kwd}%")
                ->whereOr('user_name', 'like', "%{$kwd}%")
                ->paginate(20,false,['query'=>request()->param()]);
        }else{
            $list = $db->paginate(20,false,['query'=>request()->param()]);
        }
        $page = $list->render();
        $list = $list->all();

        $this->assign('kwd', $kwd);
        /*******时实统计******/
        // 评测
        if(!$list)
        {
            $this->assign('list',[]);
            $this->assign('page',$page);
            return $this->fetch();
        }
        $users_ids = array_column($list,'id');
        $sql = sprintf('SELECT user_id,COUNT(user_id) AS total FROM tp_knowledge_health_record WHERE user_id IN(%s) ',implode(',',$users_ids));
        $health = array_column(DB::query($sql),'total','user_id');

        $sql = sprintf('SELECT user_id,COUNT(user_id) AS total FROM tp_knowledge_match_record WHERE user_id IN(%s) ',implode(',',$users_ids));
        $match = array_column(DB::query($sql),'total','user_id');

        $sql = sprintf('SELECT user_id,COUNT(user_id) AS total FROM tp_train_game_record WHERE user_id IN(%s) ',implode(',',$users_ids));
        $game = array_column(DB::query($sql),'total','user_id');

        // 发表文章数
        $sql = sprintf('SELECT user_id,COUNT(user_id) AS total FROM tp_community_post WHERE user_id IN(%s) ',implode(',',$users_ids));
        $post = array_column(DB::query($sql),'total','user_id');
        /*******时实统计 END******/
        foreach($list as $k=>$v){
            // 评测
            $list[$k]['do_question_num'] = ($health[$v['id']] ?? 0 ) + ($match[$v['id']] ?? 0) + ($game[$v['id']] ?? 0);
            // 发表文章数
            $list[$k]['publish_post_num'] = $post[$v['id']] ?? 0;
        }
        $this->assign('list',$list);
        $this->assign('page',$page);

        return $this->fetch();
    }
 
	
	//详情
    public function info(){
        if($this->request->isPost())
        {
            $db=Db::name('users');
            // 更新
            $id = input('id');
            $updateData = [
                'nick'=>input('nick'),
                'phone' => input('phone'),
                'wechat' => input('wechat'),
                'status' => input('status')
            ];
            $res = $db->where('id',$id)->update($updateData);
            $this->success('操作成功',url('index'));

        }else{
            // 展示
            $db=Db::name('users');
            $id=input('id',0);
            if($id)
            {
                $userRow = $db->find($id);
                $health = DB::name('knowledge_health_record')->where('user_id',$id)->count();
                $match = DB::name('knowledge_match_record')->where('user_id',$id)->count();
                $game = DB::name('train_game_record')->where('user_id',$id)->count();
                $post = DB::name('community_post')->where('user_id',$id)->count();
                $userRow['publish_post_num'] = $post;
                $userRow['do_question_num'] = $health + $match + $game;
                $this->assign('info',$userRow);
                return $this->fetch();
            }else{
                $this->error('请选择用户!');
            }
        }

    }
	
	//删除
	public function Del(){
        $db=Db::name('users');
		$id=input('id',0);
		if($id){
            Cache::rm("user_{$id}");//删除缓存
			if($db->delete($id)){
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
