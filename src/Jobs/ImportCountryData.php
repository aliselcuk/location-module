<?php

namespace SuperV\Modules\Location\Jobs;

use SuperV\Modules\Location\Domains\Country\Country;
use SuperV\Modules\Location\LocationModule;
use SuperV\Platform\Domains\Addon\AddonCollection;
use SuperV\Platform\Support\Dispatchable;

class ImportCountryData
{
    use Dispatchable;

    /**
     * @var array
     */
    protected $data;

    /** @var LocationModule */
    protected $module;

    /** @var \SuperV\Modules\Location\Domains\Country\Country */
    protected $country;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(AddonCollection $addons)
    {
        $this->module = $addons->withClass(LocationModule::class);

        $this->createCountry();
        $this->importProvinces();
    }

    protected function getJsonData(string $path)
    {
        $fullPath = base_path($this->module->resourcePath($path));

        return json_decode(file_get_contents($fullPath), true);
    }

    protected function parse()
    {
        $rows = $this->getJsonData('data/tr/sokak.json');

        $parsed = [];
        foreach ($rows as $row) {
            $parsed[$row['m']][] = [
                'name' => $row['t'],
            ];
        }

        ksort($parsed);

        file_put_contents($this->module->resourcePath('data/tr/streets.json'), json_encode($parsed));
    }

    protected function importProvinces()
    {
        $provinces = $this->getJsonData('data/tr/provinces.json');
        $districts = $this->getJsonData('data/tr/districts.json');
//        $neighbourhoods = $this->getJsonData('data/tr/neighbourhoods.json');

        foreach ($provinces as $provinceData) {
            if (!in_array($provinceData['code'], [1,6,34,35])) continue;

            $province = sv_resource('location_provinces')->create($provinceData);

            foreach ($districts[$province->code] as $districtData) {
                $district = $province->districts()->create($districtData);
            }
        }
    }

    protected function createCountry()
    {
        $this->country = Country::query()->create([
            'code'         => $this->data['code'],
            'name'         => $this->data['name'],
            'iso_code'     => $this->data['iso_code'],
            'has_state'    => $this->data['state'] ?? false,
            'has_zip'      => $this->data['zip'] ?? false,
            'dialing_code' => $this->data['dialing_code'],
        ]);
    }
}