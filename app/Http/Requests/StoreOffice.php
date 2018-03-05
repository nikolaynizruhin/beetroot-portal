<?php

namespace App\Http\Requests;

use App\Office;
use App\Http\Utilities\Country;
use Illuminate\Foundation\Http\FormRequest;

class StoreOffice extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Office::class);
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
            'country' => 'required|string|max:255|in:'.Country::csv(),
            'address' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ];
    }

    /**
     * Get the validated data.
     *
     * @return array
     */
    public function validatedData()
    {
        return $this->only(['city', 'country', 'address', 'link']);
    }
}
