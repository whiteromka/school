<?php

namespace App\Console\Commands\DB;

use App\Services\HH\HHService;
use Exception;
use Illuminate\Console\Command;

/**
 * команда: php artisan db:technology
 */
class TechnologyInit extends Command
{
    protected $signature = 'db:technology';

    protected $description = 'Заполнит тбл technologies';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        echo '!!!!' . PHP_EOL;

        $data = [
            'html', 'css', 'js', 'php', 'boostrap', 'AI', 'git', 'openserver', 'oop', 'docker', 'mvc', 'sql', 'mysql', 'pgsql', 'redis',
        ];
        return 0;
    }
}
