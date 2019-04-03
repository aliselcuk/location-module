<?php

use SuperV\Platform\Domains\Database\Migrations\Migration;
use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;

class CreateLocationProvincesTable extends Migration
{
    public function up()
    {
        $this->create('location_provinces',
            function (Blueprint $table, ResourceConfig $resource) {
                $resource->label('Provinces');
                $resource->nav('acp.location');
                $resource->resourceKey('province');

                $table->increments('id');
                $table->belongsTo('location_countries', 'country');
                $table->string('name')->entryLabel();
                $table->string('code');

                $table->createdBy()->updatedBy();
                $table->restorable();

                $table->hasMany('location_districts','districts');
            });
    }

    public function down()
    {
        $this->dropIfExists('location_provinces');
    }
}
