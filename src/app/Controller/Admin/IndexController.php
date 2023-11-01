<?php

namespace App\Controller\Admin;

use AdminPb\Common\page;
use AdminPb\Request\PBlist;
use AdminPb\Request\requestMessage;
use AdminPb\Response\loginReply;
use AdminPb\Response\nowUser;
use AdminPb\Response\responseMessage;
use AdminPb\Response\resultMessage;
use AdminPb\Response\resultMessage\resultCode;
use AdminPb\Response\user;
use App\Admin\Validation\LoginValidation;
use App\Model\Admin;
use Hyperf\HttpServer\Contract\RequestInterface;

class IndexController extends AdminBaseController
{


    public function index()
    {
        return $this->reutrnData("Apay Admin", [
            time()
        ]);

    }


    public function protobufdemo(RequestInterface $request)
    {

        $requestMessage2 = $this->getRequestMessage();

        return $this->reutrnData('', [
            json_decode($requestMessage2->serializeToJsonString())
        ]);
    }


    public function login()
    {
        // 获取数据
        $reqMsg = $this->getRequestMessage();
        $login  = $reqMsg->getLogin();

        // 进行数据验证
        $validation = LoginValidation::makeForPb($login);
        $validation->validate();
        if ($validation->isFail()) {
            return $this->reutrnData2(resultCode::ERROR, $validation->firstError());
        }
        // 进行数据处理
        $Admin = Admin::query(true)->where('username', $validation->getSafe('username'))->first();
        $token      = md5(time() . uniqid());

        $this->session->set('admin.username',$Admin->getAttributeValue('username'));
        $this->session->set('admin.uid',$Admin->getAttributeValue('id'));
        $this->session->set('admin.token',$token);

        // 组织返回信息
        $loginReply = new loginReply();
        $loginReply->setToken($token);
        $loginReply->setUsername($Admin->getAttributeValue('username'));
        $user = new user();
        $user->setName($Admin->getAttributeValue('username'));
        $user->setAddress($user->getName()."的家");
        $user->setAvatar('https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png');
        $loginReply->setUser($user);
        return $this->reutrnData2(resultCode::SUCCESS, '', 'login', $loginReply);

    }

    public function nowuser()
    {

        $uid =  $this->session->get('admin.uid');
        if(!$uid){
            return $this->reutrnData2(resultCode::AUTH,'');
        }

        $token = $this->session->get('admin.token');
        $nowUserReply = new nowUser();
        $nowUserReply->setToken($token);
        $nowUserReply->setUid($uid);
        $nowUserReply->setUsername( $this->session->get('admin.username'));

        return $this->reutrnData2(resultCode::SUCCESS, '', 'nowuser', $nowUserReply);

    }





}
