<?php

namespace SuperV\Modules\Location\Resources;

use SuperV\Modules\Nucleo\Domains\Resource\Action\CreateResourceAction;
use SuperV\Modules\Nucleo\Domains\Resource\Table\Filter\SearchFilter;
use SuperV\Modules\Nucleo\Domains\Resource\Table\EditButton;
use SuperV\Modules\Nucleo\Domains\Resource\Resource;

class CountryResource extends Resource
{
    public static $model = 'SuperV\Modules\Location\Domains\Country\Country';

    public static $id = 'location_countries';

    public static $navigation = [
        'parent'   => 'acp.nucleo.resources',
        'title' => 'Country',
        'priority' => 10,
    ];

    public static $search = ['name'];

    public static $titleColumn = 'name';

    public static $title = 'Country';

    public function index()
    {
        return [
            'title' => 'Country INDEX',
            'actions' => [new CreateResourceAction],
            'filters' => [new SearchFilter],
            'columns' => ['name'],
            'buttons' => [new EditButton],
            'options' => [
                'order_by' => ['name' => 'ASC']
            ]
        ];
    }

    public function editor()
    {
        return [
            'title' => 'Country EDITOR',
            'fields' => ['*'],
        ];
    }
}