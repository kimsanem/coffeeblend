<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }
    public function store(Request $request){
        Contact::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        return Redirect::route('contact')->with(['success' => 'Your message has been sent successfully!']);
    }

}
