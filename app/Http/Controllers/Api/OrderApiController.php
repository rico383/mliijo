<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class OrderApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = order::all();

        return response()->json($order);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDeleteOrder(Request $request)
{
    $data = $request->validate([
        'id' => 'required|integer',
        'id_cust' => 'required|integer',
        'file' => 'required|image',
    ]);

    $file = $request->file('file');
    $fileName = $file->getClientOriginalName();
    $request->file('file')->move('bukti/', $request->file('file')->getClientOriginalName());
    // Simpan gambar dengan nama file yang ditentukan
    //$filePath = $file->storeAs('bukti', $fileName);

    $order = Order::findOrFail($data['id']);
    $order->customer_id = $data['id_cust'];

    $order->proof_payment = $fileName;

    $order->save();

    return response()->json(['message' => 'Order updated or deleted successfully'], 200);
}



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'integer',
            'name' => 'required|max:100',
            'number' => 'required',
            'email' => 'required',
            'method' => 'required',
            'address' => 'required',
            'total_products' => 'required',
            'total_price' => 'required',
            'order_time' => 'required',
            'event_time' => 'required',
            'proof_payment'=> 'required'
        ]);

        $order = Order::create($validatedData);
        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($customer_id)
{
    $order = Order::where('customer_id', $customer_id)
                  ->orderBy('order_time', 'desc')
                  ->get();

    return response()->json($order);
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

        $order = order::findOrFail($id);

        if ($request->hasFile('proof_payment')) {
            $myFile = 'bukti/'.$order->proof_payment;
            if(File::exists($myFile))
            {
                File::delete($myFile);
            }

            $request->file('proof_payment')->move('bukti/', $request->file('proof_payment')->getClientOriginalName());
            $order->image=$request->file('proof_payment')->getClientOriginalName();
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);


    if ($order->proof_payment) {
        $oldFilePath = public_path('bukti/'.$order->proof_payment);
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }
    }
    $order->delete();

    return response()->json($order);
    }
}
