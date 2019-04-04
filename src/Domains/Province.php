<?php

namespace SuperV\Modules\Location\Domains;

use SuperV\Platform\Domains\Resource\Model\ResourceEntry;

class Province extends ResourceEntry
{
    protected $table = 'location_provinces';

    public static function withCode($code)
    {
        return static::query()->where('code', $code)->first();
    }
}