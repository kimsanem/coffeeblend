<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
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


        // if already added change button to dark color
        $checkingInCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();
        return view('products.productsingle', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    public function addToCart(Request $request, $id) {
        $addCart = Cart::create([
            "pro_id" => $request->pro_id,
            "name" => $request->name,
            "image" => $request->image,
            "price" => $request->price,
            "user_id" => Auth::user()->id
        ]);

        echo "item added to cart";
        return Redirect::route('product.single', $id)->with(['success' => 'product added to cart successfully!']);
        // return redirect()->route('home', $id);
    }

    public function cart(){
        $userId = Auth::user()->id;
        //1
        $cartProducts = Cart::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();
        //2
        $totalPrice = Cart::where('user_id', $userId)->sum('price');

        //get pro id
        $productIds = $cartProducts->pluck('pro_id')->toArray();
        // Get Product types in the cart
        $productTypes = Product::whereIn('id', $productIds)->pluck('type')->unique();

        // Fetch related products (same type but not in cart)
        //3
        $relatedProducts = Product::whereIn('type', $productTypes)
            ->whereNotIn('id', $productIds)
            ->take(4)
            ->get();

        return view('products.cart', compact('cartProducts', 'totalPrice', 'relatedProducts' ));
    }

    public function deleteProductCart($id) {
        $deleteProductCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id);

        $deleteProductCart->delete();

        if($deleteProductCart) {
            return Redirect::route('cart')->with(['delete' => 'product deleted from cart successfully']);
        }
    }

    public function prepareCheckout(Request $request) {
        $value = $request->price;

        $price = Session::put('price', $value);

        $newPrice = Session::get($price);

        if($newPrice > 0) {
            return Redirect::route('checkout');
        }
    }
    public function checkout() {
//        echo "welcome checkout";
        return view('products.checkout');
    }
    // store checkout
    public function storeCheckout(Request $request) {

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
