<?php namespace AzahariZaman\OctopusAI\Classes\Prompts;

class PesonaBuilder
{
    /**
     * Build persona-related prompt.
     *
     * @param string $persona The persona to include in the prompt.
     * @return string The built persona prompt.
     */
    public function buildPersonaPrompt($persona): string
    {
        return $persona ? "This is your persona and it defines your characteristic: " . $persona . ". " : "";
    }
}
