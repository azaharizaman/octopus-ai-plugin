<?php namespace AzahariZaman\OctopusAI\Classes\Inference;

use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;
      use AzahariZaman\OctopusAI\Classes\InferenceInterface;

abstract class InferText implements InferenceInterface
{
    public $mode;
    public $prompt;
    public function __construct($mode)
    {
        $this->mode = $mode;
    }

    public function makePrompt(string|array $input): string
    {
        $promptBuilder = new PromptBuilder();
        
         
        $this->prompt = $promptBuilder->toPrompt($input, $this->mode);

        return $this->prompt;
    }

    public function getResponse(string|array $input, array $options = [])
    {
        $this->makePrompt($input);
        
        return "you have reach mode " . $this->mode . '####' . $this->prompt;
    }
}