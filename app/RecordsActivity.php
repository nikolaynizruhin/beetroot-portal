<?php

namespace App;

trait RecordsActivity
{
    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityName($event));
            });
        }

        static::deleting(function ($model) {
            $model->activities()->delete();
        });
    }

    /**
     * Get the name of the activity.
     *
     * @param  string  $name
     * @return string
     */
    protected function activityName($name)
    {
        return "{$name}_".strtolower(class_basename($this));
    }

    /**
     * Fetch the model events that should trigger activity.
     *
     * @return array
     */
    protected static function recordableEvents()
    {
        return ['created'];
    }

    /**
     * Record activity for a subject.
     *
     * @param string $name
     */
    public function recordActivity($name)
    {
        $this->activities()->create(['name' => $name]);
    }

    /**
     * The activity feed for the subject.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}
