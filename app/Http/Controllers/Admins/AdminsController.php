<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Product\Order;
use App\Models\Product\Booking;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use function Illuminate\Events\queueable;

class AdminsController extends Controller
{


    // AUTH
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function viewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            return redirect()->route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('view.login');
    }


    // DASHBOARD
    public function index()
    {
        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $bookingsCount = Booking::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('productsCount', 'ordersCount', 'bookingsCount', 'adminsCount'));
    }


    // ADMINS
    public function displayAllAdmins(){
        $allAdmins = Admin::select()->orderBy('id', 'desc')->get();

        return view('admins.alladmins', compact('allAdmins'));
    }

    public function createAdmin(){
        return view('admins.createadmins');
    }

    public function storeAdmin(Request $request){

        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|max:40",
            "password" => "required|max:40",
        ]);

        $storeAdmins = Admin::Create([
            "name" => $request->name,
            "email" => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($storeAdmins){
            return Redirect()->route('all.admins')->with(['success'=>"new admin created successfully."]);
        }
        return view('admins.createadmins', compact('storeAdmins'));
    }

    public function deleteAdmin($id){
        $admin = Admin::findOrFail($id);
        if (auth()->guard('admin')->id() === $admin->id) {
            return redirect()->back()->with(['error'=>'You cannot delete your own account.']);
        }
        $admin->delete();
        return redirect()->back()->with(['deleted'=>"admin deleted successfully."]);
    }



    // ORDERS
    public function displayAllOrders() {
        $allOrders = Order::select()->orderBy('id', 'desc')->get();

        return view('admins.allorders', compact('allOrders'));
    }

    public function editOrder($id)
    {
        $order = Order::findOrFail($id);
        return view('admins.editorders', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('all.orders')->with(['success' => "order updated successfully."]);
    }
    public function deleteOrder($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('all.orders')->with(['delete' => "order deleted successfully."]);
    }

    // PRODUCTS
    public function displayAllProducts(){
        $allProducts = Product::select()->orderBy('id', 'desc')->get();
        return view('admins.allproducts', compact('allProducts'));
    }
    public function createProduct(){
        return view('admins.createproducts');
    }

    public function storeProduct(Request $request){

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $storeProducts = Product::Create([
            "name" => $request->name,
            "image" => $myimage,
            "price" => $request->price,
            "description" => $request->description,
            "type" => $request->type
        ]);

        if($storeProducts){
            return Redirect()->route('all.products')->with(['success'=>"new product created successfully."]);
        }
    }
    public function deleteProduct($id){
        $product = Product::findOrFail($id);
        if(File::exists(public_path('assets/images/' . $product->image))){
            File::delete(public_path('assets/images/' . $product->image));
        }else{
            //dd('File does not exists.');
        }
        $product->delete();
        if($product){
            return redirect()->route('all.products')->with(['deleted'=>"product deleted successfully."]);
        }
    }

    // BOOKINGS
    public function displayAllBookings(){
        $allBookings = Booking::select()->orderBy('id', 'desc')->get();
        return view('admins.allbookings', compact('allBookings'));
    }
    public function deleteBooking($id){
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect()->route('all.bookings')->with(['delete', "booking deleted successfully."]);
    }
    public function editBooking($id){
        $booking = Booking::findOrFail($id);
        return view('admins.editbookings', compact('booking'));
    }
    public function updateBooking(Request $request, $id){
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        if($booking){
            return redirect()->route('all.bookings')->with(['update' => "booking updated successfully."]);
        }
    }

}
