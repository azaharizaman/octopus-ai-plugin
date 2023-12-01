<?php namespace AzahariZaman\OctopusAI\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * A I Models Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class AIModels extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\RelationController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';
    /**
     * @var string listConfig file
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['azaharizaman.octopusai.aimodels'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AzahariZaman.OctopusAI', 'octopusai', 'aimodels');
    }
}
