<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        //configuration MIDTRANS
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config(('services.midtrans.isProduction'));
        Config::$isSanitized = config(('services.midtrans.isSanitized'));
        Config::$is3ds = config(('services.midtrans.is3ds'));

        //Instance notification Midtrans
        $notification = new Notification();

        //init data
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        //find transaction with Id
        $transaction = Transactions::findOrFail($orderId);

        //handle status
        if ($status == 'capture' && $type == 'credit_card' && $fraud == 'challenge') {
            $transaction->status = 'PENDING';
        }
        if ($status == 'capture' && $type == 'credit_card' && $fraud != 'challenge') {
            $transaction->status = 'PENDING';
        }
        if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        }
        if ($status == 'pending') {
            $transaction->status = 'PENDING';
        }
        if ($status == 'deny' || $status == 'expire' || $status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }
    }

    public function success(Request $request)
    {
        return view('midtrans.success');
        
    }

    public function unfinish(Request $request)
    {
        return view('midtrans.unfinish');
    }

    public function error(Request $request)
    {
        return view('midtrans.error');
    }
}
