<?php namespace AzahariZaman\OctopusAI\Classes\Inference;

class InferTextPrompt extends InferText
{
    public $mode;

    public function __construct()
    {
        $this->mode = 'text-prompt';
    }
}