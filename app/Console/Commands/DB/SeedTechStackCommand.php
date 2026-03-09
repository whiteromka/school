<?php

namespace App\Console\Commands\DB;

use App\Services\TechStackService;
use Illuminate\Console\Command;

/**
 * команда: php artisan seed:tech_stacks
 */
class SeedTechStackCommand extends Command
{
    protected $signature = 'seed:tech_stacks';
    protected $description = 'Заполнение таблицы tech_stacks данными';

    public function __construct(
        private readonly TechStackService $techStackService
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Очистка таблицы tech_stacks...');

        $data = [
            [
                'id' => 1,
                'name' => 'JavaScript',
                'description' => 'The most popular language.'
            ],
            [
                'id' => 4,
                'name' => 'VueJS',
                'description' => 'Framework.'
            ]
        ];

        $this->techStackService->seedTechStack($data);

        $this->info('Данные успешно добавлены.');

        return Command::SUCCESS;
    }
}
