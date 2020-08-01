<?php
namespace app\index\controller;

use \app\index\common\base;
use think\Db;

class Index extends base{

    public function index()
    {
        header("location:/Admin/Login/Index/");
        exit();
        $list=Db::name('news')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
}
