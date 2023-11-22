# OctopusAI Client Documentation

## Introduction

The `Client` class is a PHP wrapper designed for easy interaction with the OpenAI API, specifically tailored for the OctopusAI project. This class provides methods to generate rewritten, completed, summarized, and elaborated versions of input values using the OpenAI GPT-3.5 Turbo model.

## Installation

To use the `Client` class in your project, you need to include it and its dependencies. Make sure to install the required packages by running:

```bash
composer require openai/openai
```

## Class Overview

### Namespace

```php
namespace AzahariZaman\OctopusAI\Classes;
```

### Class Structure

```php
class Client
{
    // Properties...

    /**
     * Client constructor.
     */
    public function __construct()
    {
        // Initialization...
    }

    /**
     * Generate a rewritten version of the input value.
     *
     * @param string $value The input value to be rewritten.
     * @return string The rewritten value.
     */
    public function rewrite($value)

    // Additional methods...

    /**
     * Generate the response using the OpenAI API.
     *
     * @param string $value The input value for the prompt.
     * @param string $mode The mode of operation ('rewrite', 'complete', 'summarize', 'elaborate').
     * @param float $temperature The temperature for response generation (default is 0).
     * @return string The generated response.
     */
    protected function generateResponse($value, $mode, $temperature = 0.7): string

    /**
     * Generate the prompt for the OpenAI API based on the provided value and mode.
     *
     * @param string $value The input value for the prompt.
     * @param string $mode The mode of operation ('rewrite', 'complete', 'summarize', 'elaborate').
     * @return string The generated prompt.
     */
    protected function makePrompt($value, $mode): string

    // Additional helper methods...
}
```

## Usage

### Initialization

```php
use AzahariZaman\OctopusAI\Classes\Client;

// Instantiate the OctopusAI Client
$client = new Client();
```

### Methods

#### `rewrite($value)`

Generate a rewritten version of the input value.

```php
$rewrittenValue = $client->rewrite($inputValue);
```

#### `complete($value)`

Generate a completed version of the input sentence.

```php
$completedSentence = $client->complete($inputSentence);
```

#### `summarize($value)`

Generate a summarized version of the input sentences.

```php
$summarizedResult = $client->summarize($inputSentences);
```

#### `elaborate($value)`

Generate an elaborated version of the input sentences.

```php
$elaboratedResult = $client->elaborate($inputSentences);
```

#### `prompt($value)`

Generate a response to a given prompt.

```php
$response = $client->prompt($promptValue);
```

### Configuration

The `Client` class is configured using settings retrieved from the `OctopusAISettings` class. Ensure that the OpenAI API key and other relevant settings are properly configured in the OctopusAISettings class.

## Conclusion

The `Client` class provides a convenient way to interact with the OpenAI API for the OctopusAI project. It encapsulates the logic for generating responses in different modes, making it easy to integrate with various applications. Refer to the documentation for the `OctopusAISettings` class to customize the behavior of the `Client` based on specific project requirements.