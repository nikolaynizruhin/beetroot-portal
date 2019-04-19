<?php

namespace App\Http\Requests;

use App\Client;
use App\Http\Utilities\Country;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
{
    use HasTag;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Client::class);
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
            'logo' => 'image',
            'country' => [
                'required',
                'string',
                'max:255',
                Rule::in(Country::all()),
            ],
            'description' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'site' => 'required|url',
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

        $attributes['logo'] = $this->logo();

        return $this->withoutTags($attributes);
    }

    /**
     * Get logo path.
     *
     * @return string
     */
    protected function logo()
    {
        return $this->hasFile('logo')
            ? $this->file('logo')->store('logos')
            : Client::DEFAULT_LOGO;
    }
}
