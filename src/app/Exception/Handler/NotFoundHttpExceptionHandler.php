<?php

namespace App\Exception\Handler;

use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;
use Hyperf\Utils\Context;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class NotFoundHttpExceptionHandler extends ExceptionHandler
{

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if($throwable instanceof NotFoundHttpException){
            $request = Context::get(ServerRequestInterface::class);
            dump($request->getUri()->getPath());
        }
    }

    public function isValid(Throwable $throwable): bool
    {
        return false;
    }

}