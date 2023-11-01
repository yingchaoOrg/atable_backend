<?php

namespace App\Admin\Controller;

use App\Admin\Model\Admin;
use App\Admin\Validation\LoginValidation;
use Im\Admin\Common\AdminUser;
use Im\Admin\Common\User;
use Im\Admin\Response\HomeReply;
use Im\Admin\Response\HomeReply\LoginReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * 登陆控制器
 */
class LoginController extends Controller
{

    public function handle()
    {
        $loginMessage = $this->message->getHome()->getUserLogin();

        // 进行数据验证
        $validation = LoginValidation::makeForPb($loginMessage);
        $validation->validate();
        if ($validation->isFail()) {
            dump($validation->getTempData());
            return $this->reutrnData(ResultCode::ERROR, $validation->firstError());
        }
        // 进行数据处理
        $Admin = Admin::query(true)->where('username', $validation->getSafe('username'))->first();
        $token      = md5(time() . uniqid());

        $this->session->set('admin.username',$Admin->getAttributeValue('username'));
        $this->session->set('admin.uid',$Admin->getAttributeValue('id'));
        $this->session->set('admin.token',$token);

        // 组织返回信息
        $userReply = new HomeReply();
        $loginReply = new LoginReply();

        $loginReply->setToken($token);
        $user = new AdminUser();
        $user->setName($Admin->getAttributeValue('username'));
        $user->setAddress($user->getName()."的家");
        $user->setAvatar('https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png');
        $loginReply->setUser($user);

        $userReply->setLogin($loginReply);

        return $this->reutrnData(ResultCode::SUCCESS, '登陆成功', 'home', $userReply);
    }

}