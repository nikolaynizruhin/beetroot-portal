<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Validation\Rule;
use App\Http\Utilities\Position;
use Intervention\Image\Facades\Image;
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
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id),
                'max:255',
            ],
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
            'slack' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
            'skype' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'tags' => 'nullable|array',
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

        unset($attributes['tags']);

        $attributes['is_admin'] = (bool) $this->is_admin;

        if ($this->hasFile('avatar')) {
            $attributes['avatar'] = $this->avatar();
        }

        return $attributes;
    }

    /**
     * Get tags.
     *
     * @return array
     */
    public function tags()
    {
        return $this->tags ?: [];
    }

    /**
     * Get avatar path.
     *
     * @return string
     */
    protected function avatar()
    {
        $path = $this->file('avatar')->store('avatars');

        Image::make('storage/'.$path)->fit(150)->save();

        return $path;
    }
}
