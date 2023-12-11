<?php

declare(strict_types=1);

namespace App\Endpoint\Console;

use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Command;
use Spiral\Queue\QueueInterface;
use Spiral\RoadRunner\Jobs\KafkaOptions;

#[AsCommand(name: 'test:push', description: 'Push job.')]
final class PushCommand extends Command
{
    public function __invoke(QueueInterface $queue): int
    {
        // 'deduced_by_rr' is the default name, if name is not specified
        $queue->push('deduced_by_rr', ['some' => 'value'], new KafkaOptions(topic: 'users'));

        $this->info('Job pushed');

        return self::SUCCESS;
    }
}
