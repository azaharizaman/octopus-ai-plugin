<?php namespace AzahariZaman\OctopusAI\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTasksTable Migration
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
        Schema::create('azaharizaman_octopusai_tasks', function(Blueprint $table) {
            $table->id();
            $table->string('task_code')->unique();
            $table->string('task_name');
            $table->text('task_description')->nullable();
            $table->text('task_prompt');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('azaharizaman_octopusai_tasks');
    }
};
