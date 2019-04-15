<?php namespace SuperV\Modules\Location;

use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use SuperV\Modules\Location\Jobs\ImportCountryData;
use SuperV\Platform\Domains\Addon\Addon;
use SuperV\Platform\Domains\Resource\ResourceModel;

class LocationModule extends Addon
{
    use DispatchesJobs;

    public function onInstalled()
    {
//        DB::unprepared(file_get_contents($this->realPath('resources/data/location.sql')));

//        dd(ResourceModel::query()->where('handle', 'location_countries')->first());

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