<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public  function index($id){

        $user = User::find($id);
        return view('profile', compact('user'));

    }

    public  function update(Request $request ){



        $data = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
        ]);


        $user = User::findOrFail($request->id);

        // Update the user attributes
        $user->update($data);

        return redirect()->back()->with('success', 'User updated successfully');

    }

    public  function  changePassword(Request $request, string $id) {
        $data = $request->validate([
            'password' => 'nullable|confirmed|min:6', // You can make password optional
            'password_confirmation' => 'nullable'
        ]);

        $user = User::findOrFail($id);

        // Update the user attributes
        $user->update($data);

        return redirect()->back()->with('success', 'Password updated successfully');
    }

}
