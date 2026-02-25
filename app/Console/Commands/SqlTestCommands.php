<?php

namespace App\Console\Commands;

use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class SqlTestCommands extends Command
{
    protected $signature = 'sql:test'; // вызовет консольную операцию
    protected $description = 'Command description';

    public function handle(): int
    {
        $rep = new UserRepository();
        $res = $rep->testSQL();
        dd($res->count());
        echo "ok" . PHP_EOL;
        return 0;
    }
}
