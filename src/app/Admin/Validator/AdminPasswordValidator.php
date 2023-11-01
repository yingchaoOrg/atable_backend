<?php

namespace App\Admin\Validator;

use App\Admin\Model\Admin;
use Inhere\Validate\Validator\AbstractValidator;

/**
 *  后台的用户验证
 *
 */
class AdminPasswordValidator extends AbstractValidator
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
        $username=  $data['username'];
        /**
         * @var Admin $Admin
         */
        $Admin = Admin::query(true)->where('username', $username)->first();
        if (!$Admin) {
            return false;
        }
        // 密码
        $password = $data['password'];
        if(!password_verify($password,$Admin->getAttribute('password'))){
            return false;
        }

        return true;
    }

}