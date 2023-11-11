<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\LoginModel;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $users = User::all();
        return view('admin.user-management', ['users'=> $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'first_name' => 'required' ,
            'middle_name' => 'required' ,
            'last_name' => 'required' ,
            'user_role' => 'required' ,
            'gender' => 'required' ,
            'mobile' => 'required' ,
            'email' => 'required|email' ,
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        User::create($data);

        return redirect()->back()->with('success', 'USer added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {

        $logins = LoginModel::where('user_id', $user->id)->get();
        return view('admin.view-user', ['user'=> $user , 'logins' => $logins]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        $data = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'user_role' => 'required',
            'gender' => 'required',
            'mobile' => 'required',

        ]);

        $user = User::findOrFail($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
