<?php

namespace Tests\Unit\Utilities;

use Tests\TestCase;
use App\Http\Utilities\Country;

class CountryTest extends TestCase
{
    /** @test */
    public function it_can_get_all_countries()
    {
        $countries = Country::all();

        $this->assertEquals(count($countries), 237);
        $this->assertEquals($countries[0], 'Afghanistan');
    }
}
