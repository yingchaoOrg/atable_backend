<?php

namespace App\Admin\Rbac\Validation;


use App\Admin\Rbac\Validator\ResAddUniValidator;
use App\Admin\Validation\BaseValidation;


/**
 * 增加资源
 *
 *
 */
class ResAddValidation extends BaseValidation
{


    public function rules(): array
    {
        return [
            [
                'menuName,title,icon', 'required'
            ],
            [
                'menuName', 'string', 'min' => 5
            ],
            [
                'menuName', new ResAddUniValidator(),
                'msg' => '重复的标识'
            ],
            [
                'tag', 'string', 'min' => 1
            ],
            [
                'pid', 'int', 'min' => 1, 'max' => 1000
            ]
        ];
    }

}