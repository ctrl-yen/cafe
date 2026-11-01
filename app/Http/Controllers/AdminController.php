<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //Laat een lijst zien van alle gebruikers
    public function users() {
        $users = User::orderBy('name')->get();

        return view('admin.users', compact('users'));
    }

    //verandert een gebruiker van actief naar inactief
    public function toggle(User $user){
        $user->is_active = ! $user->is_active;
        $user->save();

        return redirect()->route('admin.users');
    }
}
