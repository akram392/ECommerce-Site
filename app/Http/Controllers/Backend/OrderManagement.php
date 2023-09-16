<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\District;
use App\Models\Division;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Mail\SuccessMail;
use App\Mail\PendingMail;
use App\Mail\ProcessingMail;
use App\Mail\CancelMail;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Mail;

class OrderManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderby('id', 'desc')->get();
        return view('backend.pages.order.manage', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::find($id);
        if (!is_null( $order )) {
            # code...
            $products = Cart::orderby('id', 'asc')->where('order_id', $order->id)->get();
            return view('backend.pages.order.edit', compact('order', 'products') );
        }
        else {
            // 404 page
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::find($id);
        if (!is_null($order)) {
            # code...
            $order->status = $request->status;
            if ( $order->status == 'Successful' ) {
                # code...
                $mailData = [
                    'id'      => $order->name,
                    'email'   => $order->email,
                    'name'    => $order->name,
                    'phone'   => $order->phone,
                ];

                Mail::to( $mailData['email'] )->send( new SuccessMail($mailData) );
            }
            elseif ( $order->status == 'Pending' ) {
                # code...
                $mailData = [
                    'id'      => $order->name,
                    'email'   => $order->email,
                    'name'    => $order->name,
                    'phone'   => $order->phone,
                ];

                Mail::to( $mailData['email'] )->send( new PendingMail($mailData) );
            }
            elseif ( $order->status == 'Processing' ) {
                # code...
                $mailData = [
                    'id'      => $order->name,
                    'email'   => $order->email,
                    'name'    => $order->name,
                    'phone'   => $order->phone,
                ];

                Mail::to( $mailData['email'] )->send( new ProcessingMail($mailData) );
            }
            elseif ( $order->status == 'Canceled' ) {
                # code...
                $mailData = [
                    'id'      => $order->name,
                    'email'   => $order->email,
                    'name'    => $order->name,
                    'phone'   => $order->phone,
                ];

                Mail::to( $mailData['email'] )->send( new CancelMail($mailData) );
            }

            $order->save();

            return redirect()->back();
        }
        else {
            // 404 page
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
