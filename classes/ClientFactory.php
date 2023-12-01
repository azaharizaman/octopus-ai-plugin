<?php namespace AzahariZaman\OctopusAI\Classes;

use AzahariZaman\OctopusAI\Classes\ClientInterface;
use AzahariZaman\OctopusAI\Classes\Clients\OpenAICompletionClient;
use AzahariZaman\OctopusAI\Classes\Clients\HuggingfaceClient;

class ClientFactory
{
    public static function createOpenAIClient(string $api_key, string $organization, array $parameters): ClientInterface
    {
        return new OpenAICompletionClient($api_key, $organization, $parameters);
    }

    public static function createOpenAIChatlient(string $api_key, string $organization, array $parameters): ClientInterface{
        return new OpenAIChatClient($api_key, $organization, $parameters);
    }

    public static function createHuggingfaceClient(string $api_key, string $organization, array $parameters): ClientInterface
    {
        return new HuggingfaceClient($api_key, $organization, $parameters);
    }
}