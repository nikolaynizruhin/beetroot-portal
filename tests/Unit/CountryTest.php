<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Utilities\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    /**
     * Get all countries.
     *
     * @return void
     */
    public function testGetAllCountries()
    {
        $countries = Country::all();

        $this->assertEquals(count($countries), 238);
        $this->assertEquals($countries[0], 'Afghanistan');
    }

    /**
     * Get csv countries.
     *
     * @return void
     */
    public function testGetCsvCountries()
    {
        $countries = Country::csv();

        $this->assertEquals(strpos($countries, 'Afghanistan'), 0);
    }
}
