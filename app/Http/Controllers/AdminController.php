<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = user::all();

        return view('.profile.admin', compact('admin'));
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
        $admin = User::findOrFail($id);

        if ($admin->name !== $request->input('name') || $admin->number !== $request->input('number') || $admin->address !== $request->input('address') || !empty($request->input('password'))) {
            $admin->name = $request->input('name');
            $admin->number = $request->input('number');
            $admin->address = $request->input('address');
            $admin->password = Hash::make($request->input('password'));
            $admin->save();
            return back()->with('success', 'Data updated.');
        } else {
            return back()->with('warning', 'No changes detected.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = user::findOrFail($id);

        $admin->delete();

        return back()->with('success', 'Admin account deleted.');
    }
}
