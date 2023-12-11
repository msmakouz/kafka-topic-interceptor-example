<?php

declare(strict_types=1);

namespace App\Interceptor;

use Spiral\Core\CoreInterceptorInterface;
use Spiral\Core\CoreInterface;

final class TopicInterceptor implements CoreInterceptorInterface
{
    private const ROADRUNNER_DEFAULT_NAME = 'deduced_by_rr';

    public function process(string $name, string $action, array $parameters, CoreInterface $core): mixed
    {
        if ($name !== self::ROADRUNNER_DEFAULT_NAME) {
            return $core->callAction($name, $action, $parameters);
        }

        $topic = $parameters['queue'];

        // We skip handler existence check here, add it if you need it
        return $core->callAction($topic, $action, $parameters);
    }
}
