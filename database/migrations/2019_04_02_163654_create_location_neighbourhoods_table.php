<?php

use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;
use SuperV\Platform\Domains\Database\Migrations\Migration;

class CreateLocationNeighbourhoodsTable extends Migration
{
    public function up()
    {
        $this->create('location_neighbourhoods',
            function (Blueprint $table, ResourceConfig $resource) {
                $resource->label('Neighbourhoods');
                $resource->setName('neighbourhoods');
                $resource->resourceKey('neighbourhoods');

                $table->increments('id');
                $table->belongsTo('location.districts', 'district');
                $table->string('name')->entryLabel();
                $table->string('code');

                $table->createdBy()->updatedBy();
                $table->restorable();

                $table->hasMany('location.streets', 'streets');
            });
    }

    public function down()
    {
        $this->dropIfExists('location_neighbourhoods');
    }
}
