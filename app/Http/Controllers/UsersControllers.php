<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Rules\UserUniqueEmailRule;
use App\Services\RandomUserCreatorService;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

////GET /users - список задач (index)
////GET /users/create - форма создания (create)
////POST /users - сохранение задачи (store)
////GET /users/{user} - просмотр задачи (show)
////GET /users/{user}/edit - форма редактирования (edit)
////PUT/PATCH /users/{user} - обновление задачи (update)
////DELETE /users/{user} - удаление задачи (destroy)
class UsersControllers extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ){}

    public function index()
    {
        $users = $this->userService->getUsers();
        $names = [];
        foreach ($users as $user) {
            $names[] = $user->name;
        }
        return view('users.index', [
            'names' => $names,
            'users' => $users
        ]);
    }

    public function firstUser()
    {
        $firstUser = $this->userService->getFirstUser();
        return view('users.firstUser', [
            'firstUser' => $firstUser
        ]);
    }

    // GET //user/user-by-id
    public function userById(int $id)
    {
        $userById = $this->userService->getUserById($id);

        // Добавляем CORS заголовки напрямую в ответ
        return response()->json($userById)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5174') // Разрешить любой источник
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-XSRF-TOKEN');
    }

    public function usersEmails(int $numberOfEmails)
    {
        $usersEmails = $this->userService->getUsersEmails($numberOfEmails);
        return response()->json($usersEmails)
            ->header('Access-Control-Allow-Origin', 'http://localhost:5174') // Разрешить любой источник
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, X-XSRF-TOKEN');
    }

    public function deleteUser(int $id)
    {
        $deletedUser = User::query()->where('id', $id)->delete();
//        $message = $deletedUser ? "User $id deleted successfully!" : "User $id was not found!";

        if ($deletedUser) {
            return redirect()->route('users.index')->with("success", "User $id deleted successfully!");
        }
        return redirect()->route('users.index')->with("error", "User $id was not deleted!");
//        return view('users.deleteUser', [
//            'message' => $message
//        ]);
    }

    public function createUsers(int $numberOfUsers)
    {
        $createdUsersNumber = (new RandomUserCreatorService())->createUsers($numberOfUsers);
        return view('users.createUsers', [
            'createdUsersNumber' => $createdUsersNumber
        ]);
    }

    public function updateUser(int $id)
    {
        $user = (new RandomUserCreatorService())->updateUser($id);

        if ($user->save()) {
            return redirect()->route('users.index')->with("success", "User $user->name updated successfully!");
        }
        return redirect()->route('users.index')->with("error", "User $user->name was not updated!");

//        return view('users.updateUser', [
//            'updatedUser' => $user
//        ]);
    }

    // GET /users/create
    public function create()
    {
        return view('users.create');
    }

    // POST /users
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
        ]);
//        $params = $request->request->all();

        $isCreated = (new UserService())->create($validatedData);
        if ($isCreated) {
            return redirect()->route('users.index')->with("success", "User was created successfully!");
        }
        return redirect()->route('users.index')->with("error", "User was not created!");
    }

    //GET /users/show-update-form/{user}
    public function showUpdateForm(User $user)
    {
        return view('users.showUpdateForm', [
            'user' => $user
        ]);
    }

    //POST /users/update
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['required', 'email', new UserUniqueEmailRule($request->request->get("id"))]
        ]);

        $isUpdated = (new UserService())->update($validatedData, $request->request->get("id"));
        if ($isUpdated) {
            return redirect()->route('users.index')->with("success", "User was updated successfully!");
        }
        return redirect()->route('users.index')->with("error", "User was not updated!");
    }
}
