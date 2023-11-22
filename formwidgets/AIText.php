<?php namespace AzahariZaman\OctopusAI\FormWidgets;

use AzahariZaman\OctopusAI\Models\OctopusAISettings;
use Backend\Classes\FormWidgetBase;
use OpenAI;
use AzahariZaman\OctopusAI\Classes\Client as OctopusAIClient;

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

    public function onRewrite()
    {
        $value = post($this->getFieldName());

        $client = new OctopusAIClient;

        $response = $client->rewrite($value);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onComplete()
    {
        $value = post($this->getFieldName());

        $client = new OctopusAIClient;

        $response = $client->complete($value);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onSummarize()
    {
        $value = post($this->getFieldName());

        $client = new OctopusAIClient;

        $response = $client->summarize($value);

        $this->prepareVars();
        $this->vars['value'] = $response;
        
        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onElaborate()
    {
        $value = post($this->getFieldName());

        $client = new OctopusAIClient;

        $response = $client->elaborate($value);

        $this->prepareVars();
        $this->vars['value'] = $response;
        
        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onPrompt()
    {
        $value = post($this->getFieldName());

        $client = new OctopusAIClient;
        $response = $client->prompt($value);
        $this->prepareVars();
        $this->vars['value'] = $response;
        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }
}
