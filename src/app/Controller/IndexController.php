<?php


namespace App\Controller;

use App\Grpc\HiClient;
use App\Grpc\UserClient;
use App\GrpcService\UserService;
use App\GrpcService\UserServiceInterface;
use Grpc\HiUser;

class IndexController extends AbstractController
{

    public function index()
    {
        return ["管理后台的服务器"];
    }

    public function index1()
    {
        dump(__LINE__);
        // 这个client是协程安全的，可以复用
        $client = new UserClient('192.168.3.113:32305');


        //      d
        $request = new \Grpc\User\Request\UserLogin();
        $request->setUsername('hyperf');
        $request->setPassword(1);


        /**
         * @var \Grpc\User\Response\Login $reply
         */
        list($reply, $status) = $client->login($request);
//
        dump(__LINE__);


        return $reply->getUser()->getUin();
    }

    public function login( )
    {
        /**
         * @var UserService $service
         */
        $service = $this->container->get(UserServiceInterface::class);
        // 这个client是协程安全的，可以复用
        $client = $service->client;

        //      d
        $request = new \Grpc\User\Request\UserLogin();
        $request->setUsername('hyperf');
        $request->setPassword(1);

        /**
         * @var \Grpc\User\Response\Login $reply
         */
        list($reply, $status) = $client->login($request);
//
        dump($reply, $status);


        return $reply->getUser()->getUin();
    }

}
