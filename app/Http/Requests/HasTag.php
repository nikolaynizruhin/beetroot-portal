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
}
