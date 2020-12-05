<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        // Not using pagination for now
        return UserResource::collection(User::latest()->get());
    }
}
