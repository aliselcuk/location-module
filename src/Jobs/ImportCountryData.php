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

    private function getTestProvinces()
    {
        return [
            ['country_id' => 1, 'name' => 'İSTANBUL', 'code' => '34'],
            ['country_id' => 1, 'name' => 'ANKARA', 'code' => '6'],
            ['country_id' => 1, 'name' => 'İZMİR', 'code' => '35'],
            ['country_id' => 1, 'name' => 'BURSA', 'code' => '16'],
            ['country_id' => 1, 'name' => 'ADANA', 'code' => '1'],
        ];
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
        $isTesting = true; // Current::envIsTesting();
        if ($isTesting) {
            $provinces = $this->getTestProvinces();
        } else {
            $provinces = $this->getJsonData('data/tr/provinces.json');
        }

        $districts = $this->getJsonData('data/tr/districts.json');

        foreach ($provinces as $provinceData) {
            $provinceData['name'] = $this->ucwords($provinceData['name']);

            $province = sv_resource('location.provinces')->create($provinceData);

            $districtCount = 0;
            foreach ($districts[$province->code] as $districtData) {
                $province->districts()->create($districtData);

                if ($isTesting && $districtCount++ > 7) {
                    break;
                }
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

    protected function ucwords($title): string
    {
//        return $title;
//        return ucwords(mb_strtolower($title));
//        $title = html_entity_decode(preg_replace("/U\+([0-9A-F]{4})/", "&#x\\1;", str_replace("\u", "U+", $title)), ENT_NOQUOTES, 'UTF-8');

        $title = mb_convert_case($title, MB_CASE_TITLE, 'UTF-8');
        $title = str_replace(["i̇"], ["i"], $title);

        return $title;
    }
}
