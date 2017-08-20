<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'is_admin' => 'boolean',
            'position' => 'required|string|max:255',
            'birthday' => 'required|date',
            'avatar' => 'required|image',
            'bio' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'slack' => 'required|string|max:255|unique:users',
            'github' => 'nullable|string|max:255',
            'client_id' => 'required|numeric|exists:clients,id',
            'office_id' => 'required|numeric|exists:offices,id',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
}
