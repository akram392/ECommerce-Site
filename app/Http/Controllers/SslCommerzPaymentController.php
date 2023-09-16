<?php

namespace App\Http\Controllers;

use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\Product;
use App\Models\District;
use App\Models\Division;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use File;
use Image;
use Auth;
use DB;
use Carbon\Carbon;

class SslCommerzPaymentController extends Controller
{
    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount']      = $request->amount; # You cant not pay less than 10
        $post_data['shipping_amount']   = '0';
        $post_data['currency']          = "BDT";
        $post_data['tran_id']           = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name']         = $request->name;
        $post_data['cus_email']        = $request->email;
        $post_data['cus_add1']         = $request->address_line1;
        $post_data['cus_add2']         = $request->address_line2;
        $post_data['cus_district']     = $request->district_id;
        $post_data['cus_division']     = $request->division_id;
        $post_data['cus_postcode']     = $request->zipCode;
        $post_data['cus_country']      = $request->country_name;
        $post_data['cus_phone']        = $request->phone;
        // $post_data['cus_order_status'] = 1;
        // $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        // $post_data['ship_name'] = "Store Test";
        // $post_data['ship_add1'] = "Dhaka";
        // $post_data['ship_add2'] = "Dhaka";
        // $post_data['ship_city'] = "Dhaka";
        // $post_data['ship_state'] = "Dhaka";
        // $post_data['ship_postcode'] = "1000";
        // $post_data['ship_phone'] = "";
        // $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name'            => $post_data['cus_name'],
                'email'           => $post_data['cus_email'],
                'phone'           => $post_data['cus_phone'],
                'address_line1'   => $post_data['cus_add1'],
                'address_line2'   => $post_data['cus_add2'],
                'district_id'     => $post_data['cus_district'],
                'division_id'     => $post_data['cus_division'],
                'zipCode'         => $post_data['cus_postcode'],
                'country_name'    => $post_data['cus_country'],
                'order_date'      => Carbon::now(),

                'total_amount'    => $post_data['total_amount'],
                'shipping_amount' => $post_data['shipping_amount'],

                'transaction_id'  => $post_data['tran_id'],
                'currency'        => $post_data['currency'],
                'status'          => 'Pending',
            ]);

            #Check order status in order tabel against the transaction id or order id.
            $order_id = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->select('id')->first();

            foreach( Cart::totalCarts() as $cart ) {
            $cart->order_id = $order_id->id;
            $cart->save();
        }

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        // echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('total_amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->first();

        $district = District::where( 'id', $order_details->district_id )->first();
        $division = Division::where( 'id', $order_details->division_id )->first();

        return view ( 'frontend.pages.order.invoice', compact('order_details', 'district', 'division') );

        // if ($order_details->status == 'Pending') {
        //     $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

        //     if ($validation) {
        //         /*
        //         That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
        //         in order table as Processing or Complete.
        //         Here you can also sent sms or email for successfull transaction to customer
        //         */
        //         $update_product = DB::table('orders')
        //             ->where('transaction_id', $tran_id)
        //             ->update(['status' => 'Processing']);

        //         // echo "<br >Transaction is successfully Completed";
        //     }
        // } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
        //     /*
        //      That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
        //      */
        //     echo "Transaction is successfully Completed";
        // } else {
        //     #That means something wrong happened. You can redirect customer to your product page.
        //     echo "Invalid Transaction";
        // }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'total_amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return view('frontend.pages.order.failOrder');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'total_amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            return view('frontend.pages.order.failOrder');
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            return view('frontend.pages.order.failOrder');
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
