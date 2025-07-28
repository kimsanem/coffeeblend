<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Logic to retrieve and display products
    }

    public function singleProduct($id)
    {
        $product = Product::find($id);

        // show related product not include current product
        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $id)->take(4)
            ->orderBy('id', 'desc')
            ->get();

        return view('products.productsingle', compact('product','relatedProducts'));
    }

    public function __invoke()
    {
        
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Logic to show product creation form
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Logic to store a new product
    }
}