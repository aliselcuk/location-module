<?php namespace SuperV\Modules\Location;

use Illuminate\Foundation\Bus\DispatchesJobs;
use SuperV\Modules\Location\Domains\Country\Jobs\ImportCountriesJob;
use SuperV\Platform\Domains\Addon\Addon;

class LocationModule extends Addon
{
    use DispatchesJobs;

    public function onInstalled()
    {
//        $this->dispatch(new ImportCountriesJob());
    }
}