<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;

class SearchApiController extends Controller
{
    public function search($name)
    {
        // Lakukan pencarian berdasarkan keyword di model yang sesuai
        return response()->json(product::where('name', 'like', '%' . $name . '%')->get());
    }
}
