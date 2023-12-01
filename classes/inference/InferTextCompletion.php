<?php namespace AzahariZaman\OctopusAI\Classes\Inference;
    
use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;

class InferTextCompletion extends InferText
{
    public $mode;
    public function __construct()
    {
        $this->mode = 'text-completion';
    }
}