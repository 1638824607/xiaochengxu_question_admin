<?php
namespace app\index\common;
use think\Request;
use think\Controller;
use think\Session;

class base extends Controller{
    function __construct(){
        $request = Request::instance();
 		parent::__construct();
		$now_ac=$request->controller()."-".$request->action();
 	}
}
?>