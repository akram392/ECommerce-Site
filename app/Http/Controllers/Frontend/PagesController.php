<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;
use Auth;
use Mail;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.pages.homepage');
    }

    /**
     * Display a listing of the resource.
     */
    public function about()
    {
        return view('frontend.pages.static-pages.about');
    }

    /**
     * Display a listing of the resource.
     */
    public function contact()
    {
        return view('frontend.pages.static-pages.contact');
    }

    /**
     * Display a listing of the resource.
     */
    public function contactMail(Request $request)
    {
        $mailData = [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        Mail::to('akramhoss392ain@gmail.com')->send( new ContactMail($mailData) );

        $notification = array (
            'message' => 'Thank You! We Have Received Your Mail',
            'alert-type' => 'Success',
        );
        return redirect()->back()->with($notification);

    }

    /**
     * Display a listing of the resource.
     */
    public function products()
    {
        $products = Product::orderBy('id', 'desc')->where('status', 1)->get();
        return view('frontend.pages.product.all-products', compact('products'));
    }

    /**
     * Display a listing of the resource.
     */
    public function pdetails($slug)
    {
        $pdetails = Product::where('slug', $slug)->first();
        return view('frontend.pages.product.details', compact('pdetails'));
    }

    /**
     * Display a listing of the resource.
     */
    public function userLogin()
    {
        return view('frontend.pages.auth-user.login');
    }

    /**
     * Display a listing of the resource.
     */
    public function checkout()
    {
        $divisions = Division::orderBy( 'priority_num', 'asc')->get();
        $districts = District::orderBy( 'name', 'asc')->get();
        return view('frontend.pages.checkout', compact('divisions', 'districts'));
    }

}
