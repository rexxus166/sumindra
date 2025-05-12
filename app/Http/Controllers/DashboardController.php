<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('toko')->latest()->get();
        return view('page.dashboard.index', compact('products'));
    }
}
