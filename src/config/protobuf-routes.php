<?php

$routerRule = new \ProtoRD\RouterRule();
$rule       = [
    \Im\Admin\Router\MODULE::HOME => [
        \Im\Admin\Router\HOME_ACTION::USERLOGIN => \App\Admin\Controller\LoginController::class
    ],
    \Im\Admin\Router\MODULE::USER => [
        \Im\Admin\Router\USER_ACTION::INFO => \App\Admin\User\Controller\InfoController::class,
        \Im\Admin\Router\USER_ACTION::LOGOUT => \App\Admin\User\Controller\LogoutController::class,

    ],
    \Im\Admin\Router\MODULE::RBAC => [
        \Im\Admin\Router\RBAC_ACTION::RESOURCE_LIST => \App\Admin\Rbac\Controller\ResListController::class,
        \Im\Admin\Router\RBAC_ACTION::RESOURCE_ADD => \App\Admin\Rbac\Controller\ResAddController::class,
        \Im\Admin\Router\RBAC_ACTION::RESOURCE_EDIT => \App\Admin\Rbac\Controller\ResEditController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_LIST => \App\Admin\Rbac\Controller\RoleListController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_ADD => \App\Admin\Rbac\Controller\RoleAddController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_EDIT => \App\Admin\Rbac\Controller\RoleEditController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_RES_LIST => \App\Admin\Rbac\Controller\RoleResListController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_RES_ADD => \App\Admin\Rbac\Controller\RoleResAddController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_RES_DEL => \App\Admin\Rbac\Controller\RoleResRemoveController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_USER_LIST => \App\Admin\Rbac\Controller\RoleUserListController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_USER_ADD => \App\Admin\Rbac\Controller\RoleUserAddController::class,
        \Im\Admin\Router\RBAC_ACTION::ROLE_USER_DEL => \App\Admin\Rbac\Controller\RoleUserRemoveController::class,
    ],
    \Im\Admin\Router\MODULE::ADMIN => [
        \Im\Admin\Router\ADMIN_ACTION::ALIST => \App\Admin\Rbac\Controller\AdminListController::class,
        ]
];

$routerRule->setRule($rule);
$routerRule->setModuleNameFunction('getModule');
$routerRule->setModuleEnumClass(\Im\Admin\Router\MODULE::class);
$routerRule->setModuleController([
                                     \Im\Admin\Router\MODULE::HOME     => \Im\Admin\Router\HOME_ACTION::class,
                                     \Im\Admin\Router\MODULE::ADMIN => \Im\Admin\Router\ADMIN_ACTION::class,
                                     \Im\Admin\Router\MODULE::USER     => \Im\Admin\Router\USER_ACTION::class,
                                     \Im\Admin\Router\MODULE::RBAC     => \Im\Admin\Router\RBAC_ACTION::class,
                                     \Im\Admin\Router\MODULE::WS_EVENT => \Im\Admin\Router\WS_EVENT_ACTION::class,
                                 ]);;


return [
    'admin' => $routerRule
];