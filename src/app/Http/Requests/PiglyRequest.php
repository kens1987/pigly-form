<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PiglyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->routeIs('login') || $this->routeIs('login.submit')) {
            return [
                'email' => 'required|email',
                'password' => 'required|string',
            ];
        }
        if($this->routeIs('register.step2.submit')) {
            return [
                'weight' => 'required|numeric|min:1',
                'target_weight' => 'required|numeric|min:1',
            ];
        }
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'weight.required' => '現在の体重を入力してください',
            'weight.numeric' => '4桁までの数字で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '4桁までの数字で入力してください',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->routeIs('register.step2.submit')) {
                if ($this->filled('weight')) {
                    $weight = $this->input('weight');
                    if (strlen((string)floor($weight)) > 4) {
                        $validator->errors()->add('weight', '4桁までの数字で入力してください');
                    }
                    if (preg_match('/\.\d{2,}/', $weight)) {
                        $validator->errors()->add('weight', '小数点は1桁で入力してください');
                    }
                }
                if ($this->filled('target_weight')) {
                    $targetWeight = $this->input('target_weight');
                    if (strlen((string)floor($targetWeight)) > 4) {
                        $validator->errors()->add('target_weight', '4桁までの数字で入力してください');
                    }
                    if (preg_match('/\.\d{2,}/', $targetWeight)) {
                        $validator->errors()->add('target_weight', '小数点は1桁で入力してください');
                    }
                }
            }
        });
    }
}
