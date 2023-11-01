<?php

namespace App\Admin\Rbac\Validation;

use AdminPb\Request\login;
use App\Admin\Rbac\Validator\ResAddUniValidator;
use App\Admin\Rbac\Validator\ResIdExitValidator;
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
class ResEditValidation extends BaseValidation
{

    static $pbClass = ResAdd::class;

    public function rules(): array
    {
        return [
            [
                'menuName,title,id,icon,pid,isMenu', 'required'
            ],
            [
                'menuName', 'string', 'min' => 5
            ],
            [
                'id', new ResIdExitValidator(),
                'msg'=>'重复的标识'
            ],
        ];
    }

}