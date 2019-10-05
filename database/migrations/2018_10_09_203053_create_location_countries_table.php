<?php

use SuperV\Platform\Domains\Database\Migrations\Migration;
use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Resource\ResourceConfig;

class CreateLocationCountriesTable extends Migration
{
    public function up()
    {
        $this->create('location_countries',
            function (Blueprint $table, ResourceConfig $resource) {
                $resource->label('Countries');
                $resource->setName('countries');
                $resource->nav('acp.location');
                $resource->resourceKey('country');

                $table->increments('id');
                $table->string('code')->searchable()->unique();
                $table->string('name')->searchable()->unique();
                $table->string('iso_code')->searchable()->nullable();
                $table->boolean('has_state');
                $table->boolean('has_zip');
                $table->string('dialing_code');

                $table->createdBy()->updatedBy();
                $table->restorable();

                $table->hasMany('location.provinces', 'provinces');
            });
    }

    public function down()
    {
        $this->dropIfExists('location_countries');
    }
}
