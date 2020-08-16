<?php

namespace app\admin\common;

use think\Request;
use think\Controller;
use think\Session;
use think\Cookie;
use think\Db;

class Purview extends controller
{
    protected $user_info_update_flag_file_dir = './data/';
    function __construct()
    {
        parent::__construct();
        $PHP_URL = $_SERVER['REQUEST_URI'];
        if(!is_dir($this->user_info_update_flag_file_dir))
        {
            mkdir($this->user_info_update_flag_file_dir);
        }
        $request    = Request::instance();
        $PHP_IP     = $request->ip();
        $module     = $request->module();
        $controller = $request->controller();
        $action     = $request->action();
        $now_ac     = "{$controller}-{$action}";
        //echo $controller;
        //echo $action;
        //exit();
        if ($controller == 'Sort' && $action == 'action') {

        } else {

            $admin_role_auth_ids = Session::Get('admin_role_auth_ids');
            if ($admin_role_auth_ids) {
                $qxid = explode(",", $admin_role_auth_ids);
            }
            $user_auth = session('userinfo');    
            if ($user_auth['id']) {
                if(file_exists($this->user_info_update_flag_file_dir . $user_auth['id']))
                {
                    // 用户信息发生了变化, 可能被删除, 刷新session 
                    $db = Db::name('manager');
                    $info = $db->where("id={$user_auth['id']}")->find();
                 
                    if($info)
                    {
                      
                        Session::set('admin_id',$info['id']);
                        Session::set('admin_username',$info['username']);
                        Session::set('admin_role_name',$arr['role_name']);
                        Session::set('userinfo',$info);
                    }else{
                        Session::delete('admin_id');
                        Session::delete('admin_username');
                        Session::delete('admin_role_name');
                        Session::delete('userinfo');
                        $this->success("请先登录！", URL("Login/Index"), 1);
                        exit();
                    }

                    unlink($this->user_info_update_flag_file_dir . $user_auth['id']);
                   
                }
            
            } else {
                $this->success("请先登录！", URL("Login/Index"), 1);
                exit();
            }
            $admin_role_auth_ids = Session::Get('admin_role_auth_ids');
            $qxid                = explode(",", $admin_role_auth_ids);
            if ($admin_role_auth_ids) {

                if (Session::Get('gty')) $now_ty = Session::Get('gty');


                if (! in_array($now_ty, $qxid)) {
                    $this->success("没有权限！", URL("Login/Index"), 1);
                    exit();
                }


                if ($controller == 'Settings') {
                    if (! in_array(9901, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Model') {
                    if (! in_array(9902, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Sort' && $action <> 'Make') {
                    if (! in_array(9903, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Role') {
                    if (! in_array(9904, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Manager' && $action <> 'Person') {
                    if (! in_array(9905, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Logs') {
                    if (! in_array(9906, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Backup') {
                    if (! in_array(9907, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }

                if ($controller == 'Sort' && $action == 'Make') {
                    if (! in_array(9908, $qxid)) {
                        $this->success("没有权限！", URL("Login/Index"), 1);
                        exit();
                    }
                }
            }

            $adminAuthList = $this->get_auth_list($admin_role_auth_ids);

            $this->assign('adminAuthList', $adminAuthList);
        }

        $this->assign('now_time',date('Y'));
    }

    public function get_auth_list($admin_role_auth_ids)
    {
        $mca = getMca();

        $sortInfo = Db::name('sort')->where(['sort_c' => $mca['c'], 'sort_a' => $mca['a']])->find();
        $id      = empty($sortInfo['id']) ? 0 : $sortInfo['id'];
//        $pid      = empty($sortInfo['pid']) ? 0 : $sortInfo['pid'];
        $idList  = $this->getCurIdList($id);

        $sqlkey1 = ' AND pid = 0';
        if ($admin_role_auth_ids == 0) $sqlkey1 .= ""; else $sqlkey1 .= " AND id in(" . $admin_role_auth_ids . ")";
        $list1 = Db::name('sort')->field('*')->where("status=1{$sqlkey1}")->order('disorder asc,id asc')->select();;
        if (empty($list1)) {
            return [];
        }

        foreach ($list1 as &$v1) {
            $sqlkey2 = ' AND pid = ' . $v1['id'];
            if ($admin_role_auth_ids == 0) $sqlkey2 .= ""; else $sqlkey2 .= " AND id in(" . $admin_role_auth_ids . ")";
            $list2 = Db::name('sort')->field('*')->where("status=1{$sqlkey2}")->order('disorder asc,id asc')->select();

            if($v1['id'] == $idList[0]) {
                $v1['is_active'] = true;
            }else{
                $v1['is_active'] = false;
            }

            if(empty($list2)) {
                $v1['child']     = [];
                $v1['is_active'] = false;
                continue;
            }

            foreach($list2 as &$v2) {
                $sqlkey3 = ' AND pid = ' . $v2['id'];
                if ($admin_role_auth_ids == 0) $sqlkey3 .= ""; else $sqlkey3 .= " AND id in(" . $admin_role_auth_ids . ")";
                $list3 = Db::name('sort')->field('*')->where("status=1{$sqlkey3}")->order('disorder asc,id asc')->select();

                if($v2['id'] == $idList[1]) {
                    $v2['is_active'] = true;
                }else{
                    $v2['is_active'] = false;
                }

                if(empty($list3)) {
                    $v2['child'] = [];
                    continue;
                }

                $v2['child'] = $list3;
            }

            $v1['child'] = $list2;
        }

        return $list1;
    }

    public function getCurIdList($id)
    {
        if(empty($id)) {
            return [];
        }

        $idList = [$id];

        $parentSortInfo = Db::name('sort')->field('id, pid')->where('id', $id)->find();

        if(empty($parentSortInfo['pid'])) {
            return $idList;
        }

        $parentSortInfo = Db::name('sort')->field('id, pid')->where('id', $parentSortInfo['pid'])->find();

        if( empty($parentSortInfo['id'])) {
            return $idList;
        }

        array_unshift($idList, $parentSortInfo['id']);

        $parentSortInfo = Db::name('sort')->field('id, pid')->where('id', $parentSortInfo['pid'])->find();

        if( empty($parentSortInfo['id'])) {
            return $idList;
        }

        array_unshift($idList, $parentSortInfo['id']);

        return $idList;
    }
}

?>