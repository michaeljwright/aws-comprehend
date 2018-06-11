<?php   namespace MichaelJWright\Comprehend;

use Aws\Comprehend\ComprehendClient;
use Aws\S3\S3Client;

class Comprehend
{
    /**
     * @var ComprehendClient
     */
    protected $client;

    /**
     * @var S3Client
     */
    protected $s3;

    /**
     * @var array
     */
    protected $args;

    public function __construct()
    {
        $this->args = [
            'credentials' => config('comprehend.credentials'),
            'region' => config('comprehend.region'),
            'version' => config('comprehend.version')
        ];

        $this->client = new ComprehendClient($this->args);
    }

    /**
     * @return ComprehendClient
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Determines the dominant language of the input text for a batch of documents.
     *
     * @param array     $params
     * @return array
     */
    public function batchDetectDominantLanguage(array $params = [])
    {
        return $this->client->batchDetectDominantLanguage($params);
    }

    /**
     * Determines the dominant language of the input text.  (POSITIVE, NEUTRAL, MIXED, or NEGATIVE).
     *
     * @param array     $params
     * @return array
     */
    public function detectDominantLanguage(array $params = [])
    {
        return $this->client->detectDominantLanguage($params);
    }

    /**
     * Inspects a batch of documents and returns an inference of the prevailing sentiment, POSITIVE, NEUTRAL, MIXED, or NEGATIVE, in each one.
     *
     * @param array     $params
     * @return array
     */
    public function batchDetectSentiment(array $params = [])
    {
        return $this->client->batchDetectSentiment($params);
    }

    /**
     * Inspects text and returns an inference of the prevailing sentiment (POSITIVE, NEUTRAL, MIXED, or NEGATIVE).
     *
     * @param array     $params
     * @return array
     */
    public function detectSentiment(array $params = [])
    {
        return $this->client->detectSentiment($params);
    }

    /**
     * Detects the key noun phrases found in the text.
     *
     * @param array     $params
     * @return array
     */
    public function detectKeyPhrases(array $params = [])
    {
        return $this->client->detectKeyPhrases($params);
    }

}
