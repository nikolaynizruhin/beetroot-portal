<?php

namespace Tests\Unit;

use Tests\TestCase;

class DirectivesTest extends TestCase
{
    /** @test */
    public function it_compile_host_directive()
    {
        $blade = '@host(https://www.example.com/en/)';
        $expected = "<?php echo str_replace('www.', '', parse_url(https://www.example.com/en/, PHP_URL_HOST)); ?>";
        $compiled = app('blade.compiler')->compileString($blade);

        $this->assertEquals($expected, $compiled);
    }
}
