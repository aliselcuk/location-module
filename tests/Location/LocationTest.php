<?php

namespace Tests\Location;

use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    function test__module_is_installed()
    {
        $this->assertNotNull(superv('addons')->get('superv.modules.location'));
    }
}