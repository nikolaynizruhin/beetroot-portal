<?php

namespace App\Http\Requests;

use App\User;
use App\Utilities\Image;
use Illuminate\Validation\Rule;
use App\Http\Utilities\Position;
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
            'position' => [
                'required',
                'string',
                'max:255',
                Rule::in(Position::all()),
            ],
            'gender' => [
                'required',
                Rule::in([User::MALE, User::FEMALE]),
            ],
            'birthday' => 'required|date',
            'created_at' => 'required|date',
            'avatar' => 'image',
            'is_admin' => 'boolean',
            'client_id' => 'required|numeric|exists:clients,id',
            'office_id' => 'required|numeric|exists:offices,id',
            'password' => 'required|string|min:6|confirmed',
            'slack' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the prepared data from the request.
     *
     * @return array
     */
    public function prepared()
    {
        $attributes = $this->validated();

        $attributes['avatar'] = $this->avatar();
        $attributes['is_admin'] = (bool) $this->is_admin;
        $attributes['password'] = bcrypt($this->password);

        return $attributes;
    }

    /**
     * Get avatar path.
     *
     * @return string
     */
    protected function avatar()
    {
        return $this->hasFile('avatar')
            ? Image::fit($this->file('avatar')->store('avatars'))
            : User::DEFAULT_AVATAR;
    }
}
