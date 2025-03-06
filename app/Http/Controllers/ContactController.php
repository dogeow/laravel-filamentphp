<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Log;

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
        try {
            // 创建联系记录
            $contact = Contact::create([
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'house_status' => $request->input('house_status'),
                'ip_address' => $request->ip(),
            ]);

            return response()->json([
                'message' => 'Contact form submitted successfully.',
                'data' => $contact
            ], 201);
        } catch (Exception $e) {
            // 记录错误日志
            Log::error('联系表单提交失败: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Submission failed, please try again later.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
} 