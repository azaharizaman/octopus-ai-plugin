<?php namespace AzahariZaman\OctopusAI\Models;

use Model;

/**
 * Task Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'azaharizaman_octopusai_tasks';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
