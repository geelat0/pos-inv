<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthenticatesUsers;

    // Where to redirect users after login.
    protected $redirectTo = '/home';


    public function index()
    {

        return view('login');
    }

    public  function  login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {


            $loginS = new LoginModel();
            $loginS->date_time_in = now();
            $loginS->status = 'Logged In';
            // Associate the post with the authenticated user
            $loginS->user_id =  Auth::id();
            $loginS->save();


            return redirect()->intended($this->redirectTo);
        }

        return back()->withInput($request->only('email'))->withErrors(['email' => 'Invalid  Username or Password ']);

    }


    public  function  home(){

        $user = Auth::user();

        if($user->user_role == 1)
            return redirect('/admin');
        elseif ($user->user_role == 2)
            return redirect('/manager');
        elseif ($user->user_role == 3)
            return redirect('/employee');

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
