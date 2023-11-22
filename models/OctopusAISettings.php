<?php namespace AzahariZaman\OctopusAI\Models;

use System\Models\SettingModel;

/**
 * Setting Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class OctopusAISettings extends SettingModel
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [];

    public $settingsCode = 'azaharizaman_octopusai_settings';
    public $settingsFields = 'fields.yaml';
    
}
