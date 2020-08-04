<?php
/**
 * Created by PhpStorm.
 * User: 吾道建站
 * Date: 20/7/6
 * Time: 00:02
 * (吾道建站)保留在任何时刻，对代码内容进行添加、修改的权利
 * (吾道建站)对本代码可能出现的内容错误及缺失不承担任何责任。对此进行的更正将合并到此代码的最新版本中
 * 本代码的最终解释权归属于(吾道建站)
 * 版权所有：吾道建站 @2020
 * 吾道建站合作联系方式 微信:18226849637   QQ:730249592  备注: 吾道建站
 * 吾道建站座右铭:客户即合理 存在即合理
 */
namespace app\admin\controller;

use app\admin\common\Purview;
use think\Db;

class Trainday extends Purview
{

    public function index()
    {

        $list = Db::name('train_day')->order('id desc')->paginate(20)->each(function($v, $key){
//            if($v['image']){
//                $v['image'] = str_replace('Uploads','uploads',$v['image']);
//            }
            if($v['cate_id']){
               $train_day_cate = Db::name('train_day_cate')->where(array('id'=>$v['cate_id']))->find();
                if($train_day_cate){
                    $v['train_day_cate_name'] = $train_day_cate['title'];
                }else{
                    $v['train_day_cate_name'] = '';
                }
            }else{
                $v['train_day_cate_name'] = '';
            }
            return $v;
        });
        $this->assign('list',$list);
        return $this->fetch();
    }
}