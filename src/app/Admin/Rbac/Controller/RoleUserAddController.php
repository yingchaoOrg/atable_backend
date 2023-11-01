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
class RoleUserAddController extends Controller
{

    public function handle()
    {


        $roleId = $this->message->getRbac()->getRuadd()->getRoleId();
        $uid    = $this->message->getRbac()->getRuadd()->getUid();
        /**
         * @var RbacRoleuser $role
         */
        $roleUser = RbacRoleuser::query()->where([
                                                     'uid'  => $uid,
                                                     'role_id' => $roleId
                                                 ])->first();


        if ($roleUser) {
            return $this->reutrnData(ResultCode::ERROR, '已经存在的关联');
        }

        $roleUser          = new RbacRoleuser();
        $roleUser->role_id = $roleId;
        $roleUser->uid     = $uid;
        $roleUser->save();


        return $this->reutrnData(ResultCode::SUCCESS, '关联成功');
    }




}
