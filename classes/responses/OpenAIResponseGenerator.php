<?php namespace AzahariZaman\OctopusAI\Classes\Responses;

use AzahariZaman\OctopusAI\Classes\Responses\ResponseGeneratorInterface;
use OpenAI;
use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;

abstract class OpenAIResponseGenerator implements ResponseGeneratorInterface
{
    protected $client;
    /**
     * PromptBuilder prompt
     *
     * @var PromptBuilder
     */
    protected $prompt;
    protected $temperature;
    protected $mode;
    protected $model;
    protected $maxToken;

    abstract public function makePrompt($value, $mode);
    abstract public function formatResponse($response);
    abstract protected function setTemperature();
    abstract protected function setMode();
    abstract protected function setModel();
    abstract protected function setMaxToken();
    abstract protected function getTemperature();
    abstract protected function getMode();
    abstract protected function getModel();
    abstract protected function getMaxToken();

    public function __construct($client, PromptBuilder $prompt)
    {
        if (!$this->client) {
            $this->client = $client;
        }

        if (!$this->prompt) {
            $this->prompt = $prompt;
        }

        $this->temperature = $this->getTemperature();
        $this->mode = $this->getMode();
        $this->model = $this->getModel();
        $this->maxToken = $this->getMaxToken();
    }

    public function generateResponse($value)
    {
        $response = $this->client->completions()->create([
            'model' => $this->model,
            'prompt' => $this->prompt->toPrompt($value, $this->mode),
            'max_tokens' => $this->maxToken,
            'temperature' => $this->temperature,
        ]);

        return $response;
    }
    
    public function execute($client, $value): string
    {
        

        $response = $this->generateResponse($value);

        return $this->formatResponse($response);
    }
}