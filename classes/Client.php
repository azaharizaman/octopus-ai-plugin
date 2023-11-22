<?php

namespace AzahariZaman\OctopusAI\Classes;

use OpenAI;
use AzahariZaman\OctopusAI\Models\OctopusAISettings;

/**
 * Class Client
 *
 * Wrapper class for interacting with the OpenAI API.
 *
 * @package AzahariZaman\OctopusAI\Classes
 */
class Client
{
    /**
     * @var OpenAI\Client OpenAI API client instance.
     */
    public $client;

    /**
     * @var int Maximum number of tokens in the response.
     */
    protected $max_token;

    /**
     * @var string OpenAI model to use.
     */
    protected $aimodel;

    /**
     * @var string OpenAI engine to use.
     */
    public $temperature;

    /**
     * Client constructor.
     *
     * Initializes the OpenAI API client with provided settings.
     */
    public function __construct()
    {
        $this->client = OpenAI::client(OctopusAISettings::get('openai_api_key'));
        $this->max_token = OctopusAISettings::get('max_token', 1000);
        $this->aimodel = OctopusAISettings::get('aimodel', 'gpt-3.5-turbo-instruct');
        $this->temperature = OctopusAISettings::get('temperature', 1.0);
    }

    /**
     * Generate a rewritten version of the input value.
     *
     * @param string $value The input value to be rewritten.
     * @return string The rewritten value.
     */
    public function rewrite($value)
    {
        return $this->generateResponse($value, 'rewrite');
    }

    /**
     * Generate a completed version of the input sentence.
     *
     * @param string $value The input sentence to be completed.
     * @return string The completed sentence.
     */
    public function complete($value)
    {
        return $value . $this->generateResponse($value, 'complete');
    }

    /**
     * Generate a summarized version of the input sentences.
     *
     * @param string $value The input sentences to be summarized.
     * @return string The summarized result.
     */
    public function summarize($value)
    {
        return $this->generateResponse($value, 'summarize');
    }

    /**
     * Generate an elaborated version of the input sentences.
     *
     * @param string $value The input sentences to be elaborated.
     * @return string The elaborated result.
     */
    public function elaborate($value)
    {
        return $this->generateResponse($value, 'elaborate');
    }

    public function prompt($value)
    {
        return $this->generateResponse($value, 'prompt');
    }

    

    /**
     * Generate the response using the OpenAI API.
     *
     * @param string $value The input value for the prompt.
     * @param string $mode The mode of operation ('rewrite', 'complete', 'summarize', 'elaborate').
     * @param float $temperature The temperature for response generation (default is 0).
     * @return string The generated response.
     */
    protected function generateResponse($value, $mode, $temperature = 0.7): string
    {
        $temperature = $this->temperature ?: $temperature;
        $response = $this->client->completions()->create([
            'model' => $this->aimodel,
            'prompt' => $this->makePrompt($value, $mode),
            'max_tokens' => $this->max_token,
            'temperature' => $temperature,
        ]);

        $result = "";
        foreach ($response->choices as $choice) {
            $result .= $choice->text;
        }

        return $result;
    }

    /**
     * Generate the prompt for the OpenAI API based on the provided value and mode.
     *
     * @param string $value The input value for the prompt.
     * @param string $mode The mode of operation ('rewrite', 'complete', 'summarize', 'elaborate').
     * @return string The generated prompt.
     */
    protected function makePrompt($value, $mode): string
    {
        $prompt = "";
        $persona = OctopusAISettings::get('persona');
        $context = OctopusAISettings::get('context');
        $intonation = OctopusAISettings::get('intonation');
        $language = OctopusAISettings::get('language');

        $prompt .= $this->makePersonaPrompt(OctopusAISettings::get('persona'));
        $prompt .= $this->makeContextPrompt(OctopusAISettings::get('context'));
        $prompt .= $this->makeIntonationPrompt(OctopusAISettings::get('intonation'));
        $prompt .= $this->makeLanguagePrompt(OctopusAISettings::get('language'));

        switch ($mode) {
            case 'rewrite':
                return $prompt . 'Without repeating or explaining your persona, please rephrase the following sentence while keeping the word count approximately the same: ' . $value;
            case 'complete':
                return $prompt . 'Without repeating or explaining your persona, complete the sentence: ' . $value;
            case 'summarize':
                return $prompt . 'Without repeating or explaining your persona, please summarize the following sentences into a much shorter result: ' . $value;
            case 'elaborate':
                return $prompt . 'Without repeating or explaining your persona, please further elaborate on these sentences: ' . $value;
            case 'prompt':
                return $prompt . 'Without repeating or explaining your persona, please respond on the following: ' . $value;
            default:
                return $prompt . $value;
        }
    }

    /**
     * Make pesona if applicable
     *
     * @param string $persona
     * @return string
     */
    protected function makePersonaPrompt($persona): string
    {
        return $persona ? "This is your persona and it defines your characteristic:  " . $persona . ". " : "";
    }

    /**
     * Make context if applicable
     *
     * @param string $context
     * @return string
     */
    protected function makeContextPrompt($context): string
    {
        return $context ? "This is the context you should be aware of but you are not required to repeat it in your response: " . $context . ". " : "";
    }

    /**
     * Make intonation if applicable
     *
     * @param string $intonation
     * @return string
     */
    protected function makeIntonationPrompt($intonation): string
    {
        return $intonation ? sprintf("When responding, your reply should be in a %s tone. ", $intonation) : "";
    }

    /**
     * Make language if applicable
     *
     * @param string $language
     * @return string
     */
    protected function makeLanguagePrompt($language): string
    {
        return $language ? sprintf("When responding, your reply should be in '%s' language. ", $language) : "";
    }
}
