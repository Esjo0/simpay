<?php

namespace App;

use Illuminate\Support\Facades\Redirect;

class Paystack
{

    private $sk_paystack;
    private $header;

    public function __construct()
    {
        $this->sk_paystack = env('PAYSTACK_SECRET_KEY');
        $this->header = array(
            "Authorization: Bearer " . $this->sk_paystack,
            "Content-type: application/json",
            "Cache-control: no-cache"
        );
    }

    protected function curl($header, $url,  $param = false)
    {
        $header = $this->header;
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        //Turn off SSL Checker
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, config('custom.curl.ssl'));

        if ($param) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        }

        $curl_response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($curl_response, true);

        return $response;
    }

    /**
     * Initialize the paystack API
     * @param $body (array required: first_name, last_name, reference, email, amount, callback_url) Amount should be kobo
     * @return string
     */
    public function initialize($body)
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $data = [
            "email" => $body['email'],
            "amount" => $body['amount'] * 100,
            "currency" => $body['currency'],
            "ref" => $body['transaction_id'],
            "callback_url" => $body['redirect_url'],
        ];
        try {
            $response = $this->curl($this->header, $url, json_encode($data));
            
            if ($response['status'] = "true") {
                return Redirect::to($response['data']['authorization_url']);
            } else {
                http_response_code(400);
                return response()->json(
                    [
                        'status' => false,
                        'statusCode' => http_response_code(400),
                        'message' => 'Cannot process transaction',
                        'data' => null
                    ]
                );
            }
        } catch (\Throwable $e) {
            http_response_code(400);
            return response()->json(
                [
                    'status' => false,
                    'statusCode' => http_response_code(400),
                    'message' => "Operation failed",
                    'data' => null
                ]
            );
        }
    }


    public function verify_transaction()
    {
        $ref =  $_GET['reference'];
        $url = "https://api.paystack.co/transaction/verify/" . rawurlencode($ref);
        $response = $this->curl($this->header,  $url);
        return $response;
    }
}
