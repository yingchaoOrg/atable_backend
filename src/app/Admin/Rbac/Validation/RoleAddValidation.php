<?php

namespace App\Admin\Rbac\Validation;

use AdminPb\Request\login;
use App\Admin\Rbac\Validator\ResAddUniValidator;
use App\Admin\Rbac\Validator\RoleAddUniValidator;
use App\Admin\Validation\BaseValidation;
use App\Admin\Validator\AdminPasswordValidator;
use App\Admin\Validator\AdminUserValidator;
use Im\Admin\Request\Rbac\Res\ResAdd;
use Inhere\Validate\Validation;

/**
 * 增加资源
 *
 *
 */
class RoleAddValidation extends BaseValidation
{


    public function rules(): array
    {
        return [
            [
                'name,title,status,isManager', 'required'
            ],
            [
                'name', 'string', 'min' => 3,
                'msg'=>'最短3个字符'
            ],
            [
                'name', new RoleAddUniValidator(),
                'msg' => '重复的标识',
                'on'=>'add'
            ],
            [
                'name', 'alphaNum',
                'msg'=>'仅限字符和数字'
            ],
            [
                'id','required',
                'on'=>'edit'
            ]
        ];
    }

}