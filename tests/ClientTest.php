<?php namespace AzahariZaman\OctopusAI\Tests;

use PluginTestCase;
use AzahariZaman\OctopusAI\Classes\Client;

/**
 * ClientTest Test
 */
class ClientTest extends PluginTestCase
{
    /**
     * test_example is a basic test
     */
    public function testRewrite()
    {
        $client = new Client();
        $value = "This is a sample sentence.";
        $rewrite = $client->rewrite($value);

        $this->assertNotEmpty($rewrite);
        $this->assertNotEquals($value, $rewrite);
    }

    public function testComplete()
    {
        $client = new Client();
        $value = "This is an incomplete sentence.";
        $complete = $client->complete($value);

        $this->assertNotEmpty($complete);
        $this->assertStringContainsString($value, $complete);
    }

    public function testSummarize()
    {
        $client = new Client();
        $value = "This is a long paragraph that needs summarizing.";
        $summarize = $client->summarize($value);

        $this->assertNotEmpty($summarize);
        $this->assertLessThan(strlen($value), strlen($summarize));
    }

    public function testElaborate()
    {
        $client = new Client();
        $value = "This is a simple sentence.";
        $elaborate = $client->elaborate($value);

        $this->assertNotEmpty($elaborate);
        $this->assertGreaterThan(strlen($value), strlen($elaborate));
    }
}
