<?php

namespace App\Http\Requests;

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
        return array_except($attributes, 'tags');
    }
}
