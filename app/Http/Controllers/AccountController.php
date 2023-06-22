<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountValidation;

class AccountController extends Controller
{
    public function edit()
    {
        return view('account.index');
    }

    public function update(AccountValidation $request)
    {
        $data = $request->validated();

        $user = User::find(Auth::user()->id);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ($data['new-password'] != null)  $user->password = Hash::make($data['new-password']);

        $user->update();

        return redirect('/account')->with('success', 'Your information has been updated');
    }
}
