<?php

namespace App\Http\Controllers;

use App\Models\partner;

use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index() {
        $partner = partner::all();

        return view('people.partner', compact('partner'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'nullable|email|unique:partners,email',
        ]);

        $part=partner::create($request->all());

        $part->save();

        return back()->with('success', 'Partner ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $partner = partner::findOrFail($id);

        $partner->name=$request->input('name');
        $partner->email=$request->input('email');
        $partner->number=$request->input('number');
        $partner->keterangan=$request->input('keterangan');
        $partner->address=$request->input('address');

        $partner->save();

        return back()->with('success', 'Updated.');
    }

    public function destroy($id)
    {
        $part=partner::findOrFail($id);

        $part->delete();

        return back()->with('success', 'Deleted!');
    }
}
