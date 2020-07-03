<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\User;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;
use Illuminate\Support\Facades\Mail;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;

class StripeController extends Controller
{
    public function stripePayment()
    {
        // echo "Stripe Payment"; die;
        $user_id = Auth::user()->id;
        $grand_total = Product::getGrandTotal();
        $userDetails = User::find($user_id);
        $order_id = DB::getPdo()->lastInsertId();
        Session::put('grand_total', $grand_total);

        $meta_title = "Place Order | Romania Feng Shui";
        return view('orders.stripe_payment' ,compact('meta_title','userDetails'));
    }

    public function placeStripePayment(Request $request)
    {
        if($request->isMethod('post')) {
            $data = $request->all();

            $user_email = Auth::user()->email;
            $grand_total = Product::getGrandTotal();
            // echo "<pre>"; print_r($data); die;
            try {
                $charge = Stripe::charges()->create([
                    'amount' => $grand_total,
                    'currency' => 'RON',
                    'source' => $request->stripeToken,
                    'description' => 'Order',
                    'receipt_email' => $user_email,
                    'metadata' => [
                        // 'contents' => $contents,
                        // 'quantity' => $cart_quantity
                    ],
                ]);
                    $order_id = DB::getPdo()->lastInsertId();
                // Successful Payment
                return redirect('/stripe/thanks');
            } catch(CardErrorException $e){
                return back()->with('flash_message_error','Payment failed! '.$e->getMessage());
            }
        }
    }

    public function stripeThanks()
    {
        $order_id = DB::getPdo()->lastInsertId();
        $grand_total = Product::getGrandTotal();
        Session::put('order_id', $order_id);
        Session::put('grand_total', $grand_total);
        return view('orders.thanks_stripe');
    }

    // public function payumoneyResponse(Request $response)
    // {
    //     $response = Indipay::response($request);
    //     // echo "<pre>"; print_r($response); die;
    //     if($response['status']=="success" && $response['unmappedstatus']=="captured"){
    //         //echo "success";
    //         // Get Order ID
    //         $order_id = Session::get('order_id');
    //         // Update Order
    //         Order::where('id',$order_id)->update(['order_status'=>'Payment Captured']);
    //         $productDetails = Order::with('orders')->where('id',$order_id)->first();
    //         $productDetails = json_decode(json_encode($productDetails), true);
    //         // echo "<pre>"; print_r($productDetails); die;

    //         $user_id = $productDetails['user_id'];
    //         $user_email = $productDetails['user_email'];
    //         $name = $productDetails['name'];

    //         $userDetails = User::where('id',$user_id)->first();
    //         $userDetails = json_decode(json_encode($userDetails), true);
    //         // echo "<pre>"; print_r($userDetails); die;
    //         /* Code for Order Email Start */
    //         $email = $user_email;
    //         $messageData = [
    //             'email' => $email,
    //             'name' => $name,
    //             'order_id' => $order_id,
    //             'productDetails' => $productDetails,
    //             'userDetails' => $userDetails
    //         ];
    //         Mail::send('emails.order', $messageData, function($message) use($email){
    //             $message->to($email)->subject('Order Placed - Romania Feng Shui Store');
    //         });
    //         /* Code for Order Email End */

    //         // Empty Cart
    //         DB::table('cart')->where('user_email', $user_email)->delete();

    //         // Redirect user to thanks page after saving order
    //         return redirect('/payumoney/thanks');

    //     } else {
    //         // echo "fail";
    //          // Get Order ID
    //         $order_id = Session::get('order_id');
    //         // Update Order
    //         Order::where('id',$order_id)->update(['order_status'=>'Payment Failed']);

    //         // Redirect user to fail page
    //         return redirect('/payumoney/fail');
    //     }
    // }

    // public function payumoneyThanks()
    // {
    //     return view('orders.thanks_payumoney');
    // }

    // public function payumoneyFail()
    // {
    //     return view('orders.fail_payumoney');
    // }

    // public function payumoneyVerification($order_id)
    // {
    //     $key = 'gtKFFx';
    //     $salt = 'eCwWELxi';

    //     $command = "verify_payment";
    //     $var1 = $order_id;
    //     $hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
    //     $hash = strtolower(hash('sha512', $hash_str));
    //     $r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);

    //     $qs= http_build_query($r);
    //     $wsUrl = "https://test.payu.in/merchant/postservice?form=2";
    //     $c = curl_init();
    //     curl_setopt($c, CURLOPT_URL, $wsUrl);
    //     curl_setopt($c, CURLOPT_POST, 1);
    //     curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
    //     curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
    //     curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    //     curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    //     curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
    //     $o = curl_exec($c);
    //     if (curl_errno($c)) {
    //       $sad = curl_error($c);
    //       throw new Exception($sad);
    //     }
    //     curl_close($c);

    //     $valueSerialized = @unserialize($o);
    //     if($o === 'b:0;' || $valueSerialized !== false) {
    //       print_r($valueSerialized);
    //     }
    //     $o = json_decode($o);
    //     echo "<pre>"; print_r($o); die;
    // }

    // public function payumoneyVerify()
    // {
    //     // Get Last 10 Payumoney Orders
    //     $orders = Order::where('payment_method', 'Payumoney')->take(5)->orderBy('id', 'Desc')->get();
    //     $orders = json_decode(json_encode($orders));
    //     // echo "<pre>"; print_r($orders); die;
    //     foreach($orders as $order){
    //         $key = 'gtKFFx';
    //         $salt = 'eCwWELxi';
    //         $command = "verify_payment";
    //         $var1 = $order->id;
    //         $hash_str = $key  . '|' . $command . '|' . $var1 . '|' . $salt ;
    //         $hash = strtolower(hash('sha512', $hash_str));
    //         $r = array('key' => $key , 'hash' =>$hash , 'var1' => $var1, 'command' => $command);

    //         $qs= http_build_query($r);
    //         $wsUrl = "https://test.payu.in/merchant/postservice?form=2";
    //         $c = curl_init();
    //         curl_setopt($c, CURLOPT_URL, $wsUrl);
    //         curl_setopt($c, CURLOPT_POST, 1);
    //         curl_setopt($c, CURLOPT_POSTFIELDS, $qs);
    //         curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 30);
    //         curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    //         curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    //         curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
    //         $o = curl_exec($c);
    //         if (curl_errno($c)) {
    //           $sad = curl_error($c);
    //           throw new Exception($sad);
    //         }
    //         curl_close($c);

    //         $valueSerialized = @unserialize($o);
    //         if($o === 'b:0;' || $valueSerialized !== false) {
    //           print_r($valueSerialized);
    //         }
    //         $o = json_decode($o);
    //         if($o->transaction_details){
    //             foreach($o->transaction_details as $key => $val){
    //                 if(($val->status=="success")&&($val->unmappedstatus=="captured")){
    //                     if($order->order_status == "Payment Failed" || $order->order_status == "New"){
    //                         Order::where(['id' => $order->id])->update(['order_status' => 'Payment Captured']);
    //                     }
    //                 }else{
    //                     if($order->order_status == "Payment Captured" || $order->order_status == "New"){
    //                         Order::where(['id' => $order->id])->update(['order_status' => 'Payment Failed']);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     echo "cron job run successfully"; die;
    // }
}
