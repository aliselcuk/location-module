<?php

use SuperV\Platform\Domains\Database\Migrations\Migration;
use SuperV\Platform\Domains\Database\Schema\Blueprint;
use SuperV\Platform\Domains\Database\Schema\Schema;

class CreateLocationCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('location_countries', function (Blueprint $table) {
            $table->resourceBlueprint()
                  ->resourceKey('country')
                  ->label('Countries');

            $table->increments('id');
            $table->string('code')->searchable()->unique();
            $table->string('name')->searchable()->unique();
            $table->string('iso_code')->searchable()->nullable();
            $table->boolean('has_state');
            $table->boolean('has_zip');
            $table->string('dialing_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('location_countries');
    }
}
