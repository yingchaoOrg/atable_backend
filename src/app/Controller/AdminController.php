<?php

namespace App\Controller;

use Hyperf\Utils\Context;
use Im\Admin\Response\ResultMessage\ResultCode;
use Hyperf\HttpServer\Contract\ResponseInterface;
use ProtoRD\DispatcherApi2;
use ProtoRD\Helper;

/**
 *  后台的主控制器
 *
 */
class AdminController extends BaseController
{

    public function index(ResponseInterface $response)
    {

        try {
            $reqMsg = $this->getRequestMessage();

            if (!$reqMsg) {
                return \App\Admin\Controller\Controller::reutrnData(ResultCode::WARNING, "数据格式错误，收到的数据格式为：" . $this->request->post('pjson'));
            }
            $routerRule = Helper::getRouterConfig('admin');
            $dispather  = new DispatcherApi2($routerRule);

            return $dispather->handle($reqMsg);
        } catch (\Exception $exception) {
            echo $exception->getMessage() . $exception->getTraceAsString();

            return \App\Admin\Controller\Controller::reutrnData(ResultCode::SERVER_ERROR, "数据格式错误，收到的数据格式为：" . $this->request->post('pjson'));
        }

    }

    public function protobuf()
    {
        static $all;

        $type = $this->request->input('type');
        if (!isset($all[$type])) {
            $req        = include_once BASE_PATH . '/app/Admin/ProtobufDemo/' . $type . '.php';
            $all[$type] = $req->serializeToJsonString();
        }

        return $all[$type];
    }



}
