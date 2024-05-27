<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        if ($products->count() === 0) {
            return response()->json(['message' => 'Tidak ada produk tersedia.']);
        }

        return response()->json($products);
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
    public function getByCategory($category)
    {
        $products = Product::where('category', $category)->get();

        if ($products->count() === 0) {
            return response()->json(['message' => 'Tidak ada produk dengan kategori ini.']);
        }

        return response()->json($products);
    }

    public function getProdukByName($name)
    {
        $products = Product::where('name', 'like', '%' . $name . '%')->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Tidak ada produk dengan nama ini.']);
        }

        return response()->json($products);
    }



    public function store(Request $request)
    {
        $product=Product::create($request->all());

        if ($request->hasFile('image')) {
            $request->file('image')->move('images/', $request->file('image')->getClientOriginalName());
            $product->image=$request->file('image')->getClientOriginalName();
            $product->save();
        }

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return response()->json($product);
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
