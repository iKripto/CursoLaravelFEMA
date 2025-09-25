<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'password' => ['required', 'min:6', 'max:16', 'confirmed'],
        ]);
    }
}
