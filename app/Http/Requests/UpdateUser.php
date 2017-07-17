<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'position' => 'required|string|max:255',
            'birthday' => 'required|date',
            'avatar' => 'required|url',
            'client_id' => 'required|numeric|exists:clients,id',
            'office_id' => 'required|numeric|exists:offices,id',
            'password' => 'required|string|min:6|confirmed'
        ];
    }
}
