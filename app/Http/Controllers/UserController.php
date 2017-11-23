<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view('user.edit_info', compact('user'));
    }

    public function update (Request $request, User $user)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $user->update($request->all());

        return redirect()->route('home');
//            ->with('status','User updated info successfully');
    }
}
