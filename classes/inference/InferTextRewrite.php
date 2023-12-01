<?php namespace AzahariZaman\OctopusAI\Classes\Inference;
    
use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;

class InferTextRewrite extends InferText
{
    public $mode;
    public function __construct(string $mode = null)
    {
        if ($mode) {
            $this->mode = $mode;
        } else {
            $this->mode = 'text-rewrite';
        }
    }
}