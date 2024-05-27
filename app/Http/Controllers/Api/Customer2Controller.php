<?php

namespace App\Http\Controllers\Api;

use App\Models\customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class Customer2Controller extends Controller
{
    public function index()
    {
        $customer = customer::all();

        return response()->json($customer);
    }

    public function show($id)
    {
        $customer=customer::findOrFail($id);

        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer = customer::findOrFail($id);

        if ($request->has('name')) {
            $customer->name = $request->input('name');
        }

        if ($request->has('email')) {
            $customer->email = $request->input('email');
        }

        if ($request->has('number')) {
            $customer->number = $request->input('number');
        }

        if ($request->has('address')) {
            $customer->address = $request->input('address');
        }

        if ($request->has('password')) {
            $customer->password = hash::make($request->input('password'));
        }

            $customer->save();

        return response()->json($customer);
    }


    public function destroy($id)
    {
        $customer=customer::findOrFail($id);

        $customer->delete();

        return response()->json(['message'=>'Succesfull']);
    }
}
