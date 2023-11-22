<?php namespace AzahariZaman\OctopusAI\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Backend\FormWidgets\RichEditor;

/**
 * AIRicheditor Form Widget
 *
 * @link https://docs.octobercms.com/3.x/extend/forms/form-widgets.html
 */
class AIRicheditor extends RichEditor
{
    protected $defaultAlias = 'octopusai_ai_richeditor';

    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('airicheditor');
    }

    // public function prepareVars()
    // {
    //     $this->vars['name'] = $this->formField->getName();
    //     $this->vars['value'] = $this->getLoadValue();
    //     $this->vars['model'] = $this->model;
    // }

    public function loadAssets()
    {
        // $this->addCss('css/airicheditor.css');
        $this->addJs('js/airicheditor.js');
    }

    public function getSaveValue($value)
    {
        return $value;
    }
}
