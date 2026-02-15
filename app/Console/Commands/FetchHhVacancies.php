<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use App\Services\HH\HHService;

/**
 * docker compose exec app bash
 * команда: php artisan hh:fetch
 */
class FetchHhVacancies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Можно передавать тип вакансий: PHP, JS и т.д.
     */
    protected $signature = 'hh:fetch {type=PHP}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch vacancies from HeadHunter and save to database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $type = $this->argument('type');
        $this->info("Fetching $type vacancies from HeadHunter...");
        $service = new HHService($type);

        try {
            $service->fetchVacancies();
            $this->info("Vacancies successfully fetched and saved.");
        } catch (Exception $e) {
            $this->error("Error fetching vacancies: " . $e->getMessage());
            return 1;
        }
        return 0;
    }
}
