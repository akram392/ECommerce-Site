<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Checking if the Product already in Cart or Not.
        if ( Auth::check() ) {
            # code...
            $cart = Cart::where( 'user_id', Auth::user()->id )->where( 'product_id', $request->product_id )->where( 'order_id', NULL )->first();
        }
        else {
            $cart = Cart::where( 'ip_address', request()->ip() )->where( 'product_id', $request->product_id )->where( 'order_id', NULL )->first();
        }

        // If already Cart Product Exist.
        if (!is_null($cart)) {
            # code...
            $cart->increment('quantity');
        }
        else {
            # code...
            $cart = new Cart;

            if ( Auth::check() ) {
                # code...
                $cart->user_id        = Auth::user()->id;
            }
            else {
                # code...
                $cart->ip_address     = request()->ip();
            }

            $cart->product_id     = $request->product_id;
            $cart->quantity       = $request->quantity ;
            $cart->unit_price     = $request->unit_price ;
            $cart->save();
        }

        $notification = array (
            'message' => 'Item Added to Cart Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);

        if ( !is_null( $cart )) {
            # code...
            $cart->delete();

            $notification = array (
                'message' => 'Item Removed!',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
    }
}
