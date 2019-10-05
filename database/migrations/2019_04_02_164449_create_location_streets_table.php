<?php

use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;
use SuperV\Platform\Domains\Database\Migrations\Migration;

class CreateLocationStreetsTable extends Migration
{
    public function up()
    {
        $this->create('location_streets',
            function (Blueprint $table, ResourceConfig $resource) {
                $resource->label('Streets');
                $resource->setName('streets');
                $resource->resourceKey('street');

                $table->increments('id');
                $table->belongsTo('location.neighbourhoods', 'neighbourhood');
                $table->string('name')->entryLabel();

                $table->createdBy()->updatedBy();
                $table->restorable();
            });
    }

    public function down()
    {
        $this->dropIfExists('location_streets');
    }
}
