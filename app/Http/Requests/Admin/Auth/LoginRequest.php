<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'    => 'required|max:255',
            'password' => 'required|min:6|max:8'
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Email is required!',
            'email.max'         => 'Email max 255 characters',
            'password.required' => 'Password is required!',
            'password.min'      => 'Password from 6 to 8 characters',
            'password.max'      => 'Password from 6 to 8 characters',
        ];
    }
}
