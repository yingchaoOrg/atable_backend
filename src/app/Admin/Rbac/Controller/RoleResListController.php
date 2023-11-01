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
class RoleResListController extends Controller
{

    public function handle()
    {


        $roleId =  $this->message->getRbac()->getRslist()->getRoleId();
        $rArr = [];
        /**
         * @var RbacRole $role
         */
        $role = RbacRole::query()->where('id',$roleId)->first();
        if( $role->rules ){
            $rules = $role->rules ;
            $rulesArr = explode(',',$rules);
            // array_search


            $list = RbacResource::whereIn('id',$rulesArr)->get();


            /**
             * @var RbacResource $rbacRes
             */
            foreach ($list as $rbacRes) {
                $res = new \Im\Admin\Common\RbacResource();
                $res->setIcon($rbacRes->icon);
                $res->setId($rbacRes->id);
                $res->setIsMenu($rbacRes->is_menu);
                $res->setMenuName($rbacRes->getAttributeValue('menu_name'));
                $res->setPid($rbacRes->getAttributeValue('pid'));
                $res->setTitle($rbacRes->getAttributeValue('title'));
                $rArr[] = $res;
            }
        }


        $d1   = new RbacReply();
        $d2   = new RbacReply\RoleResList();
        if($rArr){
            $d2->setReslist($rArr);
        }

        $d3 = new \Im\Admin\Common\RbacRole();
        $d3->setId($role->id);
        $d3->setTitle($role->title);
        $d2->setRole($d3);

        $d1->setRslist($d2);

        return $this->reutrnData(ResultCode::SUCCESS, '', 'rbac', $d1);
    }


    public function ActionAdd()
    {

        $roleId = $this->message->getRbac()->getRs()->getAdd()->getRoleId();
        $resArr =$this->message->getRbac()->getRs()->getAdd()->getResId();
        $resArr2 = Helper::repeatedFieldArray($resArr);
        /**
         * @var RbacRole $role
         */
        $role = RbacRole::query()->where('id',$roleId)->first();
        /**
         * @var  RbacResource[] $list
         */
        $list = RbacResource::whereIn('id',$resArr2)->get();
        dump($resArr2);
        $rulesArr =   explode(',',$role->rules);

        foreach ($list as $r){
            $rulesArr[] = $r->id;
        }
        $role->rules = implode(',',$rulesArr);
        $role->save();


        return $this->reutrnData(ResultCode::SUCCESS, '');
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
