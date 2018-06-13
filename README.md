# fork of larareko/aws-comprehend

A Laravel package/facade for Amazon Comprehend, part of AWS API PHP SDK.

This repository implements a simple Service Provider of the AWS Comprehend client, and makes it easily accessible via a Facade in Laravel >= 5.

* See docs for usage (https://docs.aws.amazon.com/comprehend/latest/dg/API_Reference.html)

Also see [AWS Comprehend](https://aws.amazon.com/comprehend/) for more information.

## Requirements

Create an account at [AWS](https://aws.amazon.com/console/) and take note of your API keys.

## Installation using [Composer](https://getcomposer.org)

In your terminal application move to the root directory of your laravel project using the cd command and require the project as a dependency using composer.

composer require michaeljwright/aws-comprehend

This will add the following lines to your composer.json and download the project and its dependencies to your projects ./vendor directory:

```javascript
//

./composer.json
{
    "name": "michaeljwright/aws-comprehend",
    "description": "A Laravel package for the AWS Comprehend",

    // ...

    "require-dev": {
        "phpunit/phpunit": "~5.7",
        "orchestra/testbench": "~3.0"
        // ...
    },
    "require": {
        "aws/aws-sdk-php":"~3.0"
    },

    //...
}
```

## Usage

In order to use the static interface we must customize the application configuration to tell the system where it can find the new service. Open the file config/app.php and add the following lines ([a], [b]):

```php

// config/app.php

return [

    // ...

    'providers' => [

        // ...

        /*
         * Package Service Providers...
         */
        MichaelJWright\Comprehend\ComprehendServiceProvider::class, // [a]

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

    ],

    // ...

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,

        // ...

        'Comprehend' => 'MichaelJWright\Comprehend\ComprehendFacade', // [b]
        'Hash' => Illuminate\Support\Facades\Hash::class,

        // ...
    ],

];


```

## Publish Vendor

aws-comprehend requires a connection configuration. To get started, you'll need to publish all vendor assets running:

php artisan vendor:publish

This will create a config/comprehend.php file in your app that you can modify to set your configuration. Make sure you add relevant environment variables which are referenced in the comprehend.php file. It's also very important to edit your AWS IAM for the specified key/secret/region to include the Amazon Comprehend API.

Now you should be able to use the facade within your application. Ex:

```php

$config = [
       'LanguageCode' => 'en',
       'TextList' => ['This is good', 'This is bad'],
   ];

$jobSentiment = \Comprehend::batchDetectSentiment($config);

dd($jobSentiment['ResultList']);

```

## Example to detect Sentiment from a given array containing strings (comments)

```php

// FIRST create a function to call the comprehend facade and parse the results (below will return an array with the overall sentiment as well as positive/negative scores)

public function sentimentAnalysis($comments) {

    $results = array();

    if(count($comments)>0) {
        $config = [
               'LanguageCode' => 'en',
               'TextList' => $comments,
           ];

        $jobSentiment = \Comprehend::batchDetectSentiment($config);

        $positive = array();
        $negative = array();

        if(count($jobSentiment['ResultList'])) {
            foreach($jobSentiment['ResultList'] as $result){
                $positive[] = $result['SentimentScore']['Positive'];
                $negative[] = $result['SentimentScore']['Negative'];
            }
        }

        $results['positive'] = array_sum($positive)/count($positive);
        $results['negative'] = array_sum($negative)/count($negative);
        $results['sentiment'] = ($results['positive'] > $results['negative'] ? 'POSITIVE' : 'NEGATIVE');

        return $results;
    } else {
        return $results['sentiment'] = 'INVALID';
    }
}

// SECOND create an array of comments for the analysis and call the above function

$comments = [
    'I think this is very good considering I created a package/wrapper for Amazon Comprehend. Yay me!',
    'Oh my good this is such a bloody rubbish package/wrapper. I hope the author stops coding immediately.',
    'This is really good, I really love this stand by this',
    'This is sooooo bad'
];

dd($this->sentimentAnalysis($comments));

```

## Testing

Unit Tests are created with PHPunit and orchestra/testbench, they can be ran with ./vendor/bin/phpunit.

## Contributing

Find an area you can help with and do it. Open source is about collaboration and open participation.
Try to make your code look like what already exists or better and submit a pull request. Also, if
you have any ideas on how to make the code better or on improving the scope and functionality please
contact any of the contributors.

## License

MIT License.
