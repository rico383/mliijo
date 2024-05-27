<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.users-profile');
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
    public function show()
    {
        return view('profile.users-profile');
        //return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with('error', 'Old password does not match our records.');
            dd('old pass does not match');
        }

        if($request->new_password != $request->repeat_password){
            return back()->with('error', 'New password and confirmation password do not match.');
        }

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'Your password changed.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validasi input yang diterima dari request
        $request->validate([
            'name' => 'nullable|string|max:500',
            'email' => 'nullable|email|max:50|unique:users,email,'.Auth::id(),
            'about' => 'nullable|string|max:500',
            'company' => 'nullable|string|max:500',
            'job' => 'nullable|string|max:500',
            'country' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:500',
            'number' => 'nullable|string|max:50',
            'profile_img' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->has('name')) {
        $user->name = $request->input('name');
        }

        if ($request->has('email')) {
        $user->email = $request->input('email');
        }

        if ($request->has('about')) {
        $user->about = $request->input('about');
        }

        if ($request->has('company')) {
        $user->company = $request->input('company');
        }

        if ($request->has('job')) {
        $user->job = $request->input('job');
        }

        if ($request->has('country')) {
        $user->country = $request->input('country');
        }

        if ($request->has('address')) {
        $user->address = $request->input('address');
        }

        if ($request->has('number')) {
        $user->number = $request->input('number');
        }

        if ($request->hasFile('profile_img')) {
            $myFile = 'profile/'.$user->profile_img;
            if(File::exists($myFile))
            {
                File::delete($myFile);
            }

            $request->file('profile_img')->move('profile/', $request->file('profile_img')->getClientOriginalName());
            $user->profile_img=$request->file('profile_img')->getClientOriginalName();
        }

            $user->save();

        return redirect()->route('profile.show')->with('success', 'User updated successfully.');
        //return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();

        if ($user->profile_img) {
            $oldFilePath = public_path('profile/'.$user->profile_img);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            return back()->with('status', 'Gambar dihapus.');
        }

        return back()->with('error', 'File tidak ditemukan.');
    }
}
