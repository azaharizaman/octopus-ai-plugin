<?php namespace AzahariZaman\OctopusAI\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Backend\Classes\SettingsController;

/**
 * Settings Backend Controller
 *
 * @link https://docs.octobercms.com/3.x/extend/system/controllers.html
 */
class Settings extends SettingsController
{
    public $settingsItemCode = "settings";
    public $implement = [
        \Backend\Behaviors\FormController::class,
    ];

    /**
     * @var string formConfig file
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var array required permissions
     */
    public $requiredPermissions = ['azaharizaman.octopusai.settings'];

    /**
     * __construct the controller
     */
    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('AzahariZaman.OctopusAI', 'octopusai', 'settings');
    }
}
