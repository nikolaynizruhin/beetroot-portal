<?php

namespace App\Utilities;

use Intervention\Image\Facades\Image as Intervention;

class Image
{
    /**
     * Fit image.
     *
     * @param  string  $path
     * @return string
     */
    public static function fit($path)
    {
        Intervention::make('storage/' . $path)->fit(150)->save();

        return $path;
    }
}