<?php

namespace The3LabsTeam\Readability\Commands;

use Illuminate\Console\Command;

class ReadabilityCommand extends Command
{
    public $signature = 'laravel-readability';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
