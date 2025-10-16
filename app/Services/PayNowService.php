<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use \Paynow\Payments\Paynow;
use Paynow\Core\InitResponse;

class PayNowService
{

    protected $paynowInstance;

    public function __construct()
    {
        $this->paynowInstance = new Paynow(
            env('PAYNOW_INTEGRATION_ID'),
            env('PAYNOW_INTEGRATION_KEY'),
            env('APP_URL') . '/success',
            env('APP_URL') . '/success'

        );
    }

    public function initiateMobilePayment($amount, $reference, $mobileNumber, $method, $packageId, $currencyId, $prefix)
    {
        $paynow = $this->paynowInstance;
        $payment = $paynow->createPayment($reference, auth()->user()->email ?? 'client@coverlinkmicroinsurance.co.zw');
        $payment->add("$prefix Premium", $amount);

        $response = $paynow->sendMobile($payment, $mobileNumber, $method);

        if (!$response->success()) {
            return false;
        }

        $pollUrl = $response->pollUrl();
        $maxRetries = 5;

        for ($i = 0; $i < $maxRetries; $i++) {
            sleep(4);
            $transaction = json_decode(json_encode($paynow->pollTransaction($pollUrl)->data()));

            if ($transaction->status === 'Paid') {
                return $this->postPayment($amount, $transaction->paynowreference, $packageId, $currencyId);
            }

            if ($transaction->status === 'Cancelled') {
                break;
            }
        }

        return false;
    }


    public function initiateWebPayment($amount, $reference, $prefix)
    {
        $paynow = $this->paynowInstance;
        $payment = $paynow->createPayment($reference, auth()->user()->email ?? 'client@coverlinkmicroinsurance.co.zw');
        $payment->add("$prefix Premium", $amount);

        $response = $paynow->send($payment);

        if ($response->success()) {
            Session::put('response', $response);
            $url = rtrim($response->redirectUrl(), '/');
            return $url;

        }

        return false;
    }


    public function postPayment($amount, $ref, $packageId, $currencyId): bool
    {
        $mobile = Session::get('mobile');

        $data = [
            "mobile" => $mobile,
            "transactionReference" => $ref,
            "amount" => $amount,
            "currencyId" => $currencyId,
            "packageId" => $packageId
        ];
        $response = postRequest("/members/make-payment", $data);

        if ($response->code == 200 || $response->statusCode == 200) {

            return true;
        }
        return false;

    }
}
