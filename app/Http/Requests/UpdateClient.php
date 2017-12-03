<?php

namespace App\Http\Requests;

use App\Http\Utilities\Country;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClient extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $client = $this->route('client');

        return $client && $this->user()->can('update', $client);
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
            'country' => 'required|string|max:255|in:' . Country::csv(),
            'description' => 'required|string|max:255',
            'site' => 'required|url',
            'logo' => 'image'
        ];
    }
}
