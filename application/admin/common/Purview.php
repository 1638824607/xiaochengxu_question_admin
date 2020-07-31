<?php
namespace app\admin\common;
use think\Request;
use think\Controller;
use think\Session;
use think\Cookie;
use think\Db;

class Purview extends controller {
    function __construct(){
 		parent::__construct();
        $PHP_URL=$_SERVER['REQUEST_URI'];

        $request = Request::instance();
        $PHP_IP=$request->ip();
        $module = $request->module();
        $controller=$request->controller();
        $action=$request->action();
        $now_ac="{$controller}-{$action}";
        //echo $controller;
        //echo $action;
        //exit();
        if($controller=='Sort'&&$action=='action'){

        }else{

            $admin_role_auth_ids=Session::Get('admin_role_auth_ids');
            if($admin_role_auth_ids){
                $qxid=explode(",",$admin_role_auth_ids);
            }

            if(Session::Get('admin_id')){
            }else{
                $this->success("请先登录！",URL("Login/Index"),1);
                exit();
            }
            $admin_role_auth_ids=Session::Get('admin_role_auth_ids');
            $qxid=explode(",",$admin_role_auth_ids);
            if($admin_role_auth_ids){

                if(Session::Get('gty'))  $now_ty=Session::Get('gty');


                if(!in_array($now_ty,$qxid)){
                    $this->success("没有权限！",URL("Login/Index"),1);
                    exit();
                }


                if($controller=='Settings'){
                    if(!in_array(9901,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Model'){
                    if(!in_array(9902,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Sort'&&$action<>'Make'){
                    if(!in_array(9903,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Role'){
                    if(!in_array(9904,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Manager'&&$action<>'Person'){
                    if(!in_array(9905,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Logs'){
                    if(!in_array(9906,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Backup'){
                    if(!in_array(9907,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

                if($controller=='Sort'&&$action=='Make'){
                    if(!in_array(9908,$qxid)){
                        $this->success("没有权限！",URL("Login/Index"),1);
                        exit();
                    }
                }

            }
        }
    }
}
?>