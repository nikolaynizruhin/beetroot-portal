<?php

namespace App\Http\Requests;

use App\Http\Utilities\Country;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\Foundation\Http\FormRequest;

class UpdateClient extends FormRequest
{
    use HasTag;

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
            'country' => [
                'required',
                'string',
                'max:255',
                Rule::in(Country::all()),
            ],
            'description' => 'required|string|max:255',
            'tags' => 'nullable|array',
            'site' => 'required|url',
            'logo' => 'image',
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

        if ($this->hasFile('logo')) {
            $attributes['logo'] = $this->logo();
        }

        return $attributes;
    }

    /**
     * Get logo path.
     *
     * @return string
     */
    protected function logo()
    {
        $path = $this->file('logo')->store('logos');

        Image::make('storage/'.$path)->fit(150)->save();

        return $path;
    }
}
