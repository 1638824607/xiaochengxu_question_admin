<?php
namespace app\index\controller;

use \app\index\common\base;
use think\Db;

class Contact extends base{

    public function Index()
    {
        $list=Db::name('news')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
}
