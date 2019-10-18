<?php namespace SuperV\Modules\Location;

use Current;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use SuperV\Platform\Domains\Addon\Addon;

class LocationModule extends Addon
{
    use DispatchesJobs;

    public function onInstalled()
    {
        if (Current::envIsTesting()) {
            DB::unprepared(file_get_contents($this->realPath('resources/locations_testing.sql')));
        }
//        DB::unprepared(file_get_contents($this->realPath('resources/data/location.sql')));

//        $this->dispatch(new ImportCountryData([
//            'code'         => 'TR',
//            'name'         => 'Turkey',
//            'iso_code'     => 'TUR',
//            'has_state'    => false,
//            'has_zip'      => true,
//            'dialing_code' => 90,
//        ]));
    }
}
