<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $customer = Customer::where('email', $credentials['email'])->first();

        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            // Login berhasil
            $data = [
                'message' => 'Successful',
                'username' => $customer->name,
                'email' => $customer->email,
                'phone_number' => $customer->number,
                'idakun' => strval($customer->id),
                'address' => $customer->address
            ];
            return response()->json($data);
        } else {
            // Login gagal
            return response()->json([
                'message' => 'Successful',
                'username' => '',
                'email' => '',
                'phone_number' => '',
                'idakun' => strval('0'),
                'address' => ''
            ]);
        }
    }


    public function register(Request $request)
    {
        $customer=customer::create($request->all());

        $customer->password = Hash::make($request->password);

        $customer->save();

        return response()->json(['message'=>'succesfull']);
    }
    public function logout()
    {
        Auth::logout();

        return response()->json(['message' => 'Logout successful']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}