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
     * Inspects the text of a batch of documents for named entities and returns information about them.
     *
     * @param array     $params
     * @return array
     */
    public function batchDetectEntities(array $params = [])
    {
        return $this->client->batchDetectEntities($params);
    }

    /**
     * Detects the key noun phrases found in a batch of documents.
     *
     * @param array     $params
     * @return array
     */
    public function batchDetectKeyPhrases(array $params = [])
    {
        return $this->client->batchDetectKeyPhrases($params);
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

    /**
     * Inspects text for named entities, and returns information about them.
     *
     * @param array     $params
     * @return array
     */
    public function detectEntities(array $params = [])
    {
        return $this->client->detectEntities($params);
    }

    /**
     * Starts an asynchronous topic detection job. Use the DescribeTopicDetectionJob operation to track the status of a job.
     *
     * @param array     $params
     * @return array
     */
    public function startTopicsDetectionJob(array $params = [])
    {
        return $this->client->startTopicsDetectionJob($params);
    }

    /**
     * Gets the properties associated with a topic detection job. Use this operation to get the status of a detection job.
     *
     * @param array     $params
     * @return array
     */
    public function describeTopicsDetectionJob(array $params = [])
    {
        return $this->client->describeTopicsDetectionJob($params);
    }

    /**
     * Gets a list of the topic detection jobs that you have submitted.
     *
     * @param array     $params
     * @return array
     */
    public function listTopicsDetectionJobs(array $params = [])
    {
        return $this->client->listTopicsDetectionJobs($params);
    }

}
