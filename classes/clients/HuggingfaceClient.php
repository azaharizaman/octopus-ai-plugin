<?php namespace AzahariZaman\OctopusAI\Classes\Clients;

use AzahariZaman\Huggingface\Enums\Type;
use AzahariZaman\Huggingface\Huggingface;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;
use AzahariZaman\OctopusAI\Classes\ClientInterface;

class HuggingfaceClient implements ClientInterface
{
    protected $client;
    protected string $apiKey;
    protected string $organization = null;
    protected array $headers = ['OpenAI-Beta', 'assistants=v1'];
    protected array $parameters = [];
    protected string $model = 'gpt-3.5-turbo-instruct';
    public function __construct(string $apiKey, string $organization = null, array $parameters)
    {
        $this->setApiKey($apiKey);
        $this->setOrganization($organization);
        if (array_key_exists('model', $parameters)) {
            $this->setModel($parameters['model']);
        }

        if (array_key_exists('headers', $parameters)) {
            $this->setHttpHeaders($parameters['headers']);
        }

        if (array_key_exists('parameters', $parameters)) {
            $this->setParameters($parameters['$parameters']);
        }

        $this->client = $this->makeClient();
    }
    public function setApiKey(string $key): void
    {
        $this->apiKey = $key;
    }
    public function setOrganization(string $organization): void
    {
        $this->organization = $organization;
    }
    public function setHttpHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function setParameters($parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getModel(): string
    {
        return $this->model;
    }
    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function makeClient(): void
    {
        $this->client = Huggingface::client($this->apiKey);
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

    public function inferTextSummarization(string $input, array $parameters = []): array
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

    public function execute(string $task, string $value)
    {

    }
}