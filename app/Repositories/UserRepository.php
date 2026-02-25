<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function getUsers(): Collection
    {
        return User::query()->limit(10)->get();
    }

    public function updateUser(array $params, int $id): bool
    {
        return User::query()->findOrFail($id)->update($params);
    }

    public function createUser(array $params): bool
    {
        $user = new User();
        $user->name = $params['name'];
        $user->last_name = $params['last_name'];
        $user->email = $params['email'];
        $user->password = ($params['password']);

        return $user->save();
    }

    public function getFirstUser()
    {
        // select * from users where id = 1 limit 1;
        $sql = "select * from users where id = 1 limit 1";
        $res = DB::select($sql);
        return $res;

//        return User::query()->where('id', '1')->first();
    }

    public function getUserById(int $id): ?User
    {
//        return User::query()->findOrFail($id);
        return User::query()->where('id', $id)->first();
    }

    public function getUsersEmails(int $numberOfEmails): Collection
    {
        return User::query()->select('email')->limit($numberOfEmails)->get();
    }

    public function testSQL()
    {
        // select id, email from users where id > 10 limit 10
        return User::query()->select(['id', 'email'])->limit(10)->get();
    }
}
