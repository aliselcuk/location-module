<?php namespace SuperV\Modules\Location;

use Illuminate\Foundation\Bus\DispatchesJobs;
use SuperV\Modules\Location\Jobs\ImportCountryData;
use SuperV\Platform\Domains\Addon\Addon;

class LocationModule extends Addon
{
    use DispatchesJobs;

    public function onInstalled()
    {
        $this->dispatch(new ImportCountryData([
            'code'         => 'TR',
            'name'         => 'Turkey',
            'iso_code'     => 'TUR',
            'has_state'    => false,
            'has_zip'      => true,
            'dialing_code' => 90,
        ]));
    }
}