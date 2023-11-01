<?php

namespace App\Admin\Rbac\Controller;

use App\Admin\Controller\Controller;
use App\Admin\Model\Admin;
use App\Admin\Model\RbacResource;
use App\Admin\Validation\Rbac\ResAddValidation;
use Im\Admin\Common\AdminUser;
use Im\Admin\Request\Admin\AdminList;
use Im\Admin\Response\AdminReply;
use Im\Admin\Response\RbacReply;
use Im\Admin\Response\ResultMessage\ResultCode;

/**
 * Rbac的资源 增加
 *
 */
class AdminListController extends Controller
{

    public function handle()
    {
        /**
         * @var \Hyperf\Database\Model\Collection $list
         */
        $list  = Admin::all();
        $alist = [];
        /**
         * @var Admin $admin
         */
        foreach ($list as $admin) {
            $adminuser = new AdminUser();
            $adminuser->setId($admin->id);
            $adminuser->setAddress(' Address');
            $adminuser->setAvatar('');
            $adminuser->setName($admin->username);
            $alist[] = $adminuser;
        }
        $areply = new AdminReply();
        $da     = new AdminReply\ListReply();
        $da->setUser($alist);
        $areply->setList($da);

        return $this->reutrnData(ResultCode::SUCCESS, 'AdminList', 'admin', $areply);

    }


}
