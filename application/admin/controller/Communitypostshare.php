<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20/8/12
 * Time: 00:19
 */
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;

class Communitypostshare extends Purview
{

    public function index()
    {
        $where = [];

        $list = Db::name('community_post_share')->where($where)->order('id desc')->paginate(20)->each(function($v,$key){
        $share_type_desc = array('','微信','微博','qq');
            $v['share_type_desc'] = $share_type_desc[$v['share_type']];
            if($v['post_id']){
                $post = Db::name('community_post')->where('id',$v['post_id'])->find();
                if($post){
                  $v['post_title'] = $post['title'];
                }else{
                    $v['post_title'] = '';
                }
            }else{
                $v['post_title'] = '';
            }

            if($v['user_id']){
                $user = Db::name('users')->where('id',$v['user_id'])->find();
                if($user){
                    $v['user_name'] = $user['nick'];
                }else{
                    $v['user_name'] = '';
                }
            }else{
                $v['user_name'] = '';
            }
            return $v;
        });

        $this->assign('list',$list);

        return $this->fetch();
    }


    public function praise()
    {
        $where = [];

        $list = Db::name('community_post_praise')->where($where)->order('id desc')->paginate(20)->each(function($v,$key){
            $read_status_desc = array('','未读','已读');
            $v['read_status_desc'] = $read_status_desc[$v['read_status']];

            $type_desc = array('','帖子点赞','评论点赞');
            $v['type_desc'] = $type_desc[$v['type']];


            //帖子
            if($v['post_id']){
                $post = Db::name('community_post')->where('id',$v['post_id'])->find();
                if($post){
                    $v['post_title'] = $post['title'];
                }else{
                    $v['post_title'] = '';
                }
            }else{
                $v['post_title'] = '';
            }

            if($v['user_id']){
                $user = Db::name('users')->where('id',$v['user_id'])->find();
                if($user){
                    $v['user_name'] = $user['nick'];
                }else{
                    $v['user_name'] = '';
                }
            }else{
                $v['user_name'] = '';
            }

            if($v['to_user_id']){
                $user = Db::name('users')->where('id',$v['to_user_id'])->find();
                if($user){
                    $v['to_user_name'] = $user['nick'];
                }else{
                    $v['to_user_name'] = '';
                }
            }else{
                $v['to_user_name'] = '';
            }

            if($v['comment_id']){
                $comment = Db::name('community_post_comment')->where('id',$v['comment_id'])->find();
                if($comment){
                    $v['comment_content'] = $comment['content'];
                }else{
                    $v['comment_content'] = '';
                }

            }else{
                $v['comment_content'] = '';
            }

            return $v;
        });

        $this->assign('list',$list);

        return $this->fetch();
    }


    public function collect()
    {
        $where = [];

        $list = Db::name('community_post_collect')->where($where)->order('id desc')->paginate(20)->each(function($v,$key){

            if($v['post_id']){
                $post = Db::name('community_post')->where('id',$v['post_id'])->find();
                if($post){
                    $v['post_title'] = $post['title'];
                }else{
                    $v['post_title'] = '';
                }
            }else{
                $v['post_title'] = '';
            }

            if($v['user_id']){
                $user = Db::name('users')->where('id',$v['user_id'])->find();
                if($user){
                    $v['user_name'] = $user['nick'];
                }else{
                    $v['user_name'] = '';
                }
            }else{
                $v['user_name'] = '';
            }

            if($v['to_user_id']){
                $user = Db::name('users')->where('id',$v['to_user_id'])->find();
                if($user){
                    $v['to_user_name'] = $user['nick'];
                }else{
                    $v['to_user_name'] = '';
                }
            }else{
                $v['to_user_name'] = '';
            }
            return $v;
        });

        $this->assign('list',$list);

        return $this->fetch();
    }



}