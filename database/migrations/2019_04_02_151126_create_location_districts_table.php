<?php

use SuperV\Platform\Domains\Database\Migrations\Migration;
use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;

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
                $table->string('name')->entryLabel()->label('District');
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
