<?php

namespace App\Http\Requests;

class UpdateOffice extends StoreOffice
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
}
