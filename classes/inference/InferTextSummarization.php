<?php namespace AzahariZaman\OctopusAI\Classes\Inference;

use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;

class InferTextSummarization extends InferText
{
    public $mode;

    public function __construct()
    {
        $this->mode = 'text-summarization';
    }
    
}