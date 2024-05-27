<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    function tambahkeranjang(Request $request){

        $validatedData = $request->validate([
            'customer_id' => 'required',
            'pid' => 'required',
            'name' => 'required|max:100',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
        ]);

        $cart = cart::create($validatedData);

        return response()->json($cart, 201);
    }

    public function updates(Request $request)
    {

        $validatedData = $request->validate([
            'id' => 'required',
            'customer_id' => 'required',
            'pid' => 'required',
            'name' => 'required|max:100',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
        ]);


        // Dapatkan customer_id dan pid dari $validatedData
        $customerId = $validatedData['customer_id'];
        $id = $validatedData['id'];
        $productId = $validatedData['pid'];

        // Cari keranjang berdasarkan customer_id dan pid
        $cart = cart::where('id',$id)
                    ->where('customer_id', $customerId)
                    ->where('pid', $productId)
                    ->first();

        // Jika keranjang tidak ditemukan, kembalikan respons error
        if (!$cart) {
            return response()->json(['message' => $request], 404);
        }

        // Update data keranjang
        $cart->name = $validatedData['name'];
        $cart->price = $validatedData['price'];
        $cart->quantity = $validatedData['quantity'];
        $cart->image = $validatedData['image'];
        $cart->save();

        // Kembalikan respons sukses
        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function keranjangByUser($customer_id)
    {
        $carts = Cart::join('products', 'carts.pid', '=', 'products.id')
                    ->where('carts.customer_id', $customer_id)
                    ->select('carts.*', 'products.price AS product_price')
                    ->get();

        return response()->json($carts);
    }
    public function deleteKeranjang($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        $cart->delete();

        return response()->json(['message' => 'Cart deleted successfully']);
    }



}