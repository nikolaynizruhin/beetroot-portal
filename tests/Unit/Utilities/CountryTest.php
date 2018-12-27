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

        $this->assertCount(237, $countries);
        $this->assertEquals($countries[0], 'Afghanistan');
    }
}
