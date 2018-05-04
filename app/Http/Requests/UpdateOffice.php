<?php

namespace App\Http\Requests;

use App\Http\Utilities\Country;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOffice extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $office = $this->route('office');

        return $office && $this->user()->can('update', $office);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => 'required|string|max:255',
            'country' => [
                'required',
                'string',
                'max:255',
                Rule::in(Country::all()),
            ],
            'address' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ];
    }
}
