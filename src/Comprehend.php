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
     * Inspects text and returns an inference of the prevailing sentiment (POSITIVE, NEUTRAL, MIXED, or NEGATIVE).
     *
     * @param array     $params
     * @return array
     */
    public function detectSentiment(array $params = [])
    {
        return $this->client->detectSentiment($params);
    }

}
