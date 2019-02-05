<?php

namespace Tests\Location;

use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function module_is_installed()
    {
        $this->assertNotNull(superv('addons')->get('superv.modules.location'));
    }
}