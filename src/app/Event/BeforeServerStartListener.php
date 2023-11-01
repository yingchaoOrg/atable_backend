<?php
namespace App\Event;

use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Event\Annotation\Listener;

/**
 * 服务启动之前
 *
 * @Listener
 */
class BeforeServerStartListener implements ListenerInterface
{

    public function listen(): array
    {
        return [
            \Hyperf\Framework\Event\BeforeServerStart::class
        ];

    }

    public function process(object $event)
    {


    }

}