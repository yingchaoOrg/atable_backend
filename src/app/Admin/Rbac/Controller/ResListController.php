<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\RbacResource;
use App\Admin\Validation\Rbac\ResAddValidation;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * Rbac的资源列表
 *
 */
class ResListController extends Controller
{
    public function handle()
    {

        $type = $this->message->getRbac()->getReslist()->getQtype();
        if($type){
            $list = RbacResource::query()->where('is_menu',0)->get();
        }else{
            $list = RbacResource::query()->get();
        }

        $rArr = [];

        /**
         * @var RbacResource $rbacRes
         */
        foreach ($list as $rbacRes){
            $res = new \Im\Admin\Common\RbacResource();
            $res->setIcon($rbacRes->getAttributeValue('icon'));
            $res->setIsMenu($rbacRes->getAttributeValue('is_menu'));
            $res->setMenuName($rbacRes->getAttributeValue('menu_name'));
            $res->setPid($rbacRes->getAttributeValue('pid'));
            $res->setId($rbacRes->getAttributeValue('id'));
            $res->setTitle($rbacRes->getAttributeValue('title'));

            $res->setTags(explode(',',$rbacRes->getAttributeValue('tags')));
            $rArr[] = $res;
        }
        $rbac = new RbacReply();
        $rlist = new RbacReply\ResList();
        $rlist->setRlist($rArr);
        $rbac->setReslist($rlist);

        return $this->reutrnData(ResultCode::SUCCESS,'','rbac',$rbac);
    }



}
