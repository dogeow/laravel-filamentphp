<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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
            // 获取客户端IP地址
            $ipAddress = $request->ip();
            
            // 检查该IP今天是否已经提交过表单
            $today = Carbon::today();
            $hasSubmittedToday = Contact::where('ip_address', $ipAddress)
                ->whereDate('created_at', $today)
                ->exists();
                
            // 如果已经提交过，返回错误响应
            if ($hasSubmittedToday) {
                return response()->json([
                    'message' => 'You have already submitted the form.',
                    'error' => 'ip_throttled'
                ], 429); // 429 Too Many Requests
            }
            
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