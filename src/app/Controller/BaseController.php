<?php

namespace App\Controller;


use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\Utils\ApplicationContext;
use Im\Admin\Request\RequestMessage;
use Im\Admin\Response\ResponseMessage;
use Im\Admin\Response\ResultMessage;

class BaseController extends AbstractController
{

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    protected $session;


    /**
     * 获取请求数据
     *
     * @return requestMessage
     * @throws \Exception
     */
    public function getRequestMessage()
    {
        $di = ApplicationContext::getContainer();
        $request         = $di->get(RequestInterface::class);
        $pjson           = $request->post('pjson');
        $pbin2           = $request->post('pbin2');
        $requestMessage2 = new RequestMessage();
        if ($pjson) {
            $requestMessage2->mergeFromJsonString($pjson);
        }
        if ($pbin2) {
            $requestMessage2->mergeFromString($pbin2);
        }
        if(!$pjson && !$pbin2){
            return null;
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