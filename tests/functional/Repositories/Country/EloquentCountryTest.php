<?php

use Mockery as m;
use SPCVN\Country;
use SPCVN\Repositories\Country\EloquentCountry;

class EloquentCountryTest extends FunctionalTestCase
{
    /**
     * @var EloquentCountry
     */
    protected $repo;

    protected $seed = false;

    public function setUp()
    {
        parent::setUp();
        $this->repo = app(EloquentCountry::class);
    }

    public function test_lists()
    {
        $countries = factory(Country::class)->times(8)->create();
        $countries = $countries->sortBy(function ($country) {
            return $country->name;
        })->pluck('name', 'id');

        $this->assertEquals($countries->toArray(), $this->repo->lists()->toArray());
    }
}
