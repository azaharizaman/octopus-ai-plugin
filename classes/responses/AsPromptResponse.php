<?php namespace AzahariZaman\OctopusAI\Classes\Responses;

use OpenAI;
use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;
use AzahariZaman\OctopusAI\Classes\Responses\ResponseGenerator;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;

class AsPromptResponse extends OpenAIResponseGenerator
{
    protected $client;
    protected $temperature;
    protected $mode;
    protected $model;
    protected $maxToken;

    protected function setTemperature()
    {
        $this->temperature = Settings::get('openai_temperature', 0.7);
    }
    protected function setMode()
    {
        $this->mode = 'summary';
    }
    protected function setModel()
    {
        $this->model = Settings::get('openai_model', 'gpt-3.5-turbo');
    }
    protected function setMaxToken()
    {
        $this->maxToken = Settings::get('openai_max_token', 1000);
    }
    protected function getTemperature()
    {
        return $this->temperature;
    }
    protected function getMode()
    {
        return $this->mode;
    }
    protected function getModel()
    {
        return $this->model;
    }
    protected function getMaxToken()
    {
        return $this->maxToken;
    }
    public function makePrompt($value, $mode): string
    {
        $promptBuilder = new PromptBuilder();
        return $promptBuilder->toPrompt($value, $mode);
    }

    public function formatResponse($response) 
    {
        $result = "";
        foreach ($response->choices as $choice) {
            $result .= $choice->text;
        }

        return $result;
    }
}
