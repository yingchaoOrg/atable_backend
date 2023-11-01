<?php

namespace App\Admin\Validation;

use AdminPb\Request\login;
use App\Admin\Validator\AdminPasswordValidator;
use App\Admin\Validator\AdminUserValidator;
use Inhere\Validate\Validation;

/**
 * 登陆验证
 */
class LoginValidation extends BaseValidation
{

    static $pbClass = login::class;

    public function rules(): array
    {
        return [
            [
                'username,password', 'required'
            ],
            [
                'username', 'string', 'min' => 5
            ],
            [
                'username', new AdminUserValidator()
            ],
            [
                'password', new AdminPasswordValidator(),
                'msg' => 'passworderror'
            ],
        ];
    }

}