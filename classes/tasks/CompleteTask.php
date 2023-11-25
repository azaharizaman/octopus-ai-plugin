<?php namespace AzahariZaman\OctopusAI\Classes\Tasks;

use AzahariZaman\OctopusAI\Classes\TaskInterface;
class CompleteTask implements TaskInterface
{
    /**
     * Apply the prompt for the task.
     *
     * @param string $value The input value for the prompt.
     * @param string $persona The persona for the prompt.
     * @return string The generated prompt.
     */
    public function applyPrompt($value, $persona): string
    {
        return 'Without repeating or explaining your persona, please rephrase the following sentence while keeping the word count approximately the same: ' . $value;
    }
}
