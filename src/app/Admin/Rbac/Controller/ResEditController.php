<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\RbacResource;
use App\Admin\Validation\Rbac\ResAddValidation;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * Rbac的资源 编辑
 *
 */
class ResEditController extends Controller
{
    public function handle()
    {
        $resInfo  = $this->message->getRbac()->getResedit()->getRes();

        // 进行数据验证
        $validation = \App\Admin\Rbac\Validation\ResEditValidation::makeForPb($resInfo);
        $validation->validate();
        if ($validation->isFail()) {
            dump($validation->getTempData());
            return $this->reutrnData(ResultCode::ERROR, $validation->firstError());
        }
        $resModel = RbacResource::query()->where('id',$validation->getSafe('id'))->first();
        $resModel->title = $validation->getSafe('title');
        $resModel->icon = $validation->getSafe('icon','');
        $resModel->menu_name  = $validation->getSafe('menuName');
        $resModel->tags  = implode( ',',$validation->getSafe('tags',[]));
        $resModel->is_menu  = $validation->getSafe('isMenu',0);
        $resModel->pid  = $validation->getSafe('pid',0);

        $resModel->save();
        // 组织返回数据
        $rbacR = new RbacReply();
        $rdata = new RbacReply\ResEdit();
        $res = new \Im\Admin\Common\RbacResource();
        $res->setPid($resModel->pid);
        $res->setMenuName($resModel->menu_name);
        $res->setTitle($resModel->title);
        $res->setId($resModel->id);
        if($resModel->tags){
            $res->setTags(explode(',',$resModel->tags));
        }

        $res->setIsMenu($resModel->is_menu);
        $res->setIcon($resModel->icon);
        $rdata->setRes($res);
        $rbacR->setResedit($rdata);

        return $this->reutrnData(ResultCode::SUCCESS,'编辑成功','rbac',$rbacR);
    }




}
