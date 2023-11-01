<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\RbacRole;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * Rbac 的 角色 编辑
 *
 */
class RoleEditController extends Controller
{

    public function handle()
    {

        $resInfo = $this->message->getRbac()->getRoleedit()->getRole();

        // 进行数据验证
        $validation = \App\Admin\Rbac\Validation\RoleAddValidation::makeForPb($resInfo);
        $validation->setScene('edit')->validate();
        if ($validation->isFail()) {
            dump($validation->getTempData());

            return $this->reutrnData(ResultCode::ERROR, $validation->firstError());
        }
        $resModel            = RbacRole::where('id',$validation->getSafe('id'))->first();
        $resModel->title     = $validation->getSafe('title');
        $resModel->status      = $validation->getSafe('status');
        $resModel->name = $validation->getSafe('name');
        $resModel->is_manager   = $validation->getSafe('isManager');
        $resModel->save();
        // 组织返回数据
        $rbac  = new RbacReply();

        $rdata = new RbacReply\RoleEdit();
        $res   = new \Im\Admin\Common\RbacRole();
        $res->setId($resModel->id);
        $res->setName($resModel->name);
        $res->setTitle($resModel->title);

        $res->setIsManager($resModel->is_manager);

        $rdata->setRole($res);

        $rbac->setRoleedit($rdata);


        return $this->reutrnData(ResultCode::SUCCESS, '角色编辑成功', 'rbac', $rbac);
    }



}
