<?php namespace AzahariZaman\OctopusAI\Models;

use Model;

/**
 * AIModel Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class AIModel extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'azaharizaman_octopusai_aimodels';
    public $jsonable = [
        'model_tasks',
    ];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $belongsToMany = [
        'tasks' => [
            \AzahariZaman\OctopusAI\Models\Task::class,
            'table' => 'azaharizaman_octopusai_models_tasks',
            'key' => 'model_id',
            'pivot' => ['specific_prompt', 'response_handler']
        ],
    ];
}
