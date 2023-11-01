<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\RbacResource;
use App\Admin\Model\RbacRole;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;
use ProtoRD\Helper;

/**
 * Rbac 的 角色
 *
 */
class RoleResRemoveController extends Controller
{

    public function handle()
    {

        $roleId = $this->message->getRbac()->getRsremove()->getRoleId();
        $resArr =$this->message->getRbac()->getRsremove()->getResId();
        $resArr2 = Helper::repeatedFieldArray($resArr);
        /**
         * @var RbacRole $role
         */
        $role = RbacRole::query()->where('id',$roleId)->first();
        $rulesArr =   explode(',',$role->rules);
        $rulesArr2 = array_diff($rulesArr,$resArr2);

        $role->rules = implode(',',$rulesArr2);
        $role->save();

        return $this->reutrnData(ResultCode::SUCCESS, '资源解绑成功');
    }


}
