<?php namespace AzahariZaman\OctopusAI\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateAIModelsTable Migration
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
        Schema::create('azaharizaman_octopusai_aimodels', function(Blueprint $table) {
            $table->id();

            $table->string('model_name');
            $table->string('model_api')->default('OpenAI');
            $table->json('model_tasks')->nullable();
            $table->string('model_description')->nullable();
            $table->text('model_card')->nullable();
            $table->text('model_response_handler')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('azaharizaman_octopusai_aimodels');
    }
};
