<?php namespace AzahariZaman\OctopusAI\Models;

use Model;

/**
 * Record Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Record extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'azaharizaman_octopusai_records';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
