<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('session.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validate = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validate){
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('session.index')->with('reg-succ', 'Register successfull.');
        } else {
        return back()->withErrors(['message'=>'Register failed.']);
        }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($attributes)){
            return redirect('/home')->with('success', 'You are logged in.');
        }else{
            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('session.error-404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('session.register');
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
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('messages', 'Silahkan login kembali.');
    }
}
