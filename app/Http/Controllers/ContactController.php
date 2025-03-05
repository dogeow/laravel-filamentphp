<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * 存储联系表单提交的数据
     *
     * @param  \App\Http\Requests\ContactRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContactRequest $request): JsonResponse
    {
        // 创建联系记录
        $contact = Contact::create([
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'house_status' => $request->input('house_status'),
            'message' => $request->input('message'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => '联系表单已成功提交',
            'data' => $contact
        ], 201);
    }
} 