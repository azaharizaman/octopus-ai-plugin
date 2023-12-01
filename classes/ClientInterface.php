<?php namespace AzahariZaman\OctopusAI\Classes;

interface ClientInterface
{
    public function __construct(string $apiKey, string $organization = null, array $parameters);
    public function setApiKey(string $key): void;
    public function setOrganization(string $organization): void;
    public function setHttpHeaders(array $headers): void;
    public function setModel(string $model): void;
    public function setParameters(array $parameters): void;
    public function getModel(): string;
    public function getParameters(): array;
    public function makeClient(): void;
    public function inferTextSummarization(string $input, array $parameters = []): array;
}