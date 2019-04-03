<?php

namespace SuperV\Modules\Location\Jobs;

use SuperV\Modules\Location\Domains\Country\Country;
use SuperV\Modules\Location\LocationModule;
use SuperV\Platform\Domains\Addon\AddonCollection;

class ImportCountries
{
    public function handle(AddonCollection $addons)
    {
        $module = $addons->withClass(LocationModule::class);

        $countries = json_decode(file_get_contents(base_path($module->resourcePath('data/countries.json'))), true);

        foreach ($countries as $country) {
            Country::query()->create([
                'code'         => $country['code'],
                'name'         => $country['name'],
                'iso_code'     => $country['iso_code'],
                'has_state'    => $country['state'],
                'has_zip'      => $country['zip'],
                'dialing_code' => $country['dialing_code'],
            ]);
        }
    }
}