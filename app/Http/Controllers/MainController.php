<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Team;
use App\Models\Role;
use App\Models\Permission;

class MainController extends Controller
{

    public function index()
    {

        // with() prevents N+1 issues which are multiple database calls
        $users = User::with('teams')->get();
        $teams = Team::with('users')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('index', compact(['users', 'teams', 'roles', 'permissions']));
    }
}