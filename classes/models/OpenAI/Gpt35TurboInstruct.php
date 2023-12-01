<?php namespace AzahariZaman\OctopusAI\Classes\Models;

use AzahariZaman\OctopusAI\Classes\AIModelInterface;
use AzahariZaman\OctopusAI\Classes\ClientInterface;
use AzahariZaman\OctopusAI\Models\AIModel;

class Gpt35TurboInstruct implements AIModelInterface
{
    public static function formatInput(AIModel $model, ClientInterface $client, string $input, array $parameters = [], string $mode = null): array
    {
        $options = [];
        switch ($mode) {
            case 'chat':
                # code...
                break;
            case 'audio':

                break;
            case 'embeddings':

                break;
            case 'files':

                break;
            case 'images':

                break;
            case 'assistants':

                break;
            case 'threads':

                break;
            case 'completions':
                $options['model'] = 'gpt-3.5-turbo-instruct';
                $options['prompt'] = $input;
                $options['max_tokens'] = $model->tasks()->where('task_code', $mode)->firstOrFail()->pivot->max_token;
                $options['temperature'] = $model->tasks()->where('task_code', $mode)->firstOrFail()->pivot->temperature;
                break;
            default:
                throw new Exception('mode is undefined');

        }
        return $options;
    }

    public static function formatResponse(AIModel $model, $response, array $parameters = [], string $mode = null): array
    {
        $response = [];
        switch ($mode) {
            case 'chat':
                # code...
                break;
            case 'audio':

                break;
            case 'embeddings':

                break;
            case 'files':

                break;
            case 'images':

                break;
            case 'assistants':

                break;
            case 'threads':

                break;
            case 'completions':
                    $response['result'] = $response['choices'][0]['text'];
                break;
            default:
                throw new Exception('mode is undefined');

        }
        return $response;
    }
}