<?php namespace AzahariZaman\OctopusAI\Models;

use Model;

/**
 * Record Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Record extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \AzahariZaman\OctopusAI\Traits\HasSentimentAnalysis;

    public $sentimentAnalysisFields = [
        'test_sentiment_analysis' => 'test_sentiment_analysis_source'
    ];

    /**
     * @var string table name
     */
    public $table = 'azaharizaman_octopusai_records';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
