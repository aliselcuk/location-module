<?php

namespace Tests\Location;

use Illuminate\Foundation\Testing\RefreshDatabase;
use SuperV\Platform\Testing\PlatformTestCase;

class TestCase extends PlatformTestCase
{
    use RefreshDatabase;

    protected $installs = ['superv.modules.location'];
}