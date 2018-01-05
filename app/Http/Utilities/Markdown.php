<?php

namespace App\Http\Utilities;

use Parsedown;
use Illuminate\Support\HtmlString;

class Markdown
{
    /**
     * Parse the given Markdown text into HTML.
     *
     * @param  string  $text
     * @return \Illuminate\Support\HtmlString
     */
    public static function parse($text)
    {
        $parsedown = new Parsedown;

        return new HtmlString($parsedown->line($text));
    }
}
