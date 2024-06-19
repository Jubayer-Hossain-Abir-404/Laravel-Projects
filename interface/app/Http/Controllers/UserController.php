<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;
    public function __construct (UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->getAll();
    }

    public function createToken (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
