<?php

namespace Rapkis\Controld\Commands;

use Illuminate\Console\Command;

class ControldCommand extends Command
{
    public $signature = 'laravel-controld';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
