<?php namespace AzahariZaman\OctopusAI\FormWidgets;

use Backend\Classes\FormWidgetBase;
use AzahariZaman\OctopusAI\Classes\Inference\InferTextPrompt;
use AzahariZaman\OctopusAI\Classes\Inference\InferTextRewrite;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;
use AzahariZaman\OctopusAI\Classes\Inference\InferTextCompletion;
use AzahariZaman\OctopusAI\Classes\Inference\InferTextSummarization;

/**
 * AIText Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class AIText extends FormWidgetBase
{
    protected $allowedTasks = [
        'text-completion',
        'text-summarization',
        'text-rewrite',
        'chat',
    ];

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
        $this->vars['eventHandlerOnInferTextCompletion'] = $this->getEventHandler('onInferTextCompletion');
        $this->vars['eventHandlerOnInferTextSummarization'] = $this->getEventHandler('onInferTextSummarization');
        $this->vars['eventHandlerOnInferTextRewrite'] = $this->getEventHandler('onInferTextRewrite');
        $this->vars['eventHandlerOnInferTextPrompt'] = $this->getEventHandler('onInferTextPrompt');
    }
    public function loadAssets()
    {
    }

    public function getSaveValue($value)
    {
        return $value;
    }

    public function onInferTextCompletion()
    {
        $input = post($this->getFieldName());

        $inference = new InferTextCompletion();
        $response = $inference->getResponse($input);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onInferTextSummarization()
    {
        $input = post($this->getFieldName());

        $inference = new InferTextSummarization();
        $response = $inference->getResponse($input);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onInferTextRewrite()
    {
        $input = post($this->getFieldName());
        $rewriteMode = post('mode')? 'text-rewrite-expand' : 'text-rewrite';

        $inference = new InferTextRewrite($rewriteMode);
        $response = $inference->getResponse($input);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }

    public function onInferTextPrompt()
    {
        $input = post($this->getFieldName());

        $inference = new InferTextPrompt();
        $response = $inference->getResponse($input);

        $this->prepareVars();
        $this->vars['value'] = $response;

        return ['#'.$this->getId() => $this->makePartial('aitext')];
    }
}
