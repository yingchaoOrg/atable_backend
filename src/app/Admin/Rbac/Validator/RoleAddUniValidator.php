<?php

namespace App\Admin\Rbac\Validator;

use App\Admin\Model\Admin;
use App\Admin\Model\RbacResource;
use App\Admin\Model\RbacRole;
use Inhere\Validate\Validator\AbstractValidator;

/**
 * 增加  角色 唯一验证
 *
 */
class RoleAddUniValidator extends AbstractValidator
{

    /**
     *
     * @param $value
     * @param array $data
     * @return bool
     */
    public function validate($value, array $data): bool
    {
        /**
         * @var RbacResource $Admin
         */
        $modole = RbacRole::query(true)->where('name', $value)->first();
        if ($modole) {
            return false;
        }
        
        return true;
    }

}