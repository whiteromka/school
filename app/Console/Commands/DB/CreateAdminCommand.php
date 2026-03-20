<?php

namespace App\Console\Commands\DB;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Команда: php artisan db:create-admin
 */
class CreateAdminCommand extends Command
{
    protected $signature = 'db:create-admin';
    protected $description = 'Создание пользователя с правами администратора';

    public function handle(): int
    {
        $email = 'whiteromka@yandex.ru';
        $password = '12345678';

        $user = User::query()->where('email', $email)->first();

        if ($user) {
            $this->info("Пользователь с email {$email} найден.");

            if ($user->is_admin) {
                $this->info("Пользователь уже является администратором.");
                return Command::SUCCESS;
            }

            $confirm = $this->confirm('Назначить этого пользователя администратором?');
            if (!$confirm) {
                $this->info('Отменено.');
                return Command::FAILURE;
            }

            $user->is_admin = true;
            $user->save();

            $this->info("Пользователь {$user->getFullNameOrEmail()} успешно назначен администратором.");
            return Command::SUCCESS;
        }

        $this->info("Пользователь не найден, создаём нового администратора...");

        $user = User::query()->create([
            'name' => 'Admin',
            'last_name' => 'User',
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
            'additional_data' => json_encode([]),
        ]);

        $this->info("Администратор создан:");
        $this->table(['Email', 'Password', 'Name'], [
            [$email, $password, 'Admin User']
        ]);

        return Command::SUCCESS;
    }
}
