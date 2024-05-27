<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customer = customer::all();

        return view('profile.customer', compact('customer'));
    }

    public function destroy($id) {
        $customer = customer::findOrFail($id);

        if($customer){
        $customer->delete();

        return back()->with('success', 'Account deleted');
        }else{
            return back()->withErrors(['error'=>'Failed to delete.']);
        }
    }
}
