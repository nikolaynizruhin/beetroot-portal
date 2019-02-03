<?php

namespace App\Http\Requests;

use Illuminate\Support\Arr;

trait HasTag
{
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
     * Get list of attributes without tags.
     *
     * @return array
     */
    public function withoutTags($attributes)
    {
        return Arr::except($attributes, 'tags');
    }
}
