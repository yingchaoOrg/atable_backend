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
class RoleResAddController extends Controller
{

    public function handle()
    {

        $roleId = $this->message->getRbac()->getRsadd()->getRoleId();
        $resArr =$this->message->getRbac()->getRsadd()->getResId();
        $resArr2 = Helper::repeatedFieldArray($resArr);
        /**
         * @var RbacRole $role
         */
        $role = RbacRole::query()->where('id',$roleId)->first();
        /**
         * @var  RbacResource[] $list
         */
        $list = RbacResource::whereIn('id',$resArr2)->get();
        $rulesArr =   explode(',',$role->rules);

        foreach ($list as $r){
            $rulesArr[] = $r->id;
        }
        $role->rules = implode(',',$rulesArr);
        $role->save();


        return $this->reutrnData(ResultCode::SUCCESS, '资源绑定成功');
    }



}
