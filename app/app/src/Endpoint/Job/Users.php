<?php

declare(strict_types=1);

namespace App\Endpoint\Job;

use Spiral\Queue\JobHandler;

final class Users extends JobHandler
{
    public function invoke(array $payload): void
    {
        file_put_contents(dirname(__DIR__) . '/users.log', print_r($payload, true), FILE_APPEND);
    }
}
