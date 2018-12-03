<?php

namespace App;

trait Taggable
{
    /**
     * Get all of the tags related to model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')->withTimestamps();
    }

    /**
     * Sync tags with model.
     *
     * @param  array $tags
     * @return array
     */
    public function syncTags($tags)
    {
        return $this->tags()->sync($tags);
    }
}
