<?php namespace AzahariZaman\OctopusAI\Traits;

use AzahariZaman\OctopusAI\Models\OctopusAISettings as Settings;
use AzahariZaman\OctopusAI\Classes\HuggingfaceClient;
trait HasSentimentAnalysis
{
    protected $fields;

    public function initializeHasSentimentAnalysis()
    {
        if (! is_array($this->sentimentAnalysisFields)) {
            throw new \Exception(sprintf("The sentimentAnalysisFields field must be an array in %s",
                get_class($this)));
        }
        
        // Set sentiment analaysis attributes on new records and existing records if value is missing.
        $this->bindEvent('model.saveInternal', function () {
            $this->setSentimentValues();
        });
    }

    public function setSentimentValues()
    {
        foreach ($this->sentimentAnalysisFields as $field => $source) {
            if (array_key_exists($field, $this->attributes)) {
                $this->setSentimentValue($field, $source);
            }
        }
    }

    public function setSentimentValue($field, $source)
    {
        $sentiment = '';

        // Check if record is new or field is no value
        if (!array_key_exists($field, $this->attributes) || !mb_strlen($this->attributes[$field])) {
            $result = $this->getSentimentResult($source);
        }
        elseif ($this->isDirty($source)) {
           $result = $this->getSentimentResult($source);
        } else {
            return true;
        }

        if ($result) {
            $this->{$field} = $result['label'];
    
            $this->setSentimentScore($field, $result['score']);        
        }
        
        
    }

    public function getSentimentResult($source)
    {
        $client = new HuggingfaceClient;
            
        $client->setModel(Settings::get('sentiment_analysis_model', 'distilbert-base-uncased-finetuned-sst-2-english'));

        $result = $client->inferenceSentimentAnalysis($this->{$source})['sentiment_analysis'];
        

        if ($result[0]['label'] == 'LABEL_1') {
            $label = 'Neutral';
        } elseif ($result[0]['label'] == 'LABEL_2') {
            $label = 'Positive';
        } elseif ($result[0]['label'] == 'LABEL_0') {
            $label = 'Negative';
        } else {
            $label = 'Unknown';
        }

        return ['label' => $label, 'score' => $result[0]['score']];
    }

    public function setSentimentScore($field, $score)
    {
        // Check if table has score field
        if (array_key_exists($field.'_score', $this->attributes)) {
            $this->{$field.'_score'} = $score;
        }
    }
}