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
            'phone' => ['bail', 'nullable', 'string', 'max:255', 'required_without:email'],
            'email' => ['bail', 'nullable', 'email', 'max:255', 'required_without:phone'],
            'address' => ['bail', 'nullable', 'string', 'max:255'],
            'house_status' => ['bail', 'nullable', 'string', 'max:255'],
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
            'phone.required_without' => 'Either phone or email must be provided.',
            'email.required_without' => 'Either phone or email must be provided.',
            'phone.max' => 'The phone number cannot exceed 255 characters.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email address cannot exceed 255 characters.',
            'address.max' => 'The address cannot exceed 255 characters.',
            'house_status.max' => 'The house status cannot exceed 255 characters.',
        ];
    }
} 