<?php namespace AzahariZaman\OctopusAI\Classes;

use Kambo\Huggingface\Enums\Type;
use Kambo\Huggingface\Huggingface;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;

class HuggingfaceClient
{
    public $model;
    protected $client;
    public $parameters = [];
    protected $api_key;

    public function __construct()
    {
        $this->api_key = Settings::get('huggingface_api_key');
        $this->client = Huggingface::client($this->api_key);
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function inferenceTextGeneration($input): array
    {
        $result = $this->client->inference()->create([
            'model' => $this->model,
            'inputs' => $input,
            'type' => Type::TEXT_GENERATION
        ]);

        return $result->toArray();
    }

    public function inferenceSummarization($input): array
    {
        $result = $this->client->inference()->create([
            'model' => $this->model,
            'inputs' => $input,
            'type' => Type::SUMMARIZATION
        ]);

        return $result->toArray();
    }

    public function inferenceSentimentAnalysis($input): array
    {
        $result = $this->client->inference()->create([
            'model' => $this->model,
            'inputs' => $input,
            'type' => Type::SENTIMENT_ANALYSIS
        ]);

        return $result->toArray();
    }
}