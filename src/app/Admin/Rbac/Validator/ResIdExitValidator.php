<?php

namespace App\Admin\Rbac\Validator;

use App\Admin\Model\Admin;
use App\Admin\Model\RbacResource;
use Inhere\Validate\Validator\AbstractValidator;

/**
 * 增加资源 是否存在
 *
 */
class ResIdExitValidator extends AbstractValidator
{

    /**
     * 验证
     *
     * @param string $value 用户名
     * @param array $data 登陆数据
     * @return bool 验证结果
     */
    public function validate($value, array $data): bool
    {
        /**
         * @var RbacResource $Admin
         */
        $modole = RbacResource::query(true)->where('id', $value)->first();
        if ($modole) {
            return true;
        }
        
        return false;
    }

}