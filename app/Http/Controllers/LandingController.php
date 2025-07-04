<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::take(4)->get(); // Ambil 4 produk favorit
        return view('landing', compact('products'));
    }
}
