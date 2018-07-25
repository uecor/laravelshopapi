<?php

namespace App\Http\Requests\Api;

use Dingo\Api\Http\FormRequest;

class CaptchaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
          // 用户必须通过手机号调用图片验证码接口
            'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:users',
        ];
    }
}
