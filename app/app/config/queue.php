<?php

declare(strict_types=1);

use App\Endpoint\Job\Users;
use App\Interceptor\TopicInterceptor;
use Spiral\Queue\Driver\SyncDriver;
use Spiral\RoadRunner\Jobs\Queue\KafkaCreateInfo;

/**
 * Queue configuration
 *
 * @link https://spiral.dev/docs/queue-configuration and https://spiral.dev/docs/queue-roadrunner
 */
return [
    'default' => 'rr-kafka',

    'connections' => [
        'rr-kafka' => [
            'driver' => 'roadrunner',
            'pipeline' => 'kafka',
        ],
    ],

    'pipelines' => [
        'kafka' => [
            'connector' => new KafkaCreateInfo(name: 'kafka'),
            'consume' => true,
        ],
    ],

    'defaultSerializer' => 'json',

    'registry' => [
        'handlers' => [
            'users' => Users::class
        ],
    ],

    'interceptors' => [
        'consume' => [
            TopicInterceptor::class,
        ],
    ],

    'driverAliases' => [
        'sync' => SyncDriver::class,
    ],
];
