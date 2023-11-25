<?php namespace AzahariZaman\OctopusAI\Classes\Prompts;

class LanguageBuilder
{
    /**
     * Build language-related prompt.
     *
     * @param string $language The desired language for the prompt.
     * @return string The built language prompt.
     */
    public function buildLanguagePrompt($language): string
    {
        return $language ? sprintf("When responding, your reply should be in '%s' language. ", $language) : "";
    }
}
