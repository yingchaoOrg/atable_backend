<?php

namespace App\Admin\User\Controller;


use App\Admin\Controller\Controller;
use App\Admin\Model\Admin;
use App\Admin\Validation\LoginValidation;
use Im\Admin\Common\User;
use Im\Admin\Response\ResultMessage\ResultCode;
use Im\Admin\Response\UserReply;


/**
 * 登陆 控制器
 */
class UserListController extends Controller
{

    public function handle()
    {

        $token =  $this->session->get('admin.token');
        if($token){
            $username =   $this->session->get('admin.username');
            $Admin = Admin::query(true)->where('username', $username)->first();
            // 组织返回信息
            $userReply = new UserReply();

            $infoReply = new UserReply\InfoReply();
            $infoReply->setToken($token);
            $infoReply->setUin($Admin->id);
            $user = new User();
            $user->setName($Admin->getAttributeValue('username'));
            $user->setAddress($user->getName()."的家");
            $user->setAvatar('https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png');
            $infoReply->setUser($user);
            $userReply->setInfo($infoReply);
        }else{
            // 组织返回信息
            $userReply = new UserReply();
            $infoReply = new UserReply\InfoReply();
            $infoReply->setUin(0);
            $userReply->setInfo($infoReply);
        }

        return $this->reutrnData(ResultCode::SUCCESS, '当前登陆用户', 'user', $userReply);
    }


}