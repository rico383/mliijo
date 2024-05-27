<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $product = product::all();

        return view('product.product', compact('product'));
    }

    public function show($id) {
        $product = product::findOrFail($id);

        return view('product.update-product', compact('product'));
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:500',
            'category' => 'required|string|max:500',
            'keterangan' => 'string|max:500',
            'price' => 'required|string|max:500',
            'image' => 'image|max:2048',
        ]);

        if($validatedData){
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->category = $validatedData['category'];
        $product->keterangan = $validatedData['keterangan'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('product'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return back()->with('success', 'Product added.');
    }else{
        return back()->withErrors(['error'=>'Failed to add the product.']);
    }
}


    public function update(Request $request, $id) {
        $validatedData = $request -> validate([
            'name' => 'nullable|string|max:500',
            'category' => 'nullable|string|max:500',
            'keterangan' => 'nullable|string|max:500',
            'price' => 'nullable|string|max:500',
            'image' => 'nullable|image',
        ]);

        try {
            $product = Product::findOrFail($id);

            if ($validatedData) {
                $isUpdated = false;

                if ($request->has('name') && $product->name != $request->input('name')) {
                    $product->name = $request->input('name');
                    $isUpdated = true;
                }

                if ($request->has('category') && $product->category != $request->input('category')) {
                    $product->category = $request->input('category');
                    $isUpdated = true;
                }

                if ($request->has('keterangan') && $product->keterangan != $request->input('keterangan')) {
                    $product->keterangan = $request->input('keterangan');
                    $isUpdated = true;
                }

                if ($request->has('price') && $product->price != $request->input('price')) {
                    $product->price = $request->input('price');
                    $isUpdated = true;
                }

                if ($request->hasFile('image')) {
                    $myFile = 'product/' . $product->image;
                    if (File::exists($myFile)) {
                        File::delete($myFile);
                    }

                    $request->file('image')->move(public_path('product/'), $request->file('image')->getClientOriginalName());
                    $product->image = $request->file('image')->getClientOriginalName();
                    $isUpdated = true;
                }

                if ($isUpdated) {
                    $product->save();
                    return back()->with('success', 'Product updated.');
                } else {
                    return back()->with('error', 'No changes detected.');
                }
            } else {
                return back()->with('error', 'Failed to update.');
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return back()->with('error', 'Product not found.');
        }

    }

    public function destroy(Request $request, $id) {
        $product = Product::findOrFail($id);

        if ($product->image) {
            $oldFilePath = public_path('product/'.$product->image);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $product -> delete();

        return back()->with('message', 'Product deleted.');
    }
}
