<?php

namespace App\Admin\Controller;

use Im\Admin\Request\requestMessage;
use Im\Admin\Response\ResponseMessage;
use Im\Admin\Response\ResultMessage;
use Hyperf\Di\Annotation\Inject;

/**
 *
 * 控制器基类
 *
 * @property requestMessage $message
 */
abstract class Controller extends \ProtoRD\ApiController
{

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    protected $session;

    /**
     * 组织数据返回
     *
     * @param int $code
     * @param string $msg
     * @param string $index
     * @param $data
     * @return string
     */
    static public function reutrnData(int $code, string $msg, string $index = '', $data = null): string
    {
        $resp = new ResponseMessage();
        $ret  = new ResultMessage();
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