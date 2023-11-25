<?php namespace AzahariZaman\OctopusAI;

use Backend;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'OctopusAI',
            'description' => 'OctoberCMS Plugin to harnest the potential of AI in CMS',
            'author' => 'AzahariZaman',
            'iconSvg' => '$/azaharizaman/octopusai/assets/images/octopus.png',
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
        //
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        \Backend\FormWidgets\RichEditor::extend(function($controller) {
            $controller->addJs('/plugins/azaharizaman/octopusai/widgets/advanceprompt/assets/js/advanceprompt.js');
            // $controller->addJs('/plugins/azaharizaman/octopusai/assets/js/advanceprompt.js');
        });
    }

    /**
     * registerComponents used by the frontend.
     */
    public function registerComponents()
    {
        return [];
    }

    /**
     * registerPermissions used by the backend.
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'azaharizaman.octopusai.some_permission' => [
                'tab' => 'OctopusAI',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * registerNavigation used by the backend.
     */
    public function registerNavigation()
    {
        return [
            'octopusai' => [
                'label' => 'OctopusAI',
                'url' => Backend::url('azaharizaman/octopusai/records'),
                'icon' => 'icon-train',
                'permissions' => ['azaharizaman.octopusai.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'         => 'OctopusAI Settings',
                'description'   => 'Settings for the OctopusAI plugin',
                'category'      => 'OctopusAI',
                'iconSvg'       => 'plugins/azaharizaman/octopusai/assets/images/octopus.png',
                'icon'          => 'icon-magic',
                'class'         => \AzahariZaman\OctopusAI\Models\OctopusAISettings::class,
                'order'         => 500,
                'keywords'      => 'octopusai ai',
            ]
        ];
    }

    public function registerFormWidgets()
    {
        return [
            \AzahariZaman\OctopusAI\FormWidgets\AIText::class => 'aitext',
            \AzahariZaman\OctopusAI\FormWidgets\AITextArea::class => 'aitextarea',
            \AzahariZaman\OctopusAI\FormWidgets\AIRicheditor::class => 'airicheditor',
        ];
    }

    public function registerPageSnippets()
    {
        return [
            \AzahariZaman\OctopusAI\Components\AdvancePrompt::class => 'advancePrompt',
        ];
    }
}
