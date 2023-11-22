<?php namespace AzahariZaman\OctopusAI\Components;

use Cms\Classes\ComponentBase;

/**
 * AdvancePrompt Component
 *
 * @link https://docs.octobercms.com/3.x/extend/cms-components.html
 */
class AdvancePrompt extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'AdvancePrompt Component',
            'description' => 'Generate an AI Text from the given prompt',
            'snippetAjax' => true,
        ];
    }

    /**
     * @link https://docs.octobercms.com/3.x/element/inspector-types.html
     */
    public function defineProperties()
    {
        return [
            'new_prompt' => [
                'title' => 'Make a new prompt',
                'type' => 'checkbox',
                'default' => true,
            ],
            'title' => [
                'title' => 'AdvancePrompt Title',
                'description' => 'Title this prompt',
                'type' => 'autocomplete',
                'options' => ['start' => 'Start', 'end' => 'End'],
                'depends' => ['new_prompt'],
                'validation' => [
                    'length' => [
                        'min' => [
                            'value' => 10,
                            'message' => 'That is too short for making a title',
                        ],
                        'max' => [
                            'value' => 200,
                            'message' => 'The max charector allowed is 200'
                        ]
                    ]
                ]
            ],
            'prompt' => [
                'title' => 'Prompt',
                'description' => 'Enter the prompt',
                'type' => 'text',
                'validation' => [
                    'length' => [
                        'min' => [
                            'value' => 10,
                            'message' => 'That is too short for making a prompt',
                        ],
                        'max' => [
                            'value' => 2000,
                            'message' => 'The max charector allowed is 2000'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function onRun()
    {
        $content = $this->renderPartial('@default.htm');
        return Response::make($content)->header('Content-Type', 'text/xml');
    }
}
