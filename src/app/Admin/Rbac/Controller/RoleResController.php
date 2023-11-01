<?php

namespace App\Admin\Rbac\Controller;


use App\Admin\Controller\Controller;
use App\Admin\Model\RbacResource;
use App\Admin\Model\RbacRole;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;
use ProtoRD\Helper;

/**
 * 角色 的 资源管理
 *
 */
class RoleResController extends Controller
{

    public function handle()
    {
        // TODO: Implement handle() method.
    }





    /** 编辑
     *
     */
    public function ActionRemove()
    {

        $roleId = $this->message->getRbac()->getRs()->getRemove()->getRoleId();
        $resArr =$this->message->getRbac()->getRs()->getRemove()->getResId();
        $resArr2 = Helper::repeatedFieldArray($resArr);
        /**
         * @var RbacRole $role
         */
        $role = RbacRole::query()->where('id',$roleId)->first();
        $rulesArr =   explode(',',$role->rules);
        $rulesArr2 = array_diff($rulesArr,$resArr2);

        $role->rules = implode(',',$rulesArr2);
        $role->save();

        return $this->reutrnData(ResultCode::SUCCESS, '');
    }

}
