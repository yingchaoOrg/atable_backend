<?php

namespace App\Admin\Rbac\Controller;


use App\Admin\Controller\Controller;
use App\Admin\Model\Admin;
use App\Admin\Model\RbacResource;
use App\Admin\Model\RbacRole;
use App\Admin\Model\RbacRoleuser;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;
use ProtoRD\Helper;

/**
 * 角色的 用户
 *
 */
class RoleUserRemoveController extends Controller
{



    /** 编辑
     *
     */
    public function handle()
    {
        $roleId = $this->message->getRbac()->getRuremove()->getRoleId();
        $uid    = $this->message->getRbac()->getRuremove()->getUid();
        /**
         * @var RbacRoleuser $role
         */
        $roleUser = RbacRoleuser::query()->where([
                                                     'uid'  => $uid,
                                                     'role_id' => $roleId
                                                 ])->first();


        if (!$roleUser) {
            return $this->reutrnData(ResultCode::ERROR, '不存在的关联');
        }

        $roleUser->delete();

        return $this->reutrnData(ResultCode::SUCCESS, '管理员解除关联成功');
    }

}
