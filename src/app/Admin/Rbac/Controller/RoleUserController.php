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
class RoleUserController extends Controller
{

    public function handle()
    {
        // TODO: Implement handle() method.
    }

    public function ActionList()
    {
        $roleId = $this->message->getRbac()->getRu()->getList()->getRoleId();
        $rArr   = [];

        $role = RbacRole::query()->where('id', $roleId)->first();

        $uids = RbacRoleuser::query()->where('role_id', $roleId)->pluck('uid')->toArray();
        dump($uids);
        if ($uids) {


            $list = Admin::whereIn('id', $uids)->get();


            /**
             * @var Admin $admin
             */
            foreach ($list as $admin) {
                $res = new \Im\Admin\Common\User();
                $res->setName($admin->username);
                $res->setUin($admin->id);
                $rArr[] = $res;
            }
        }


        $rbac = new RbacReply();
        $d1   = new RbacReply\RoleUserRes();
        $d2   = new RbacReply\RoleUserRes\RoleUserList();
        if ($rArr) {
            $d2->setList($rArr);
        }

        $d3 = new \Im\Admin\Common\RbacRole();
        $d3->setId($role->id);
        $d3->setTitle($role->title);
        $d2->setRole($d3);
        $d1->setRulist($d2);
        $rbac->setRu($d1);

        return $this->reutrnData(ResultCode::SUCCESS, '', 'rbac', $rbac);
    }


    public function ActionAdd()
    {

        $roleId = $this->message->getRbac()->getRu()->getAdd()->getRoleId();
        $uid    = $this->message->getRbac()->getRu()->getAdd()->getUid();
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


        return $this->reutrnData(ResultCode::SUCCESS, '');
    }


    /** 编辑
     *
     */
    public function ActionRemove()
    {
        $roleId = $this->message->getRbac()->getRu()->getRemove()->getRoleId();
        $uid    = $this->message->getRbac()->getRu()->getRemove()->getUid();
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

        return $this->reutrnData(ResultCode::SUCCESS, '');
    }

}
