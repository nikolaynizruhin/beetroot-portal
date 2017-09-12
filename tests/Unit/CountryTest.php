<?php

namespace Tests\Unit;

use App\Http\Utilities\Country;
use Tests\TestCase;
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

        $this->assertEquals($countries['Argentina'], 'ar');
        $this->assertEquals($countries['Armenia'], 'am');
    }
}
