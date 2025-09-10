<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use App\Models\Product\Product;
use App\Models\Product\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;
use Carbon\Carbon;

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
        $product = Product::findOrFail($id);

        // show related product not include current product
        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $id)
            ->take(4)
            ->orderBy('id', 'desc')
            ->get();


        // if already added change button to dark color
        $checkingInCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();
        return view('products.productsingle', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    public function addToCart($id) {
        $product = Product::findOrFail($id);
        $addCart = Cart::create([
            "pro_id"  => $product->id,
            "name"    => $product->name,
            "image"   => $product->image,
            "price"   => $product->price,
            "user_id" => Auth::user()->id
        ]);
//        $addCart = Cart::create([
//            "pro_id" => $request->pro_id,
//            "name" => $request->name,
//            "image" => $request->image,
//            "price" => $request->price,
//            "user_id" => Auth::user()->id
//        ]);


        echo "item added to cart";
        return Redirect::route('product.single', $id)->with(['success' => 'product added to cart successfully!']);
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


//    public function checkout() {
//        return view('products.checkout');
//    }
//    public function prepareCheckout(Request $request) {
//        $value = $request->price;
//
//        Session::put('price', $value);
//        $newPrice = Session::get('price');
//
//        return Redirect::route('checkout', compact('newPrice'));
//    }
//    // store checkout
//    public function storeCheckout(Request $request) {
//        $checkout = Order::create($request->all());
//
//        echo "welcome to paypal payment";
//    }


    public function prepareCheckout(Request $request)
    {
        // Get the logged in user’s cart
        $cartProducts = Cart::where('user_id', Auth::id())->get();
        $totalPrice = $cartProducts->sum('price');
        // update price with total price by sum
        Session::put('price', $totalPrice);
        // pass the cart + total to checkout view
        return view('products.checkout', compact('cartProducts', 'totalPrice'));
    }

    public function checkout()
    {
        return view('products.checkout');
    }


    public function storeCheckout(Request $request)
    {
        $checkout = Order::create($request->all());

        // process order placement logic here
        // e.g. save order to DB, clear cart, redirect to payment
        return redirect()->route('pay',compact('checkout'))->with('success', 'Order placed, redirecting to payment.');
    }



    // PAYPAL PAYMENT
    public function pay(){
        $totalPrice = Cart::where('user_id', Auth::id())->sum('price');
        return view('payments.pay', compact('totalPrice'));
    }

    public function success(){
        $paid = Cart::where('user_id', Auth::id())->sum('price');
        $deleteItems = Cart::where('user_id', Auth::id());
        $deleteItems->delete();

        if($deleteItems) {
            Session::forget('price');
            return view('payments.success', compact('paid'));
        }
    }

//    public function BookTables(Request $request){
//        $date = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');
//        if($request->date > date('n/j/Y')){
//            $booktable = Booking::create($request->all());
//
//            if($booktable) {
//                return Redirect::route('home')->with(['booked' => 'booked successfully!']);
//            }
//        }else{
//            return Redirect::route('home',)->with(['date' => 'invalid date, choose a date in the future...']);
//        }
//    }

    public function BookTables(Request $request)
    {
        // Convert the user's input into Carbon
        $selectedDate = Carbon::createFromFormat('m/d/Y', $request->date);
        $today = Carbon::today();
        Request()->validate([
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'date' => 'required',
            'time' => 'required',
            'phone' => 'required|max:40',
            'message' => 'required|max:40',
        ]);
        // Check if the selected date is in the future
        if ($selectedDate->greaterThan($today)) {
            $booktable = Booking::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'date'       => $selectedDate->format('Y-m-d'), // MySQL format
                'time'       => $request->time,
                'phone'      => $request->phone,
                'user_id'    => $request->user_id,
                'message'    => $request->message,
            ]);

            if ($booktable) {
                return Redirect::route('home')->with([
                    'booked' => 'Booked successfully!'
                ]);
            }
        } else {
            return Redirect::route('home')->with([
                'date' => 'Invalid date, choose a date in the future...'
            ]);
        }
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
