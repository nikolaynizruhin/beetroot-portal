<?php

namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    /**
     * Check whether a model has no a default image.
     *
     * @return bool
     */
    public function hasNoDefaultImage()
    {
        return $this->image() !== $this->defaultImage();
    }

    /**
     * Optimize model image.
     *
     * @return void
     */
    public function optimizeImage()
    {
        if ($this->needToOptimizeImage()) {
            Image::make('storage/'.$this->image())
                ->fit($this->imageSize())
                ->save();
        }
    }

    /**
     * Check whether need to optimize an image.
     *
     * @return bool
     */
    public function needToOptimizeImage()
    {
        return $this->hasNoDefaultImage() && $this->isDirty(static::$image);
    }

    /**
     * Delete model image.
     *
     * @return void
     */
    public function deleteImage()
    {
        if ($this->hasNoDefaultImage()) {
            Storage::delete($this->image());
        }
    }

    /**
     * Get image size.
     *
     * @return string
     */
    protected function imageSize()
    {
        $imageSize = strtoupper(static::$image).'_SIZE';

        return constant(static::class.'::'.$imageSize);
    }

    /**
     * Get default image.
     *
     * @return string
     */
    protected function defaultImage()
    {
        $defaultImage = 'DEFAULT_'.strtoupper(static::$image);

        return constant(static::class.'::'.$defaultImage);
    }

    /**
     * Get image path.
     *
     * @return string
     */
    protected function image()
    {
        return $this->{static::$image};
    }

    /**
     * The "booting" method of the trait.
     *
     * @return void
     */
    public static function bootHasImage()
    {
        static::saved(function($model) {
            $model->optimizeImage();
        });

        static::deleting(function($model) {
            $model->deleteImage();
        });
    }
}