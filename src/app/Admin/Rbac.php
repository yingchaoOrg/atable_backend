<?php

namespace App\Admin;

use App\Admin\Controller\Controller;
use Hyperf\Event\Contract\ListenerInterface;
use Im\Admin\Response\ResultMessage\ResultCode;
use ProtoRD\Event\DispatcherBeforeHandle;
use Hyperf\Event\Annotation\Listener;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Di\Annotation\Inject;


/**
 * rbac 权限鉴权
 *
 * @Listener
 */
class Rbac implements ListenerInterface
{

    /**
     * @Inject()
     * @var \Hyperf\Contract\SessionInterface
     */
    protected $session;

    public function listen(): array
    {
        return [
            DispatcherBeforeHandle::class
        ];
    }

    /**
     * @param DispatcherBeforeHandle $event
     * @return false
     */
    public function process(object $event)
    {
        if ($this->validation($event)) {
            return true;
        }
        $ci           = \Hyperf\Utils\ApplicationContext::getContainer();
        $event->allow = false;
        /**
         * @var \Hyperf\HttpServer\Response
         */
        $res = $ci->get(\Hyperf\HttpServer\Response::class);
        $res->write(Controller::reutrnData(ResultCode::AUTH, '没有权限'));
        $event->setResponse($res);

        return false;
    }

    /**
     * 进行验证
     * @param DispatcherBeforeHandle $event
     * @return bool
     */
    public function validation($event)
    {
        $res  = strtolower( $event->module . '-' . $event->controller . '-' . $event->func);
        $res1 = strtolower($event->module . '-' . $event->controller) ;
        dump($res,$res1);
        if ($res1 == 'user-login') {
            return true;
        }
        if ($this->session->get('admin.uid') === 1) {
            // 超级管理员
            return true;
        }

        return false;
    }

}