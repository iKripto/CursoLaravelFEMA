<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return response()->json([
            'users' => $users,
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'password' => ['required', 'min:6', 'max:16', 'confirmed']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'user' => $user,
        ], Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        
    }
}
