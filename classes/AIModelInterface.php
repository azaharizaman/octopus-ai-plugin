<?php namespace AzahariZaman\OctopusAI\Classes;

use AzahariZaman\OctopusAI\Models\AIModel;
use AzahariZaman\OctopusAI\Classes\ClientInterface;


interface AIModelInterface
{
    public static function formatInput(AIModel $model, ClientInterface $client, string $input, array $parameters = [], string $mode = null): array;
    public static function formatResponse(AIModel $model, array $response, array $parameters = [], string $mode = null): array;
}