<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahService;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{
    private $fatoorahService;
public function __construct(FatoorahService $fatoorahService)
{
    $this->fatoorahService = $fatoorahService;
}


    public function payOrder()
    {
        //dd('lljjjjjlljl');
        $data = [
            
                'NotificationOption' => 'Lnk', //'SMS', 'EML', or 'ALL'
                'InvoiceValue'       => '100',
                'CustomerName'       => 'Mohamed Mghawry',
                'DisplayCurrencyIso' => 'SAR',
                'CustomerMobile'     => '1234567890',
                'CustomerEmail'      => 'mo@gmail.com',
                'CallBackUrl'        => env(key:'success_url'),
                'ErrorUrl'           => env(key:'error_url'),
                'Language'           => 'en', //or 'ar'
               
        ];

       return $this->fatoorahService->sendPayment($data);
    }


public function paymentCallBack(Request $request)
{
    $data = [
        'Key'     => $request->paymentId,
        'KeyType' => 'paymentId'
    ];
    $paymentData = $this->fatoorahService->getPaymentStatus($data);
        // search where invoice id = $paymentData['Data']['InvoiceId'];  
        // tranaction table in db contain usrer_id and invoice_id
        echo " paid success   ";
        echo " number of invoice id  : ";

       return $paymentData;//['Data']['InvoiceId'];

}


public function paymentErrorBack()
{
   echo "error payment";
}

}
