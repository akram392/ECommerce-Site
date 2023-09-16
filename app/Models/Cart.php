<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'quantity',
        'unit_price',
        'user_id',
        'ip_address',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    // public function order(){
    //     return $this->belongsTo(Order::class);
    // }

    // Total number of Items
    public static function totalItems(){
        if ( Auth::check() ) {
            # code...
            $carts = Cart::where( 'user_id', Auth::user()->id )->where( 'order_id', NULL )->get();
        }
        else {
            $carts = Cart::where( 'ip_address', request()->ip() )->where( 'order_id', NULL )->get();
        }

        $total_item_num = 0;
        foreach ($carts as $cart) {
            # code...
            $total_item_num += $cart->quantity;
        }

        return $total_item_num;
    }


    // Total Cart Amount
    public static function totalCartAmount(){
        if ( Auth::check() ) {
            # code...
            $carts = Cart::where( 'user_id', Auth::user()->id )->where( 'order_id', NULL )->get();
        }
        else {
            $carts = Cart::where( 'ip_address', request()->ip() )->where( 'order_id', NULL )->get();
        }

        $offerAmount = 0;
        $regularAmount = 0;
        foreach ($carts as $cart) {
            # code...
            if ( !is_null( $cart->product->offer_price )) {
                # code...
                $price = $cart->product->offer_price * $cart->quantity;
                $offerAmount += $price;
            } else {
                # code...
                $price = $cart->product->regular_price * $cart->quantity;
                $regularAmount += $price;
            }
        }

        $totalAmount = $offerAmount + $regularAmount;
        return $totalAmount;

    }

    // Total Cart Product Details
    public static function totalCarts(){
        if ( Auth::check() ) {
            # code...
            $carts = Cart::where( 'user_id', Auth::user()->id )->where( 'order_id', NULL )->get();
        }
        else {
            $carts = Cart::where( 'ip_address', request()->ip() )->where( 'order_id', NULL )->get();
        }

        return $carts;
    }
}

