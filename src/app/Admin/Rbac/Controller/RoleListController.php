<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\RbacRole;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * Rbac 的 角色
 *
 */
class RoleListController extends Controller
{

    public function handle()
    {
        $list = RbacRole::query()->get();
        $d1   = new RbacReply();
        $d2   = new RbacReply\RoleList();
        $rArr = [];
        /**
         * @var RbacRole $role
         */
        foreach ($list as $role) {
            $res = new \Im\Admin\Common\RbacRole();
            $res->setName($role->getAttributeValue('name'));
            $res->setIsManager($role->getAttributeValue('is_manager'));
            $res->setStatus($role->getAttributeValue('status'));
            $res->setTitle($role->getAttributeValue('title'));
            $res->setId($role->id);
            $rArr[] = $res;
        }
        $d2->setRlist($rArr);
        $d1->setRolelist($d2);

        return $this->reutrnData(ResultCode::SUCCESS, '', 'rbac', $d1);
    }



}
