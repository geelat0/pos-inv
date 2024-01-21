<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\LoginModel;
use App\Models\Sched;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ManagerUserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::where('user_role', '=', 3)->get();
        return view('manager.user-management', ['users' => $users]);
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'user_role' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
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
        return view('manager.view-user', ['user' => $user, 'logins' => $logins]);
    }


    public function showSched(User $user)
    {

        $scheds = Sched::where('user_id', $user->id)->first();
        $logins = LoginModel::where('user_id', $user->id)->get();
        return view('manager.view-sched', ['user' => $user, 'logins' => $logins, 'scheds' => $scheds]);
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


    public function changePassword(Request $request, string $id)
    {
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

    public function updateStatus(Request $request)
    {

        $id = $request->input('id');
        $newStatus = $request->input('new_status');

        // Find the category by its ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update the category status
        $user->status = $newStatus;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');

    }


    public function updateSched(Request $request)
    {

        // Find the user by its ID
        $user = User::find($request->id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $selectedDays = $request->input('days', []);
        $user_id = $request->id;

        // Attempt to find the existing schedule for the user
        $schedule = Sched::where('user_id', $user_id)->first();

        if ($schedule) {
            // Update the existing schedule
            $schedule->update([
                'sched_1' => in_array(1, $selectedDays),
                'sched_2' => in_array(2, $selectedDays),
                'sched_3' => in_array(3, $selectedDays),
                'sched_4' => in_array(4, $selectedDays),
                'sched_5' => in_array(5, $selectedDays),
                'sched_6' => in_array(6, $selectedDays),
                'sched_7' => in_array(7, $selectedDays),
            ]);
        } else {
            // Create a new schedule if not found
            Sched::create([
                'user_id' => $user_id,
                'sched_1' => in_array(1, $selectedDays),
                'sched_2' => in_array(2, $selectedDays),
                'sched_3' => in_array(3, $selectedDays),
                'sched_4' => in_array(4, $selectedDays),
                'sched_5' => in_array(5, $selectedDays),
                'sched_6' => in_array(6, $selectedDays),
                'sched_7' => in_array(7, $selectedDays),
            ]);
        }

        return redirect()->back()->with('success', 'User status updated successfully.');
    }
}
