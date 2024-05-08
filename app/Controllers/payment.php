<?php

use App\Controllers\BaseController;
use Midtrans\Config;
use Midtrans\Snap;

class Payment extends BaseController
{
    public function __construct()
    {
        Config::$serverKey = 'SB-Mid-server-ueGIwXwX6ad9GmhIb4LSxHe8';
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function checkout()
    {

        // Params for Snap Token
        $transactionDetails = [
            'order_id' => rand(),
            'gross_amount' => 10000,
        ];
        $data = [
            'transaction_details' => $transactionDetails,
            'snapToken' => Snap::getSnapToken([
                'transaction_details' => $transactionDetails,
            ])
        ];

        return view('customer/checkout', $data);
    }
}

