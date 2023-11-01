<?php

namespace App\Admin\Rbac\Validator;

use App\Admin\Model\Admin;
use App\Admin\Model\RbacResource;
use Inhere\Validate\Validator\AbstractValidator;

/**
 * 增加资源唯一验证
 *
 */
class ResAddUniValidator extends AbstractValidator
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
        $modole = RbacResource::query(true)->where('menu_name', $value)->first();
        if ($modole) {
            return false;
        }
        
        return true;
    }

}