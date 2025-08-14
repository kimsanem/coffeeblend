<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public function menu()
    {
        $desserts = Product::where('type', 'desserts')->get()->map(function ($item) {
            $item->description = Str::limit($item->description, 60, '...');
            return $item;
        });
        $drinks = Product::where('type', 'drinks')->get()->map(function ($item) {
            $item->description = Str::limit($item->description, 60, '...');
            return $item;
        });
        $foods = Product::where('type', 'foods')->get()->map(function ($item) {
            $item->description = Str::limit($item->description, 60, '...');
            return $item;
        });

        return view('menu', compact('desserts', 'drinks', 'foods'));
    }
}
