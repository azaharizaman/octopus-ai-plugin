<?php namespace AzahariZaman\OctopusAI\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateRecordsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('azaharizaman_octopusai_records', function(Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('record_type')->nullable();
            $table->json('prompt')->nullable();
            $table->text('generated')->nullable();
            $table->boolean('do_not_purge')->default(false);
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('azaharizaman_octopusai_records');
    }
};
