<?php namespace AzahariZaman\OctopusAI\Classes;

use AzahariZaman\OctopusAI\Classes\Responses\SummaryResponse;
use AzahariZaman\OctopusAI\Classes\Responses\ExpandResponse;
use AzahariZaman\OctopusAI\Classes\Responses\RewriteResponse;
use AzahariZaman\OctopusAI\Classes\Responses\AsPromptResponse;
use AzahariZaman\OctopusAI\Classes\Responses\CompleteResponse;

use OpenAI;
use Exception;
use AzahariZaman\OctopusAI\Classes\Prompts\PromptBuilder;
use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;

/**
 * Class Client
 *
 * Wrapper class for interacting with the OpenAI API.
 *
 * @package AzahariZaman\OctopusAI\Classes
 */
class OpenAIClient
{
    /**
     * @var OpenAI\Client OpenAI API client instance.
     */
    public $client;


    /**
     * @var PromptBuilder Prompt builder instance.
     */
    protected $promptBuilder;

    /**
     * Client constructor.
     *
     * Initializes the OpenAI API client with provided settings.
     */
    public function __construct()
    {
        $this->client = OpenAI::client(Settings::get('openai_api_key'));
        $this->promptBuilder = new PromptBuilder();
    }

    public function execute(string $task, string $value)
    {
        $task = ucwords(camel_case($task));

        switch ($task) {
            case 'summary':
                $response = new SummaryResponse($this->client, $this->promptBuilder);
                break;
            case 'complete':
                $response = new CompleteResponse($this->client, $this->promptBuilder);
                break;
            case 'expand':
                $response = new ExpandResponse($this->client, $this->promptBuilder);
                break;
            case 'rewrite':
                $response = new RewriteResponse($this->client, $this->promptBuilder);
                break;
            case 'asPrompt':
                $response = new AsPromptResponse($this->client, $this->promptBuilder);
                break;
            default:
                throw new Exception('Unknown response type');
        }
        

        $result = $response->execute($this->client, $value);

        return $result;
    }
}
