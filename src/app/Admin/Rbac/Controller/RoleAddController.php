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
class RoleAddController extends Controller
{

    public function handle()
    {


        $resInfo = $this->message->getRbac()->getRoleadd()->getRole();


        // 进行数据验证
        $validation = \App\Admin\Rbac\Validation\RoleAddValidation::makeForPb($resInfo);
        $validation->setScene('add')->validate();
        if ($validation->isFail()) {
            dump($validation->getTempData());

            return $this->reutrnData(ResultCode::ERROR, $validation->firstError());
        }
        $resModel            = new RbacRole();
        $resModel->title     = $validation->getSafe('title');
        $resModel->status      = $validation->getSafe('status', 0);
        $resModel->name = $validation->getSafe('name');
        $resModel->is_manager   = $validation->getSafe('isManager', 0);
        $resModel->rules = '';
        $resModel->save();
        // 组织返回数据
        $rbac  = new RbacReply();
        $rdata = new RbacReply\RoleAdd();
        $res   = new \Im\Admin\Common\RbacRole();
        $res->setId($resModel->id);
        $res->setName($resModel->name);
        $res->setTitle($resModel->title);
        $res->setIsManager($resModel->is_manager);
        $rdata->setRole($res);

        $rbac->setRoleadd($rdata);


        return $this->reutrnData(ResultCode::SUCCESS, '', 'rbac', $rbac);
    }



}
