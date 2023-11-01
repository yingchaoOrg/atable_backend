<?php

namespace App\Controller\Admin;

use AdminPb\Request\requestMessage;
use AdminPb\Response\responseMessage;
use AdminPb\Response\resultMessage;
use App\Controller\AbstractController;
use Hyperf\Di\Annotation\Inject;

class AdminBaseController extends AbstractController
{

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    protected $session;
    /**
     * @var requestMessage $requestMessage2
     */
    protected $requestMessage2;

    public function __construct()
    {
        $this->requestMessage2 = $this->getRequestMessage();
    }

    /**
     * 获取请求数据
     *
     * @return requestMessage
     * @throws \Exception
     */
    public function getRequestMessage()
    {
        $request         = $this->request;
        $pjson           = $request->post('pjson');
        $pbin2           = $request->post('pbin2');
        $requestMessage2 = new requestMessage();
        dump($pjson);
        if ($pjson) {
            $requestMessage2->mergeFromJsonString($pjson);
        }
        if ($pbin2) {
            $requestMessage2->mergeFromString($pbin2);
        }

        return $requestMessage2;
    }

    /**
     * 返回数据
     *
     * @param string $msg
     * @param array $data
     * @param int $code
     * @return array
     */
    protected function reutrnData(string $msg, array $data = [], int $code = 0): array
    {
        return [
            'code'    => $code,
            'message' => $msg,
            'data'    => $data
        ];
    }

    /**
     * 组织数据返回
     *
     * @param int $code
     * @param string $msg
     * @param string $index
     * @param $data
     * @return string
     */
    public function reutrnData2(int $code, string $msg, string $index = '', $data = null): string
    {
        $resp = new responseMessage();
        $ret  = new resultMessage();
        $ret->setCode($code);
        $ret->setMsg($msg);
        $resp->setResult($ret);
        if ($index) {
            $function = 'set' . ucfirst($index);
            $resp->$function($data);
        }

        return $resp->serializeToJsonString();

    }

}