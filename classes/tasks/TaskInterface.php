<?php namespace AzahariZaman\OctopusAI\Classes;

interface TaskInterface
{
    /**
     * Apply the prompt for the task.
     *
     * @param string $value The input value for the prompt.
     * @param string $persona The persona for the prompt.
     * @return string The generated prompt.
     */
    public function applyPrompt($value, $persona): string;
}
