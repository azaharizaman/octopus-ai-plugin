<?php namespace AzahariZaman\OctopusAI\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateModelsTasksTable Migration
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
        Schema::create('azaharizaman_octopusai_models_tasks', function(Blueprint $table) {
            $table->id();
            $table->integer('model_id');
            $table->integer('task_id');
            $table->text('specific_prompt')->nullable();
            $table->text('response_handler')->nullable();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('azaharizaman_octopusai_models_tasks');
    }
};
