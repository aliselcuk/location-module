<?php

namespace SuperV\Modules\Location\Domains;

use SuperV\Platform\Domains\Resource\Database\Entry\ResourceEntry;

class District extends ResourceEntry
{
    protected $table = 'location_districts';

    public static function withCode($code)
    {
        return static::query()->where('code', $code)->first();
    }
}
