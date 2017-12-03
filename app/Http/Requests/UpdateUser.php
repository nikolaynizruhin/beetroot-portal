<?php

namespace App\Http\Requests;

use App\Http\Utilities\Position;
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
        $user = $this->route('user');

        return $user && $this->user()->can('update', $user);
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
            'email' => 'required|email|max:255',
            'position' => 'required|string|max:255|in:' . Position::csv(),
            'birthday' => 'required|date',
            'slack' => 'required|string|max:255',
            'client_id' => 'required|numeric|exists:clients,id',
            'office_id' => 'required|numeric|exists:offices,id',
            'is_admin' => 'boolean',
            'avatar' => 'image',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255'
        ];
    }
}
