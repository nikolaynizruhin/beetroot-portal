<?php

namespace Tests\Unit\Utilities;

use Tests\TestCase;
use App\Http\Utilities\Markdown;

class MarkdownTest extends TestCase
{
    /** @test */
    public function it_parse_markdown()
    {
        $html = Markdown::parse('Hello _Markdown_!');

        $this->assertEquals($html, 'Hello <em>Markdown</em>!');
    }
}
