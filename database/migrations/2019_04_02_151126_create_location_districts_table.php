<?php

use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;
use SuperV\Platform\Domains\Database\Migrations\Migration;

class CreateLocationDistrictsTable extends Migration
{
    public function up()
    {
        $this->create('location_districts',
            function (Blueprint $table, ResourceConfig $resource) {
                $resource->label('Districts');
                $resource->setName('districts');
                $resource->nav('acp.location');
                $resource->resourceKey('district');

                $table->increments('id');
                $table->belongsTo('location.provinces', 'province');
                $table->string('name')->entryLabel();
                $table->string('code');

                $table->createdBy()->updatedBy();
                $table->restorable();

                $table->hasMany('location.neighbourhoods', 'neighbourhoods');
            });
    }

    public function down()
    {
        $this->dropIfExists('location_districts');
    }
}
