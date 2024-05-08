<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;

class FatoorahService 
{

private $request_client;
private $base_url;
private $headers;

/**
 * @param Client $request_client
*/
public function __construct(Client $request_client)
    {
        $this->request_client = $request_client;
        $this->base_url = env(key:'fatoorah_base_url');
        $this->headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .env(key:'fatoorah_token') ,//test token
        ];
    }

/**
 * 
*/

public function build_Request($uri, $method, $data = [])
{
    
    $request= new Request($method,  $this->base_url . $uri , $this->headers);

    // if(!$data)
    // return false;

    $response =$this->request_client->send($request,[
        'json'=>$data
    ]);
    if($response->getStatusCode() !=200){
       // return false;
    }
    $response=json_decode($response->getBody(),associative:true);
    return $response;

}

/**
 *  @param $data
 * 
*/

public function sendPayment($data)
{
    
   return $response =$this->build_Request('v2/SendPayment','Post',$data);
//        if ($response)
//            $this->saveTransacionPayment($patient_id, $response['Data']['InvoiceId']);
//
}


    public function getPaymentStatus($data)
    {

        return $response = $this->build_Request('v2/getPaymentStatus', 'POST', $data);

    }



}


