<?php

namespace App\Admin\Validation;

use AdminPb\Request\requestMessage;
use Inhere\Validate\Validation;

class BaseValidation extends Validation
{

    /**
     * 使用protobuf对象构建验证
     *
     * @param \Google\Protobuf\Internal\Message $pbMessage
     * @param array $rules
     * @param array $translates
     * @param string $scene
     * @param bool $startValidate
     * @return BaseValidation|\Inhere\Validate\AbstractValidation
     */
    static public function makeForPb($pbMessage,
                                     array $rules = [],
                                     array $translates = [],
                                     string $scene = '',
                                     bool $startValidate = false)
    {
        if ($pbMessage) {
            $data = json_decode($pbMessage->serializeToJsonString(), true);
        } else {
            $data = [];
        }

        return self::make($data, $rules, $translates, $scene, $startValidate);
    }

    /**
     * 获取临时数据（不安全的数据）
     * @return array
     *
     */
    public function getTempData()
    {
        return $this->data;
    }


}