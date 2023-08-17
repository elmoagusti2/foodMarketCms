<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Midtrans\config;
use Midtrans\snap;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $food_id = $request->input('food_id');
        $status = $request->input('status');



        //get data detail
        if ($id) {
            $transaction = Transactions::with(['food', 'user'])->find($id);
            if ($transaction) {
                return ResponseFormatter::success($$transaction, 'Data Success');
            } else {
                return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
            }
        }

        $transaction = Transactions::with(['food', 'user'])->where('user_id', Auth::user()->id);

        if ($food_id) {
            $transaction->where('food_id', $food_id);
        }

        if ($status) {
            $transaction->where('status', $status);
        }
        return ResponseFormatter::success($transaction->paginate($limit), 'Success');
    }

    public function update(Request $request, $id)
    {
        $transaction = Transactions::findOrFail($id);
        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'data berhasil diupdate');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food_id',
            'user_id' => 'required|exists:users_id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transactions::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => '',
        ]);

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$clientKey = config('services.midtrans.clientKey');
        Config::$isProduction = config(('services.midtrans.isProduction'));
        Config::$isSanitized = config(('services.midtrans.isSanitized'));
        Config::$is3ds = config(('services.midtrans.is3ds'));

        $transactions = Transactions::with(['food', 'user'])->find($transaction->id);

        $midtrans = array(
            'transaction_details' => [
                'order_id' => $transactions->id,
                'gross_amount' => $transactions->total,
            ],
            'customer_details' => [
                'first_name' => $transactions->user->name,
                'email' => $transactions->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []

        );

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transactions->payment_url = $paymentUrl;
            $transactions->save();

            return ResponseFormatter::success($transactions, 'Transaksi Berhasil');
        } catch (Exception $th) {
            return ResponseFormatter::error($th->getMessage(), 'Transaksi Gagal');
        }
    }
}
