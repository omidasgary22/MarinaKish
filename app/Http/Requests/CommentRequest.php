<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'body' => 'nullable|string',
            'answer' => 'nullable|string',
            'star' => 'integer|in:1,2,3,4,5',
            'status' => 'in:pending,approved,rejected',
        ];
    }



    public function messages()
    {
        return [
            'user_id.required' => 'شناسه کاربر اجباری است',
            'user_id.exists' => 'شناسه کاربر معتبر نیست',
            'product_id.required' => 'شناسه محصول اجباری است',
            'product_id.exists' => 'شناسه محصول معتبر نیست',
            'body.string' => 'متن نظر باید رشته‌ای باشد',
            'answer.string' => 'پاسخ باید رشته‌ای باشد',
            'star.in' => 'امتیاز باید بین 1 تا 5 باشد',
            'status.required' => 'وضعیت اجباری است',
            'status.in' => 'وضعیت باید یکی از مقادیر pending, approved, rejected باشد',
        ];
    }
}
