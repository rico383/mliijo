<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$date = order::all();


        //return response()->json($date);
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
    public function show($id)
    {
        $time = order::findOrFail($id);

        return view('order.date-update', compact('time'));
        //return response()->json($time);
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
    $date = order::findOrFail($id);

    $newEventTime = $request->input('event_time');

    if ($newEventTime == $date->event_time) {
        return back()->with('info', 'Tidak ada perubahan yang dilakukan.');
    }

    $date->event_time = $newEventTime;
    $date->save();

    return back()->with('success', 'Tanggal diundur!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
