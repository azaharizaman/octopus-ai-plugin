<?php namespace AzahariZaman\OctopusAI\FormWidgets;

use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;
use Backend\Classes\FormWidgetBase;
use AzahariZaman\OctopusAI\Classes\OpenAIClient as Client;

/**
 * AIText Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class AIText extends FormWidgetBase
{
    protected $defaultAlias = 'octopusai_ai_text';

    public function init()
    {
    }

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('aitext');
    }

    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['placeholder'] = $this->formField->getPlaceholder();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['eventHandlerRewrite'] = $this->getEventHandler('onRewrite');
        $this->vars['eventHandlerComplete'] = $this->getEventHandler('onComplete');
        $this->vars['eventHandlerSummarize'] = $this->getEventHandler('onSummarize');
        $this->vars['eventHandlerElaborate'] = $this->getEventHandler('onElaborate');
        $this->vars['eventHandlerPrompt'] = $this->getEventHandler('onPrompt');
    }
    public function loadAssets()
    {
        // $this->addCss('css/aitext.css');
        // $this->addJs('js/aitext.js');
    }

    public function getSaveValue($value)
    {
        return $value;
    }

    public function onExecute()
    {
        $value = post($this->getFieldName());
        $task = post('task');

        $client = new Client;

        $response = $client->execute($task, $value);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

}
