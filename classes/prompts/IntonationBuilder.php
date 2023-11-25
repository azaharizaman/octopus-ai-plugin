<?php namespace AzahariZaman\OctopusAI\Classes\Prompts;

class IntonationBuilder
{
    /**
     * Build intonation-related prompt.
     *
     * @param string $intonation The desired intonation for the prompt.
     * @return string The built intonation prompt.
     */
    public function buildIntonationPrompt($intonation): string
    {
        return $intonation ? sprintf("When responding, your reply should be in a %s tone. ", $intonation) : "";
    }
}
