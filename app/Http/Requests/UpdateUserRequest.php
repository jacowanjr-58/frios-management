<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->hasAnyRole(['super_admin', 'corporate_admin']);
    }

    public function rules()
    {
        $userId = is_object($this->route('user')) ? $this->route('user')->id : $this->route('user');

        return [
            'name'          => 'required|string|max:255',
            'email'         => "required|email|unique:users,email,{$userId}",
            'password'      => 'nullable|string|min:8|confirmed',
            'franchisee_id' => in_array($this->input('role'), ['franchise_admin', 'franchise_staff'])
                ? 'required|exists:franchisees,id'
                : 'nullable',
            'role'          => 'required|in:super_admin,corporate_admin,franchise_admin,franchise_staff',
        ];
    }
}
