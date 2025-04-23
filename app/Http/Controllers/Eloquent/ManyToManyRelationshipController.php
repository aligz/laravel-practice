<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ManyToManyRelationshipController extends Controller
{
    public function index()
    {
        return view('data',
            [
                'data' => [
                    'users' => User::with('roles')->get(),
                    'roles' => Role::with('users')->get(),
                    'user_manyToMany_role' => User::find(1)->roles,
                ]
            ]);
    }
}
