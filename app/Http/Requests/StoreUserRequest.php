<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize()
{
    // Only super_admin or corporate_admin can assign users to franchises
    return in_array(auth()->user()->role, ['super_admin','corporate_admin']);
}

public function rules()
{
    return [
        'name'          => 'required|string|max:255',
        'email'         => 'required|email|unique:users,email',
        'password'      => 'required|string|min:8|confirmed',
        'franchisee_id' => 'required|exists:franchisees,id',
        'role'          => 'required|in:super_admin,corporate_admin,franchise_admin,staff',
    ];
}

}
