<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * 确定用户是否有权提交此请求
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 获取适用于请求的验证规则
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => ['nullable', 'string', 'max:20', 'required_without:email'],
            'email' => ['nullable', 'email', 'max:255', 'required_without:phone'],
            'address' => ['nullable', 'string', 'max:500'],
            'house_status' => ['nullable', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * 获取已定义验证规则的错误消息
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.required_without' => '电话和邮箱必须填写其中一个',
            'email.required_without' => '电话和邮箱必须填写其中一个',
            'phone.max' => '电话号码不能超过20个字符',
            'email.email' => '请输入有效的电子邮件地址',
            'email.max' => '电子邮件不能超过255个字符',
            'address.max' => '地址不能超过500个字符',
            'house_status.max' => '房屋状态不能超过100个字符',
            'message.max' => '留言内容不能超过1000个字符',
        ];
    }
} 