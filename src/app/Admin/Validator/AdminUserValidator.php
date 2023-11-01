<?php

namespace App\Admin\Validator;

use App\Admin\Model\Admin;
use Inhere\Validate\Validator\AbstractValidator;

/**
 *  后台的用户验证
 *
 */
class AdminUserValidator extends AbstractValidator
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
         * @var Admin $Admin
         */
        $Admin = Admin::query(true)->where('username', $value)->first();
        if (!$Admin) {
            return false;
        }
        
        return true;
    }

}