<?php
namespace app\index\controller;

use \app\index\common\base;
use think\Db;

class News extends base{

    public function Index()
    {
        $list=Db::name('news')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
}
